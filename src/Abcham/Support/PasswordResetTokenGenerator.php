<?php
namespace Abcham\Support;
use Abcham\Contracts\TokenGenerator;
use DateTime;

/**
* Clase que genera Tokens para restablecer contraseñas
*/
class PasswordResetTokenGenerator implements TokenGenerator
{
    protected $length;
    protected $type;

    /**
     * @param string $type
     * @param int|string $length
     */
    function __construct($type = 'alnum', $length = 8)
    {
        $this->type = $type;
        $this->length = (int) $length;
    }

    /**
     * Genera un Token con la fecha de vencimiento especificada
     *
     * @param DateTime $created_at
     * @param DateTime $valid_until
     * @return PasswordResetToken
     */
    public function generate(DateTime $created_at, DateTime $valid_until)
    {
        $token_string = $this->randomText();
        $token = new PasswordResetToken($token_string, $created_at, $valid_until);
        return $token;
    }

    /**
     * Genera una cadena de texto del tipo y longitud especificados
     * criptograficamente segura, aleatoria, de longitud variable
     * Implementación tomada de: https://gist.github.com/raveren/5555297
     * @param string $type
     * @param int $length
     * @return string
     */
    public function randomText($type = null, $length = null)
    {
        $type = ($type)? $type : $this->type;
        $length = ($length)? $length : $this->length;
        switch ( $type ) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }

        $crypto_rand_secure = function ( $min, $max ) {
            $range = $max - $min;
            if ( $range < 0 ) return $min; // not so random...
            $log    = log( $range, 2 );
            $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
            $bits   = (int) $log + 1; // length in bits
            $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ( $rnd >= $range );
            return $min + $rnd;
        };

        $token = "";
        $max   = strlen( $pool );
        for ( $i = 0; $i < $length; $i++ ) {
            $token .= $pool[$crypto_rand_secure( 0, $max )];
        }
        return $token;
    }
}