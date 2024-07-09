<?php

namespace App\Http\Requests;

use App\Enums\UfEnum;
use Illuminate\Validation\Rules\Enum;
class StoreRepresentanteRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cidade_id' => 'required|int',
            'nome' => 'required|max:255',
            'uf' => ['required',new Enum(UfEnum::class)],
        ];
    }
}
