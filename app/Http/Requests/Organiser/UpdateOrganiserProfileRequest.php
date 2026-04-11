<?php

namespace App\Http\Requests\Organiser;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganiserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $profile = auth()->user()->isOrganiser();
        return $profile;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:10240',
            'cover_image' => 'nullable|image|max:10240',
        ];
    }
}
