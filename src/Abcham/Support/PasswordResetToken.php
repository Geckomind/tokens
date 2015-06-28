<?php

namespace Abcham\Support;

use Abcham\Contracts\Token;
use DateTime;

/**
 * Token usado para validar la acción de resetear passwords
 *
 * @package Abcham\Support
 * @author Abraham chávez
 **/
class PasswordResetToken implements Token
{
    /**
     * Cadena de caracteres criptoraficamente segura
     *
     * @var string
     **/
    protected $token = '';
    /**
     * Fecha de creación del Token
     *
     * @var DateTime
     **/
    protected $created_at = '';
    
    /**
     * Fecha de vencimiento del Token
     *
     * @var DateTime
     **/
    protected $valid_until = '';
    
    /**
     * ID del usuario al cual el token esta ligado
     *
     * @var int
     **/
    protected $user_id = 0;

    /**
     * Inicializamos propiedades del Token
     * @var string $token
     * @var DateTime $created_at
     * @var DateTime $valid_until
     * @var int $user_id
     **/
    public function __construct($token, DateTime $created_at, DateTime $valid_until, $user_id = 0)
    {
        $this->token = $token;
        $this->created_at = $created_at;
        $this->valid_until = $valid_until;
        $this->user_id = (int) $user_id;
    }

    /**
     * Regresa la cadena criptoraficamente segura contra duplicidad
     *
     * @return string
     **/
    public function token()
    {
        return $this->token;
    }

    /**
     * Regresa la fecha de creación del Token
     *
     * @return DateTime
     **/
    public function createdAt()
    {
        return $this->created_at;
    }

    /**
     * Regresa la fecha de vencimiento del Token
     *
     * @return DateTime
     **/
    public function validUntil()
    {
        return $this->valid_until;
    }

    /**
     * Obtiene o Establece el ID del usuario al cual el Token esta ligado
     * @param int $user_id
     * @return int
     **/
    public function userId($user_id = null)
    {
        if( empty($user_id) ){
            return $this->user_id;
        } else {
            return $this->user_id = $user_id;
        }
    }
}
