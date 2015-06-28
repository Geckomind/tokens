<?php

namespace Abcham\Contracts;
use DateTime;

/**
* Interfaz de generador de Tokens
*/
interface TokenGenerator
{
    /**
     * Genera un Token con la fecha de vencimiento especificada
     *
     * @param \DateTime $created_at
     * @param \DateTime $valid_until
     * @return Token
     */
    public function generate(DateTime $created_at, DateTime $valid_until);

    /**
     * Genera una cadena de texto del tipo y longitud especificados
     * criptograficamente segura, aleatoria de longitud variable
     *
     * @param string $type
     * @param string $lenght
     * @return string
     */
    public function randomText($type, $lenght);
}