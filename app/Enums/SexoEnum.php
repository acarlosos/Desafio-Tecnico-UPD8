<?php

namespace App\Enums;

enum SexoEnum:string
{
    case MASCULINO = 'masculino';
    case FEMININO = 'feminino';
    public function label(): string
    {
        return match ($this) {
            self::MASCULINO => __('Masculino'),
            self::FEMININO => __('Feminino'),
        };
    }
}


