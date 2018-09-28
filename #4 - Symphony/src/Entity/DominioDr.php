<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DominioDrRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class DominioDr
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dr", inversedBy="dominioDrs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dominio;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $principal = false;

    /**
     * @ORM\Column(type="string", length=30, nullable=true, columnDefinition="VARCHAR(30) CHECK (tipo IN ('docente','estudante'))")
     */
    private $tipo;

    public function getId(): int {
        return $this->id;
    }

    /**
     * @return Dr
     */
    public function getDr(): ?Dr {
        return $this->dr;
    }

    /**
     * @param Dr $dr
     * @return DominioDr
     */
    public function setDr(Dr $dr): self {
        $this->dr = $dr;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDominio(): ?string {
        return $this->dominio;
    }

    /**
     * @param mixed $dominio
     * @return DominioDr
     */
    public function setDominio($dominio) {
        $this->dominio = $dominio;
        return $this;
    }

    /**
     * @return bool
     */
    public function getPrincipal(): ?bool {
        return $this->principal;
    }

    /**
     * @param bool $principal
     * @return DominioDr
     */
    public function setPrincipal(bool $principal): self {
        $this->principal = $principal;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo(): string {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     * @return DominioDr
     */
    public function setTipo(string $tipo): self {
        $this->tipo = $tipo;
        return $this;
    }

    public function isTipoDocente() {
        return $this->tipo == \App\Entity\Google\Usuario::TIPO_DOCENTE;
    }

    public function isTipoEstudante() {
        return $this->tipo == \App\Entity\Google\Usuario::TIPO_ESTUDATE;
    }


}
