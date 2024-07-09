<?php

namespace App\Models;

use App\Enums\SexoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cidade_id',
        'nome',
        'cpf',
        'data_nascimento',
        'sexo',
        'endereco',
    ];

    protected $casts = [
        'data_nascimento' => 'date' ,
        'sexo' => SexoEnum::class ,
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

}
