<?php
 namespace Abcham\Contracts;

 /**
  * Interface TokenValidator
  * @package Abcham\Contracts
  */
 interface TokenValidator
 {
     /**
      * Valida el token especificado de acuerdo a la implementación
      * @param Token $token
      * @return mixed
      */
     public function validate(Token $token);
 }