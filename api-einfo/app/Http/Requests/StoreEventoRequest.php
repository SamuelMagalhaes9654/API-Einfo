<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventoRequest extends FormRequest
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
            'nome' => ['required', 'unique:eventos'],
            'descricao' => 'required',
            'quantidade' => 'required',
            'local' => 'required',
            'data' => 'required',
            'horario' => 'required',
        ];
    }

    public function messages() :array
    {
        return [
            'required' => 'O campo :attribute não pode ficar vazio',
            'nome.unique' => 'O nome do evento ja existe'
        ];
    }
}
