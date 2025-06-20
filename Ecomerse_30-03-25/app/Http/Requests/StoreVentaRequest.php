<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
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
            'usuario_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'ticket' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'estado' => 'in:pendiente,validada',
        ];
    }
}
