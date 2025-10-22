<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class eventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|min:5|max:50',
            'descripcion' => 'required|min:5|max:150',
            'fecha_inicio' => 'required',
            'hora_inicio' => 'required',
            'fecha_fin' => 'required',
            'hora_fin' => 'required',
        ];
    }
}
