<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->route('user',0);
        $id = $user ? $user->id : 0;
        return [
            // 'name' => 'sometimes|required|string|max:255|min:3',
            'email' => "sometimes|required|unique:users,email,{$id}",
            'key' => 'sometimes|required',
            'username' => "sometimes|required|unique:users,username,{$id}",
            'password'=> 'sometimes|required|string|min:8|confirmed',
            'type' => 'in:user,admin,user_management',
            'user_tiles' => 'nullable|array',
            'user_tiles.*' => 'string',
            // 'image' => 'nullable|image',
            // 'phone' => 'nullable|numeric|min:9',

        ];
    }
}
