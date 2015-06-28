<?php

namespace Abcham\Contracts;
use DateTime;

/**
* Interfaz de Tokens
*/
interface Token
{
    /**
     * Regrsa la cadena criptoraficamente segura
     * @return string
     */
    public function token();

    /**
     * Regresa el onjeto DateTime con la fecha de creación
     * @return DateTime
     */
    public function createdAt();

    /**
     * Regresa el onjeto DateTime con la fecha de expiración
     * @return DateTime
     */
    public function validUntil();
}