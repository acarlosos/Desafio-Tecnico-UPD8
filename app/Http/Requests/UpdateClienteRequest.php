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
                'required',
                'min:11',
                'max:11',
                Rule::unique('clientes')->ignore($this->cliente),
            ],
            'nome' => 'required|max:255',
            'data_nascimento' => 'required|date',
            'sexo' => ['required',new Enum(SexoEnum::class)],
            'endereco' => 'required|max:255',
            'cidade_id' => 'required|int',
            'uf' => ['required',new Enum(UfEnum::class)],
        ];
    }
}
