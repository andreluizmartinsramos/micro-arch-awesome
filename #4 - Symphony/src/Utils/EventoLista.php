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

class EventoLista
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Token da próxima página")
     */
    private $nextPageToken;

    /**
     * @var Evento[]
     * @Serializer\Type("array<App\Entity\Google\Evento>")
     * @SWG\Property(description="Eventos")
     */
    private $eventos;

    /**
     * @return mixed
     */
    public function getNextPageToken() {
        return $this->nextPageToken;
    }

    /**
     * @param mixed $nextPageToken
     * @return GrupoLista
     */
    public function setNextPageToken($nextPageToken): self {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventos() {
        return $this->eventos;
    }

    /**
     * @param mixed $eventos
     * @return GrupoLista
     */
    public function setEventos($eventos): self {
        $this->eventos = $eventos;
        return $this;
    }
}