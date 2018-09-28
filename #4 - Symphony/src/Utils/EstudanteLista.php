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
use App\Entity\Google\Grupo;

class EstudanteLista
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Token da próxima página")
     */
    private $nextPageToken;

    /**
     * @var Estudante[]
     * @Serializer\Type("array<App\Entity\Google\Grupo>")
     * @SWG\Property(description="Grupos")
     */
    private $grupos;

    /**
     * @return mixed
     */
    public function getNextPageToken() {
        return $this->nextPageToken;
    }

    /**
     * @param mixed $nextPageToken
     * @return UsuarioLista
     */
    public function setNextPageToken($nextPageToken): self {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrupos() {
        return $this->grupos;
    }

    /**
     * @param mixed $grupos
     * @return GrupoLista
     */
    public function setGrupos($grupos): self {
        $this->grupos = $grupos;
        return $this;
    }
}