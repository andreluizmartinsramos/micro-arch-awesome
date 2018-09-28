<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 01/03/2018
 * Time: 14:39
 */

namespace App\Exception;


class DominioException extends \Exception
{
    const DEFAULT_MESSAGE = "Domínio não permitido para esta DR";

    public function __construct($code = 0, $message = null, Exception $previous = null) {
        $message = isset($message) ? $message : self::DEFAULT_MESSAGE;
        parent::__construct($message, $code, $previous);
    }
}