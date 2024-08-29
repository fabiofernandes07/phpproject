<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clientId = $this->route('client');

        return [
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cpf_cnpj' => [
                'required',
                'string',
                'max:20',
                Rule::unique('client')->ignore($clientId), // Ignora o ID do cliente atual na verificação de unicidade
            ],
            'foto' => 'mimes:png,jpeg,jpg|max:20048', // Ajuste para o tamanho que você desejar
            'nome_social' => 'nullable|string|max:255',
        ];
    }
}
