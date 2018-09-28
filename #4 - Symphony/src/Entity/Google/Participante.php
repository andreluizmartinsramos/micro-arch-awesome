<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 19/04/2018
 * Time: 10:51
 */

namespace App\Entity\Google;

use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;

/**
 * Class Participante
 * @package App\Entity
 */
class Participante
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email do usuário.", example="joao.silva@sc.docente.senai.br", required={"true"})
     * )
     */
    private $email;

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Participante
     */
    public function setEmail(string $email): Participante {
        $this->email = $email;
        return $this;
    }

}