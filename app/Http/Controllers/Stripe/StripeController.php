<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function createCheckoutSession(Event $event, TicketType $ticketType)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $ticketType->name,
                        'description' => $event->name,
                    ],
                    'unit_amount' => (int) ($event->calculatePrice() * 100),
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('audience.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('audience.checkout.cancel', $event),
            'metadata' => [
                'event_id' => $event->id,
                'ticket_type_id' => $ticketType->id,
                'user_id' => auth()->id(),
            ]
        ]);

        return redirect($session->url);
    }

    private function generateBarcode(): string
    {
        do {
            $barcode = str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT);
        } while (Ticket::where('barcode', $barcode)->exists());

        return $barcode;
    }

    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                config('services.stripe.webhook_secret'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $eventId = $session->metadata->event_id;
            $ticketTypeId = $session->metadata->ticket_type_id;
            $userId = $session->metadata->user_id;

            $exists = Ticket::where('stripe_payment_intent_id', $session->payment_intent)->exists();
            if (!$exists) {
                $ticketType = TicketType::find($ticketTypeId);
                $eventModel = Event::find($eventId);
                $seatId = null;

                if($eventModel->has_seats) {
                    $seat = $eventModel->seats()->where('is_reserved', '=', false)->first();
                    if($seat)
                    {
                        $seat->update(['is_reserved' => true]);
                        $seatId = $seat->id;
                    }
                }

                Ticket::create([
                    'event_id' => $eventId,
                    'user_id' => $userId,
                    'ticket_type_id' => $ticketTypeId,
                    'seat_id' => $seatId,
                    'price' => $eventModel->calculatePrice(),
                    'barcode' => $this->generateBarcode(),
                    'stripe_payment_intent_id' => $session->payment_intent
                ]);
            }
        }
        return response()->json(['status' => 'ok'], 200);
    }
    public function success(Request $request)
    {
        return view('audience.checkout.success');
    }

    public function cancel()
    {
        return view('audience.checkout.cancel');
    }
}
