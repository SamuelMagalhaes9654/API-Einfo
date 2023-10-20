<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventoRequest extends FormRequest
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
//     public function rules(): array
//     {
//         $rules = [
//             'nome' => ['required', 'unique:eventos,nome'.$this->id],
//             'descricao' => 'required',
//             'quantidade' => 'required',
//             'local' => 'required',
//             'data' => 'required',
//         ];

//         if($this->method() === "PATCH"){
//             foreach($rules as $input => $rule){
//                 if(array_key_exists($input, $this->all())){
//                     $rulesdinamica[$input] = $rule;
//                 }
//             }
//             return $rulesdinamica;
//         } else{
//             return $rules;
//         }
//     }

//     public function messages() :array
//     {
//         return [
//             'required' => 'O campo :attribute não pode ficar vazio',
//             'nome.unique' => 'O nome do evento ja existe'
//         ];
//     }
}
