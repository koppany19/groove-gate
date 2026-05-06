<?php

namespace App\Http\Controllers\Audience;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function show(string $barcode)
    {
        $ticket = Ticket::where('barcode', $barcode)->with('event', 'ticketType', 'seat', 'user')->firstOrFail();
        if($ticket->user_id !== auth()->id()){
            abort(403);
        }
        $qrCode = QrCode::size(200)->format('svg')->generate(route('audience.tickets.show', $barcode));

        return view('audience.tickets.show', compact('ticket', 'qrCode'));
    }
}
