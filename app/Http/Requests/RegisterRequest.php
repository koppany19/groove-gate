<?php

namespace App\Http\Requests;

use App\GenreType;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:audience,organiser,artist',

            'location' => 'nullable|string|max:255',

            'stage_name'  => 'required_if:role,artist|nullable|string|max:100',
            'genre'       => 'sometimes|nullable|array',
            'genre.*'     => 'in:' . implode(',', array_column(GenreType::cases(), 'value')), // like in method == in:rock,pop,jazz
            'genre_other' => 'sometimes|nullable|string|max:100',
            'artist_type' => 'required_if:role,artist|nullable|in:live,dj',
            'price_min'   => 'nullable|integer|min:0',
            'price_max'   => 'nullable|integer|min:0|gte:price_min',
            'bio'         => 'nullable|string',
            'press_text'  => 'nullable|string',
            'duration'    => 'nullable|integer|min:0',

            'company_name' => 'required_if:role,organiser|nullable|string|max:150',
            'description'  => 'nullable|string',
            'phone'        => 'nullable|string|max:20',
        ];

        }

    public function messages(): array
    {
        return [
            'name.required'          => 'Please enter your name.',
            'name.max'               => 'Your name cannot exceed 255 characters.',
            'email.required'         => 'Please enter your email address.',
            'email.email'            => 'Please enter a valid email address.',
            'email.unique'           => 'This email address is already registered.',
            'password.required'      => 'Please enter a password.',
            'password.confirmed'     => 'The password confirmation does not match.',
            'password.min'           => 'Your password must be at least 8 characters long.',
            'role.required'          => 'Please select your role.',
            'role.in'                => 'Invalid role selected.',


            'stage_name.required_if' => 'Please enter your stage name.',
            'stage_name.max'         => 'Stage name cannot exceed 100 characters.',
            'genre.array'            => 'Please select at least one genre.',
            'genre.*.in'             => 'One or more selected genres are invalid.',
            'genre_other.max'        => 'Custom genre cannot exceed 100 characters.',
            'artist_type.required_if'=> 'Please select your artist type.',
            'artist_type.in'         => 'Artist type must be either Live or DJ.',
            'price_min.integer'      => 'Minimum price must be a number.',
            'price_min.min'          => 'Minimum price cannot be negative.',
            'price_max.integer'      => 'Maximum price must be a number.',
            'price_max.min'          => 'Maximum price cannot be negative.',
            'price_max.gte'          => 'Maximum price must be greater than minimum price.',
            'duration.integer'       => 'Duration must be a number.',
            'duration.min'           => 'Duration cannot be negative.',


            'company_name.required_if' => 'Please enter your company name.',
            'company_name.max'         => 'Company name cannot exceed 150 characters.',
            'phone.max'                => 'Phone number cannot exceed 20 characters.',

            'location.max'           => 'Location cannot exceed 255 characters.',
        ];
    }
}
