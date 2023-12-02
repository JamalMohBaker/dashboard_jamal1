<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
        'user_id' => 'sometimes|required|string',
        'tile_id' => 'sometimes|required|string',
        // 'name' => 'sometimes|required|string',
        'username' => 'sometimes|required|string',
        // 'logo' => 'nullable | image',
        // 'link' => 'sometimes|required|string',
        // 'color' => 'sometimes|required|string',
        'password'=> 'sometimes|required|string|min:8|confirmed',
        'user_permissions' => 'nullable|array',
        'user_permissions.*' => 'string',
        ];
    }
}
