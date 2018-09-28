<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 28/02/2018
 * Time: 10:23
 */

namespace App\Entity\Google;

use App\Utils\GoogleEntityAbstract;
use App\Utils\ApiEntityInterface;
use App\Utils\StringUtils;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;
use App\Annotation\GoogleEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Usuario
 * @package AppBundle\Entity
 * @GoogleEntity\Entity(googleClass="\Google_Service_Directory_User")
 * @ORM\Entity()
 * @ORM\Table(name="google.usuario")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Usuario extends GoogleEntityAbstract
{
    const MAIN_DOMAIN = 'edu.senai.br';
    const TIPO_DOCENTE = 'docente';
    const TIPO_ESTUDATE = 'estudante';

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(enum={"docente", "estudante"},description="tipo do usuário")
     * @GoogleEntity\Property(googleFieldName="tipo", schema="geral")
     * @ORM\Column(type="string", nullable=true)
     */
    private $tipo;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email gerado pelo google.", example="joao.silva@sc.docente.senai.br", readOnly=true)
     * @GoogleEntity\Property(googleFieldName="primaryEmail")
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome completo do usuário.", example="João da Silva", required={"true"})
     * @GoogleEntity\Request(method="setNome")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $nome;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email Secundario do usuário.", example="joao.silva@sc.senai.br")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $emailComplementar;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome completo da mãe do usuário.", example="Maria da Silva")
     * @GoogleEntity\Property(googleFieldName="nome_mae", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $nomeMae;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome completo do pai do usuário.", example="Pedro da Silva")
     * @GoogleEntity\Property(googleFieldName="nome_pai", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $nomePai;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email do Responsável pelo usuário.", example="pai.joao.silva@sc.senai.br")
     * @GoogleEntity\Property(googleFieldName="email_responsavel", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $emailResponsavel;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Data de nascimento do usuário.", example="1958-03-01")
     * @GoogleEntity\Property(googleFieldName="data_nascimento", schema="geral")
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $dataNascimento;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="CPF do usuário.", example="000.000.000-00")
     * @GoogleEntity\Property(googleFieldName="cpf", schema="geral")
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $cpf;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Celular do usuário.", example="99 99999-9999")
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $celular;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Celular do usuário.", example="99 99999-9999")
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     * @Serializer\Type("integer")
     * @SWG\Property(description="Matrícula do usuário no SGE.", example="12345")
     * @GoogleEntity\Property(googleFieldName="matricula", schema="sge")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matricula;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Unidade do usuário.", example="SENAI - Tubarão")
     * @GoogleEntity\Property(googleFieldName="unidade", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $unidade;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Gênero do usuário.", enum={"M", "F"}, example="M")
     * @GoogleEntity\Property(googleFieldName="genero", schema="geral")
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $genero;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Escolaridade do usuário.", example="Ensino Superior Completo")
     * @GoogleEntity\Property(googleFieldName="escolaridade", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true, nullable=true)
     */
    private $escolaridade;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Cidade do usuário.", example="Tubarão")
     * @GoogleEntity\Property(googleFieldName="cidade", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $cidade;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Estado do usuário.", example="Santa Catarina")
     * @GoogleEntity\Property(googleFieldName="estado", schema="geral")
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $estado;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Senha com letras maiúsculas, minúsculas e números.", readOnly=true, example="$eNh@F0rT3")
     * @GoogleEntity\Property(googleFieldName="password")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $password;

    /**
     * @var int
     * @Serializer\Type("int")
     * @SWG\Property(description="Id da Plataforma do usuário. (Reservado à aplicações do DN)", example=1000)
     * @GoogleEntity\Property(googleFieldName="id_plataforma", schema="msd")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idPlataforma;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Perfil do usuário no MSD. (Reservado à aplicações do DN)", example="docente")
     * @GoogleEntity\Property(googleFieldName="perfil", schema="msd")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $perfil;

    /**
     * @var boolean
     * @Serializer\Type("boolean")
     * @SWG\Property(description="Mostra se o usuário está inativo no sistema.", example=false)
     * @GoogleEntity\Property(googleFieldName="suspended")
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $inativo;

    /**
     * @var string
     * @GoogleEntity\Property(googleFieldName="orgUnitPath")
     * @Serializer\Exclude()
     */
    private $caminhoOrganizacao;

    /**
     * @var string
     * @GoogleEntity\Property(googleFieldName="changePasswordAtNextLogin")
     * @Serializer\Exclude()
     */
    private $alteraEmailPrimeiroLogin;

    /**
     * @var string
     * @Serializer\Exclude()
     */
    private $primeiroNome;

    /**
     * @var string
     * @Serializer\Exclude()
     */
    private $sobreNome;

    /**
     * @ORM\ManyToMany(targetEntity="Calendario")
     * @ORM\JoinTable(name="google.usuario_calendario",
     *      joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="calendario_id", referencedColumnName="id")}
     *      )
     */
    private $calendarios;

    public function __construct() {
        $this->calendarios = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Usuario
     */
    public function setEmail(string $email): Usuario {
        $this->email = $email;
        $dominio = $this->getDominioFromEmail($this->getEmail());
        $this->caminhoOrganizacao = $this->OrgUnitPath($dominio);
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Usuario
     */
    public function setNome(string $nome): Usuario {
        $this->nome = $nome;
        $this->primeiroNome = StringUtils::primeiroNome($nome);
        $this->sobreNome = StringUtils::sobreNome($nome);
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailComplementar(): ?string {
        return $this->emailComplementar;
    }

    /**
     * @param string $emailComplementar
     * @return Usuario
     */
    public function setEmailComplementar(?string $emailComplementar): Usuario {
        $this->emailComplementar = $emailComplementar;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomeMae(): string {
        return $this->nomeMae;
    }

    /**
     * @param string $nomeMae
     * @return Usuario
     */
    public function setNomeMae(string $nomeMae): Usuario {
        $this->nomeMae = $nomeMae;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomePai(): string {
        return $this->nomePai;
    }

    /**
     * @param string $nomePai
     * @return Usuario
     */
    public function setNomePai(string $nomePai): Usuario {
        $this->nomePai = $nomePai;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailResponsavel(): string {
        return $this->emailResponsavel;
    }

    /**
     * @param string $emailResponsavel
     * @return Usuario
     */
    public function setEmailResponsavel(string $emailResponsavel): Usuario {
        $this->emailResponsavel = $emailResponsavel;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataNascimento(): string {
        return $this->dataNascimento;
    }

    /**
     * @param string $dataNascimento
     * @return Usuario
     */
    public function setDataNascimento(string $dataNascimento): Usuario {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return Usuario
     */
    public function setCpf(string $cpf): Usuario {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getCelular() {
        return $this->celular;
    }

    /**
     * @param string $celular
     * @return Usuario
     */
    public function setCelular(string $celular): Usuario {
        $this->celular = $celular;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone() {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return Usuario
     */
    public function setTelefone(string $telefone): Usuario {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getMatricula(): string {
        return $this->matricula;
    }

    /**
     * @param string $matricula
     * @return Usuario
     */
    public function setMatricula(string $matricula): Usuario {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnidade(): string {
        return $this->unidade;
    }

    /**
     * @param string $unidade
     * @return Usuario
     */
    public function setUnidade(string $unidade): Usuario {
        $this->unidade = $unidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getGenero(): ?string {
        return $this->genero;
    }

    /**
     * @param string $genero
     * @return Usuario
     */
    public function setGenero(string $genero): Usuario {
        $this->genero = $genero;
        return $this;
    }

    /**
     * @return string
     */
    public function getEscolaridade(): string {
        return $this->escolaridade;
    }

    /**
     * @param string $escolaridade
     * @return Usuario
     */
    public function setEscolaridade(string $escolaridade): Usuario {
        $this->escolaridade = $escolaridade;
        return $this;
    }

    /**
     * @return string
     */
    public function getCidade(): string {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     * @return Usuario
     */
    public function setCidade(string $cidade): Usuario {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstado(): string {
        return $this->estado;
    }

    /**
     * @param string $estado
     * @return Usuario
     */
    public function setEstado(string $estado): Usuario {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Usuario
     */
    public function setPassword(string $password): Usuario {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPlataforma(): int {
        return $this->idPlataforma;
    }

    /**
     * @param int $idPlataforma
     * @return Usuario
     */
    public function setIdPlataforma(int $idPlataforma): Usuario {
        $this->idPlataforma = $idPlataforma;
        return $this;
    }

    /**
     * @return string
     */
    public function getPerfil(): string {
        return $this->perfil;
    }

    /**
     * @param string $perfil
     * @return Usuario
     */
    public function setPerfil(string $perfil): Usuario {
        $this->perfil = $perfil;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo(): string {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return Usuario
     */
    public function setTipo(string $tipo): Usuario {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInativo(): bool {
        return $this->inativo;
    }

    /**
     * @param bool $inativo
     * @return Usuario
     */
    public function setInativo(bool $inativo): Usuario {
        $this->inativo = $inativo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaminhoOrganizacao(): string {
        return $this->caminhoOrganizacao;
    }

    /**
     * @param string $caminhoOrganizacao
     * @return Usuario
     */
    public function setCaminhoOrganizacao(string $caminhoOrganizacao): Usuario {
        $this->caminhoOrganizacao = $caminhoOrganizacao;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlteraEmailPrimeiroLogin(): string {
        return $this->alteraEmailPrimeiroLogin;
    }

    /**
     * @param string $alteraEmailPrimeiroLogin
     * @return Usuario
     */
    public function setAlteraEmailPrimeiroLogin(string $alteraEmailPrimeiroLogin): Usuario {
        $this->alteraEmailPrimeiroLogin = $alteraEmailPrimeiroLogin;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrimeiroNome(): ?string {
        return $this->primeiroNome;
    }

    /**
     * @param string $primeiroNome
     * @return Usuario
     */
    public function setPrimeiroNome(string $primeiroNome): Usuario {
        $this->primeiroNome = $primeiroNome;
        return $this;
    }

    /**
     * @return string
     */
    public function getSobreNome(): ?string {
        return $this->sobreNome;
    }

    /**
     * @param string $sobreNome
     * @return Usuario
     */
    public function setSobreNome(string $sobreNome): Usuario {
        $this->sobreNome = $sobreNome;
        return $this;
    }

    /**
     * @return Collection|Calendario[]
     */
    public function getCalendarios(): ?Collection {
        return $this->calendarios;
    }


    public function addCalendario(Calendario $calendario): self {
        if (!$this->calendarios->contains($calendario)) {
            $this->calendarios[] = $calendario;
        }

        return $this;
    }

    public function removeCalendario(Calendario $calendario): self {
        if ($this->calendarios->contains($calendario)) {
            $this->calendarios->removeElement($calendario);
        }

        return $this;
    }


    private function OrgUnitPath(string $dominio): string {
        return "/" . $this->getParentOrgPath($dominio) . "/" . $dominio;
    }

    private function getParentOrgPath($dominio): string {
        $primarySubDomain = explode('.', $dominio);
        return $parentDomain = $primarySubDomain[0] . '.' . Self::MAIN_DOMAIN;
    }

    private function getDominioFromEmail($email): string {
        $partesEmail = explode('@', $email);
        return $partesEmail[1];
    }

    public function isDocente(): bool {
        return $this->tipo == self::TIPO_DOCENTE;
    }

    public function isEstudante(): bool {
        return $this->tipo == self::TIPO_ESTUDATE;
    }

    private function setEmailComplementarFormatado($googleEntity) {
        $emails = (array)$googleEntity->getEmails();
        foreach ($emails as $email) {
            if (isset($email["type"]) && $email["type"] == "home")
                $this->emailComplementar = $email["address"];
        }
    }

    private function setTelefones($googleEntity) {
        $phones = (array)$googleEntity->getPhones();
        foreach ($phones as $phone) {
            if (isset($phone["type"])) {
                if ($phone["type"] == "home")
                    $this->telefone = $phone["value"];
                if ($phone["type"] == "mobile")
                    $this->celular = $phone["value"];
            }
        }
    }

    /**
     * @param \Google_Service_Directory_User $googleEntity
     * @return $this
     */
    public function fromGoogleEntity($googleEntity) {
        parent::fromGoogleEntity($googleEntity);
        $this->nome = $googleEntity->getName()->getFullName();
        $this->setEmailComplementarFormatado($googleEntity);
        $this->setTelefones($googleEntity);
        return $this;
    }

    public function toGoogleEntity() {
        /** @var \Google_Service_Directory_User $googleEntity */
        $googleEntity = parent::toGoogleEntity();
        $googleEntity->setName($this->getFullName());
        $googleEntity->setPhones($this->getPhones());
        $googleEntity->setEmails($this->getSecundaryEmail());
        return $googleEntity;
    }

    private function getPhones(): array {
        $phones = [];
        if ($this->telefone)
            $phones[] = [
                'type' => "home",
                'value' => $this->telefone
            ];
        if ($this->celular)
            $phones[] = [
                'type' => "mobile",
                'value' => $this->celular
            ];

        return $phones;
    }

    private function getFullName(): \Google_Service_Directory_UserName {
        $googleName = new \Google_Service_Directory_UserName();
        $googleName->setFamilyName($this->sobreNome);
        $googleName->setGivenName($this->primeiroNome);
        return $googleName;
    }

    private function getSecundaryEmail() {
        $emails = [];
        if ($this->emailComplementar)
            $emails[] = [
                'address' => $this->emailComplementar,
                'type' => "home"
            ];
        return $emails;
    }

}
