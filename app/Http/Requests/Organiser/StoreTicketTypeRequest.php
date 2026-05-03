<?php

namespace App\Http\Requests\Organiser;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isOrganiser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'quantity'       => 'required|integer|min:1',
            'sale_start_at'  => 'nullable|date',
            'sale_end_at'    => 'nullable|date|after:sale_start_at',
        ];
    }
}
