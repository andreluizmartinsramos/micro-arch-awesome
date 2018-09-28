<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 17/04/2018
 * Time: 08:00
 */

namespace App\Entity\Google;

use App\Entity\Api\Registro;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;
use Doctrine\ORM\Mapping as ORM;
use App\Annotation\GoogleEntity;

/**
 * Class Calendario
 * @package App\Entity
 * @GoogleEntity\Entity(googleClass="\Google_Service_Calendar_Calendar")
 * @ORM\Entity()
 * @ORM\Table(name="google.calendario")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Calendario extends Registro
{

    /**
     * @var int
     * @Serializer\Type("string")
     * @SWG\Property(description="Id google do Calendário.", readOnly=true)
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @GoogleEntity\Property(googleFieldName="id")
     */
    private $id;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Título do Calendário.", example="Provas")
     * @ORM\Column(type="string", length=80, nullable=true)
     * @GoogleEntity\Property(googleFieldName="summary")
     */
    private $titulo;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Descrição do Calendário.", example="Calendário para informações de provas")
     * @ORM\Column(type="string", nullable=true)
     * @GoogleEntity\Property(googleFieldName="description")
     */
    private $descricao;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Local do Calendário.", example="Tubarão")
     * @ORM\Column(type="string", length=50, nullable=true)
     * @GoogleEntity\Property(googleFieldName="location")
     */
    private $local;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Google\Usuario", mappedBy="calendarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuarios;

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Calendario
     */
    public function setId(string $id): Calendario {
        $this->id = $id;
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
     * @return Calendario
     */
    public function setTitulo(string $titulo): Calendario {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao(): string {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return Calendario
     */
    public function setDescricao(string $descricao): Calendario {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocal(): string {
        return $this->local;
    }

    /**
     * @param string $local
     * @return Calendario
     */
    public function setLocal(string $local): Calendario {
        $this->local = $local;
        return $this;
    }

}