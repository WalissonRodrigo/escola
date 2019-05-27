<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:5|max:191',
            'endereco' => 'required|min:5|max:191',
            'cidade' => 'required|min:5|max:191',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            /* 'nome' => 'Nome do Aluno',
            'endereco' => 'Endereço Completo',
            'cidade' => 'Cidade', */
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            /* 'nome.required' => 'O Nome do Aluno é obrigatório para cadastro!',
            'endereco.required' => 'O Endereço é obrigatório para cadastro!',
            'cidade.required' => 'A Cidade é obrigatória para cadastro!',
            
            'nome.max' => 'O máximo de caracteres para o Nome do Aluno é 191 caracteres incluindo espaços!',
            'endereco.max' => 'O máximo de caracteres para o Endereço é 191 caracteres incluindo espaços!',
            'cidade.max' => 'O máximo de caracteres para a Cidade é 191 caracteres incluindo espaços!',

            'nome.min' => 'O minimo de caracteres para o Nome do Aluno é 5 caracteres incluindo espaços!',
            'endereco.min' => 'O minimo de caracteres para o Endereço é 4 caracteres incluindo espaços!',
            'cidade.min' => 'O minimo de caracteres para a Cidade é 3 caracteres incluindo espaços!', */
        ];
    }
}
