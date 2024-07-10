<?php

namespace App\Http\Requests;

use App\Enums\SexoEnum;
use App\Enums\UfEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;
class UpdateClienteRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' =>[
                'nullable',
                'min:11',
                'max:11',
                Rule::unique('clientes')->ignore($this->cliente),
            ],
            'nome' => 'nullable|max:255',
            'data_nascimento' => 'nullable|date',
            'sexo' => ['nullable',new Enum(SexoEnum::class)],
            'endereco' => 'nullable|max:255',
            'cidade_id' => 'nullable|int',
            'uf' => ['nullable',new Enum(UfEnum::class)],
        ];
    }
}
