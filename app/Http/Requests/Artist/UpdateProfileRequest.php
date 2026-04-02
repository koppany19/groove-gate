<?php

namespace App\Http\Requests\Artist;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isArtist();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'stage_name'  => 'required|string|max:100',
            'genre'       => 'sometimes|nullable|array',
            'genre.*'     => 'in:' . implode(',', array_column(\App\GenreType::cases(), 'value')), // like in method == in:rock,pop,jazz
            'genre_other' => 'sometimes|nullable|string|max:100',
            'artist_type' => 'required|in:live,dj',
            'price_min'   => 'nullable|integer|min:0',
            'price_max'   => 'nullable|integer|min:0|gte:price_min',
            'bio'         => 'nullable|string',
            'press_text'  => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
            'avatar'      => 'nullable|image|max:2048',
            'duration'    => 'nullable|integer|min:0',
            'location'    => 'nullable|string|max:255',
            'spotify_url'    => 'nullable|url|max:255',
            'soundcloud_url' => 'nullable|url|max:255',
            'youtube_url'    => 'nullable|url|max:255',
            'instagram_url'  => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'stage_name.required' => 'Stage name is required.',
            'artist_type.required' => 'Please select an artist type.',
            'price_max.gte'       => 'Max price must be greater than min price.',
            'spotify_url.url'     => 'Please enter a valid Spotify URL.',
            'soundcloud_url.url'  => 'Please enter a valid SoundCloud URL.',
            'youtube_url.url'     => 'Please enter a valid YouTube URL.',
            'instagram_url.url'   => 'Please enter a valid Instagram URL.',
        ];
    }
}
