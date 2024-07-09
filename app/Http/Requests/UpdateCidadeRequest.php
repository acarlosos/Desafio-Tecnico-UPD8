<?php

namespace App\Http\Requests;

use App\Enums\UfEnum;
use Illuminate\Validation\Rules\Enum;
class UpdateCidadeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'uf' => ['required',new Enum(UfEnum::class)],
        ];
    }
}
