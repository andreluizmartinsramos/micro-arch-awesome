<?php

namespace App\Utils;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class Validator
{

    public function validateDr(?string $dr): string
    {
        if (empty($dr)) {
            throw new InvalidArgumentException('Dr é obrigatório');
        }

        if (mb_strlen(trim($dr)) !== 2) {
            throw new InvalidArgumentException('A DR deve conter 2 caracteres');
        }

        return $dr;
    }

    public function validateEmail(?string $email): string
    {
        if (empty($email)) {
            throw new InvalidArgumentException('Email é obrigatório.');
        }

        if (false === mb_strpos($email, '@')) {
            throw new InvalidArgumentException('Email inválido.');
        }

        return $email;
    }

}
