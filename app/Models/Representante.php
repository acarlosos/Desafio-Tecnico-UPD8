<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Representante extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
    ];

    public function cidades()
    {
        return $this->belongsToMany(Cidade::class);
    }
}
