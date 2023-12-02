<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TileRequest extends FormRequest
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
        $tile = $this->route('tile',0);
        $id = $tile ? $tile->id : 0;
        return [
        'name' => "sometimes|required|string|unique:tiles,name,{$id}",
        'color' => 'sometimes|required|string',
        'logo' => 'nullable|image',
        'link' => 'required',
        ];
    }
}
