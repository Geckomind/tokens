<?php

namespace Abcham\Contracts;

/**
* Interfaz de Tokens
*/
interface Token
{
    public function token();
    public function createdAt();
    public function validUntil();
}