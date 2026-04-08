<?php

namespace App\Http\Requests\Organiser;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|after:now',
            'end_date' => 'nullable|date|after:start_date',
            'cover_image' => 'nullable|image|max:10240',
            'capacity' => 'required|integer|min:1',
            'has_seats' => 'boolean',
            'base_price' => 'nullable|min:0',
            'is_dynamic_price' => 'boolean',
            'sale_end_at' => 'nullable|date|before:start_date',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Event name is required.',
            'location.required' => 'Event location is required.',
            'start_date.required' => 'Event start date is required.',
            'start_date.after' => 'Event start date must be in the future.',
            'end_date.after' => 'Event end date must be after the start date.',
            'sale_end_at.before' => 'Event sale end date must be before the sale date.',
        ];
    }
    //boolean ertekek mindig true vagy falset kapjanak, hogy a validacio helyesen mukodjon
    protected function prepareForValidation(): void
    {
        $this->merge([
            'has_seats'        => $this->boolean('has_seats'),
            'is_dynamic_price' => $this->boolean('is_dynamic_price'),
        ]);
    }
}
