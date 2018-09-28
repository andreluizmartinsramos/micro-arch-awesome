<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 28/05/2018
 * Time: 10:33
 */

namespace App\Annotation\GoogleEntity;

/**
 * Class GoogleEntity
 * @package App\Annotation
 * @Annotation
 * @Target("PROPERTY")
 */
class Request
{
    public $method;

}