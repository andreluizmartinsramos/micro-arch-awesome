<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DrRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Dr
{

    const TIMEZONES = [
        'AC' => 'America/Rio_branco', 'AL' => 'America/Maceio', 'AP' => 'America/Belem', 'AM' => 'America/Manaus',
        'BA' => 'America/Bahia', 'CE' => 'America/Fortaleza', 'DF' => 'America/Sao_Paulo', 'ES' => 'America/Sao_Paulo',
        'GO' => 'America/Sao_Paulo', 'MA' => 'America/Fortaleza', 'MT' => 'America/Cuiaba', 'MS' => 'America/Campo_Grande',
        'MG' => 'America/Sao_Paulo', 'PR' => 'America/Sao_Paulo', 'PB' => 'America/Fortaleza', 'PA' => 'America/Belem',
        'PE' => 'America/Recife', 'PI' => 'America/Fortaleza', 'RJ' => 'America/Sao_Paulo', 'RN' => 'America/Fortaleza',
        'RS' => 'America/Sao_Paulo', 'RO' => 'America/Porto_Velho', 'RR' => 'America/Boa_Vista', 'SC' => 'America/Sao_Paulo',
        'SE' => 'America/Maceio', 'SP' => 'America/Sao_Paulo', 'TO' => 'America/Araguaia',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DominioDr", mappedBy="dr")
     */
    private $dominioDrs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Usuario", mappedBy="dr")
     */
    private $usuarios;

    public function __construct() {
        $this->dominioDrs = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }

    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome(): string {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Dr
     */
    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstado(): string {
        return mb_strtoupper($this->estado);
    }

    /**
     * @param string $estado
     * @return Dr
     */
    public function setEstado(string $estado): self {
        $this->estado = mb_strtoupper($estado);
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     * @return Dr
     */
    public function setTimeZone(string $timeZone): self {
        $this->timeZone = $timeZone;
        return $this;
    }


    /**
     * @return Collection|DominioDr[]
     */
    public function getDominioDrs(): Collection {
        return $this->dominioDrs;
    }


    public function addDominioDr(DominioDr $dominioDr): self {
        if (!$this->dominioDrs->contains($dominioDr)) {
            $this->dominioDrs[] = $dominioDr;
            $dominioDr->setDr($this);
        }

        return $this;
    }

    public function removeDominioDr(DominioDr $dominioDr): self {
        if ($this->dominioDrs->contains($dominioDr)) {
            $this->dominioDrs->removeElement($dominioDr);
            // set the owning side to null (unless already changed)
            if ($dominioDr->getDr() === $this) {
                $dominioDr->setDr(null);
            }
        }

        return $this;
    }

    /**
     * @return Usuario[]
     */
    public function getUsuarios(): Collection {
        return $this->usuarios;
    }

    public function getDominioPrincipalDocente(): ?string {
        /** @var DominioDr $dominioDr */
        foreach ($this->dominioDrs as $dominioDr) {
            if ($dominioDr->getPrincipal() && $dominioDr->isTipoDocente())
                return $dominioDr->getDominio();
        }
        return null;
    }

    public function getDominioPrincipalEstudante(): ?string {
        /** @var DominioDr $dominioDr */
        foreach ($this->dominioDrs as $dominioDr) {
            if ($dominioDr->getPrincipal() && $dominioDr->isTipoEstudante())
                return $dominioDr->getDominio();
        }
        return null;
    }

    public function addUsuario(Usuario $usuario): self {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->setDr($this);
        }

        return $this;
    }

    public function removeUsuairo(Usuario $usuario): self {
        if ($this->usuario->contains($usuario)) {
            $this->usuario->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getDr() === $this) {
                $usuario->setDr(null);
            }
        }

        return $this;
    }


}
