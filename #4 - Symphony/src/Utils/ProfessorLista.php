<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/04/2018
 * Time: 15:13
 */

namespace App\Utils;

use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as Serializer;
use App\Entity\Google\Professor;

class ProfessorLista
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Token da próxima página")
     */
    private $nextPageToken;

    /**
     * @var Professor[]
     * @Serializer\Type("array<App\Entity\Google\Professor>")
     */
    private $professores;

    /**
     * @return mixed
     */
    public function getNextPageToken() {
        return $this->nextPageToken;
    }

    /**
     * @param mixed $nextPageToken
     * @return ProfessorLista
     */
    public function setNextPageToken($nextPageToken): self {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfessores() {
        return $this->professores;
    }

    /**
     * @param mixed $professores
     * @return ProfessorLista
     */
    public function setProfessores($professores): self {
        $this->professores = $professores;
        return $this;
    }
}