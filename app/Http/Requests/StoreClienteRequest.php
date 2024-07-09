<?php

namespace App\Http\Requests;

use App\Enums\SexoEnum;
use App\Enums\UfEnum;
use Illuminate\Validation\Rules\Enum;

class StoreClienteRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'cpf' => 'required|unique:clientes|min:11',
            'nome' => 'required|max:255',
            'data_nascimento' => 'required|date',
            'sexo' => ['required',new Enum(SexoEnum::class)],
            'endereco' => 'required|max:255',
            'cidade_id' => 'required|int',
            'uf' => ['required',new Enum(UfEnum::class)],
        ];
    }
}
