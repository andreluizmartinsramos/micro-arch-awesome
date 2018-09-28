<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/04/2018
 * Time: 15:13
 */

namespace App\Utils;

use App\Entity\Google\Calendario;
use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as Serializer;

class CalendarioLista
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Token da próxima página")
     */
    private $nextPageToken;

    /**
     * @var Calendario[]
     * @Serializer\Type("array<App\Entity\Google\Curso>")
     * @SWG\Property(description="Cursos")
     */
    private $cursos;

    /**
     * @return mixed
     */
    public function getNextPageToken() {
        return $this->nextPageToken;
    }

    /**
     * @param mixed $nextPageToken
     * @return CursoLista
     */
    public function setNextPageToken($nextPageToken): self {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCursos() {
        return $this->cursos;
    }

    /**
     * @param mixed $cursos
     * @return CursoLista
     */
    public function setCursos($cursos): self {
        $this->cursos = $cursos;
        return $this;
    }
}