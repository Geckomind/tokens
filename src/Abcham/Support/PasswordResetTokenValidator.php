<?php

namespace Abcham\Support;

use Abcham\Contracts\Token;
use Abcham\Contracts\TokenValidator;
use DateTime;

/**
 * Validador de Tokens para resetear Passwords
 * Class PasswordResetTokenValidator
 * @package Abcham\Support
 */
class PasswordResetTokenValidator implements TokenValidator
{
    /**
     * Valida que el token ho halla expirado
     * @param Token $token
     * @return mixed
     */
    public function validate(Token $token)
    {
        $hoy = new DateTime();
        return $hoy < $token->validUntil() ;
    }
}
