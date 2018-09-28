<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 17/04/2018
 * Time: 09:15
 */

namespace App\Entity\Google;

use App\Entity\Api\Registro;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;
use Doctrine\ORM\Mapping as ORM;
use App\Annotation\GoogleEntity;

/**
 * Class Evento
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="google.evento")
 * @GoogleEntity\Entity(googleClass="\Google_Service_Calendar_Event")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Evento extends Registro
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Id google do Evento.", readOnly=true)
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @GoogleEntity\Property(googleFieldName="id")
     */
    private $id;

    /**
     * @var string;
     * @ORM\Column(type="string")
     */
    private $calendarioId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Título do evento.", example="Prova 01")
     * @ORM\Column(type="string", length=100)
     * @GoogleEntity\Property(googleFieldName="summary")
     */
    private $titulo;

    /**
     * @var datetime
     * @Serializer\Type("string")
     * @SWG\Property(description="Início do evento.", example="2018-04-17T13:12:09")
     * @ORM\Column(type="string", length=20)
     */
    private $inicio;

    /**
     * @var datetime
     * @Serializer\Type("string")
     * @SWG\Property(description="Término do evento.", example="2018-04-17T13:13:09")
     * @ORM\Column(type="string", length=20)
     */
    private $termino;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Link do evento.", readOnly=true, example="https://www.google.com/calendar/event?eid=NGRtYmRsbjllb2M1YjVwaXF2Zjg0ZThlNWMgYWRtaW5pbnRlZ3JhY29lc0BlZHUuc2VuYWkuYnI", readOnly=true)
     * @ORM\Column(type="string")
     * @GoogleEntity\Property(googleFieldName="htmlLink")
     */
    private $htmlLink;

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Evento
     */
    public function setId(string $id): Evento {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCalendarioId(): string {
        return $this->calendarioId;
    }

    /**
     * @param string $calendarioId
     * @return Evento
     */
    public function setCalendarioId(string $calendarioId): Evento {
        $this->calendarioId = $calendarioId;
        return $this;
    }


    /**
     * @return string
     */
    public function getTitulo(): string {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     * @return Evento
     */
    public function setTitulo(string $titulo): Evento {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @return string
     */
    public function getInicio(): ?string {
        return $this->inicio;
    }

    /**
     * @param string $inicio
     * @return Evento
     */
    public function setInicio(string $inicio): Evento {
        $this->inicio = $inicio;
        return $this;
    }

    /**
     * @return string
     */
    public function getTermino(): ?string {
        return $this->termino;
    }

    /**
     * @param string $termino
     * @return Evento
     */
    public function setTermino(string $termino): Evento {
        $this->termino = $termino;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtmlLink(): string {
        return $this->htmlLink;
    }

    /**
     * @param string $htmlLink
     * @return Evento
     */
    public function setHtmlLink(string $htmlLink): Evento {
        $this->htmlLink = $htmlLink;
        return $this;
    }

}