<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/04/2018
 * Time: 15:00
 */

namespace App\Entity\Google;

use App\Utils\GoogleEntityAbstract;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;

/**
 * Class Curso
 * @package App\Entity
 */
class Curso extends GoogleEntityAbstract
{
    /**
     * @var int
     * @Serializer\Type("int")
     * @SWG\Property(description="Id google da Turma.", readOnly=true, example="123456789")
     */
    private $id;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome da Turma.", example="Matemética 2018/2")
     */
    private $nome;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Turno da Turma.", example="Matutino")
     */
    private $turno;

    /**
     * @var string
     */
    private $descricaoCabecalho;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Sala da Turma.", example="215A")
     */
    private $sala;

    /**
     * @var string
     */
    private $idDonoCurso;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Link para o Classroom.", readOnly=true, example="http://classroom.google.com/c/MTI1ODgzOTM0OTla")
     */
    private $linkAlternativo;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Grupo de Email dos Professores.", readOnly=true, example="professores-matematica-2018b@sc.docente.senai.br")
     */
    private $grupoEmailProfessores;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Grupo de Email do Curso.", readOnly=true, example="matematica-2018b@sc.docente.senai.br")
     */
    private $grupoEmailCurso;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Área do Curso.")
     */
    private $nomeArea;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Eixo tecnológico do Curso.")
     */
    private $eixoTecnologico;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome do Curso.")
     */
    private $nomeCurso;

    /**
     * @var string
     * @Serializer\Type("integer")
     * @SWG\Property(description="Código do Curso no SGE.")
     */
    private $codigoSge;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Código da matriz curricular do Curso (Grade).")
     */
    private $codigoMatrizCurricular;

    /**
     * @var string
     * @Serializer\Type("integer")
     * @SWG\Property(description="Código da disciplina do Curso no SGE.")
     */
    private $codigoDisciplina;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Unidade do Curso.")
     */
    private $unidade;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Curso
     */
    public function setId(int $id): Curso {
        $this->id = $id;
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
     * @return Curso
     */
    public function setNome(string $nome): Curso {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getTurno(): string {
        return $this->turno;
    }

    /**
     * @param string $turno
     * @return Curso
     */
    public function setTurno(string $turno = null): Curso {
        $this->turno = $turno;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricaoCabecalho(): string {
        return $this->descricaoCabecalho;
    }

    /**
     * @param string $descricaoCabecalho
     * @return Curso
     */
    public function setDescricaoCabecalho(string $descricaoCabecalho): Curso {
        $this->descricaoCabecalho = $descricaoCabecalho;
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
     * @return Curso
     */
    public function setDescricao(string $descricao): Curso {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return string
     */
    public function getSala(): string {
        return $this->sala;
    }

    /**
     * @param string $sala
     * @return Curso
     */
    public function setSala(string $sala = null): Curso {
        $this->sala = $sala;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdDonoCurso(): string {
        return $this->idDonoCurso;
    }

    /**
     * @param string $idDonoCurso
     * @return Curso
     */
    public function setIdDonoCurso(string $idDonoCurso): Curso {
        $this->idDonoCurso = $idDonoCurso;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinkAlternativo(): string {
        return $this->linkAlternativo;
    }

    /**
     * @param string $linkAlternativo
     * @return Curso
     */
    public function setLinkAlternativo(string $linkAlternativo): Curso {
        $this->linkAlternativo = $linkAlternativo;
        return $this;
    }

    /**
     * @return string
     */
    public function getGrupoEmailProfessores(): string {
        return $this->grupoEmailProfessores;
    }

    /**
     * @param string $grupoEmailProfessores
     * @return Curso
     */
    public function setGrupoEmailProfessores(string $grupoEmailProfessores): Curso {
        $this->grupoEmailProfessores = $grupoEmailProfessores;
        return $this;
    }

    /**
     * @return string
     */
    public function getGrupoEmailCurso(): string {
        return $this->grupoEmailCurso;
    }

    /**
     * @param string $grupoEmailCurso
     * @return Curso
     */
    public function setGrupoEmailCurso(string $grupoEmailCurso): Curso {
        $this->grupoEmailCurso = $grupoEmailCurso;
        return $this;
    }

    public static function fromGoogle(\Google_Service_Classroom_Course $classroom): Curso {
        $googleCourse = new Curso();

        $googleCourse->setId($classroom->getId())
            ->setNome($classroom->getName())
            ->setTurno($classroom->getSection())
            ->setDescricaoCabecalho($classroom->getDescriptionHeading())
            ->setDescricao($classroom->getDescription())
            ->setSala($classroom->getRoom())
            ->setIdDonoCurso($classroom->getOwnerId())
            ->setLinkAlternativo($classroom->getAlternateLink())
            ->setGrupoEmailProfessores($classroom->getTeacherGroupEmail())
            ->setGrupoEmailCurso($classroom->getCourseGroupEmail());

        return $googleCourse;
    }
}