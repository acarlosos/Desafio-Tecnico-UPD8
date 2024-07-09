<?php

namespace App\Models;

use App\Enums\UfEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nome',
        'uf',
    ];
    protected $casts =[
        'uf' => UfEnum::class,
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function representantes()
    {
        return $this->belongsToMany(Representante::class);
    }
}
