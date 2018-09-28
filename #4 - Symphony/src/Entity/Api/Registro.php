<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 08/06/2018
 * Time: 09:34
 */

namespace App\Entity\Api;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Registro
 * @package App\Entity
 * @ORM\MappedSuperclass()
 */
class Registro
{

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="criador", referencedColumnName="id", nullable=true)
     * @Serializer\Exclude()
     */
    protected  $criador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="alterador", referencedColumnName="id", nullable=true)
     * @Serializer\Exclude()
     */
    protected  $alterador;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Exclude()
     */
    protected  $criacao;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Exclude()
     */
    protected  $alteracao;

    /**
     * @return mixed
     */
    public function getCriador() {
        return $this->criador;
    }

    /**
     * @param mixed $criador
     * @return Registro
     */
    public function setCriador($criador) {
        $this->criador = $criador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlterador() {
        return $this->alterador;
    }

    /**
     * @param mixed $alterador
     * @return Registro
     */
    public function setAlterador($alterador) {
        $this->alterador = $alterador;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCriacao(): ?\DateTime {
        return $this->criacao;
    }

    /**
     * @param \DateTime $criacao
     * @return Registro
     */
    public function setCriacao(\DateTime $criacao) {
        $this->criacao = $criacao;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAlteracao(): ?\DateTime {
        return $this->alteracao;
    }

    /**
     * @param \DateTime $alteracao
     * @return Registro
     */
    public function setAlteracao(\DateTime $alteracao) {
        $this->alteracao = $alteracao;
        return $this;
    }



}