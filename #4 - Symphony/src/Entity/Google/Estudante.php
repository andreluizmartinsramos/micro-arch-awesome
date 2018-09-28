<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 18/04/2018
 * Time: 15:49
 */

namespace App\Entity\Google;

use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;

/**
 * Class Estudante
 * @package App\Entity
 */
class Estudante
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Id google do curso.", readOnly=true)
     */
    private $cursoId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email ou ID google do estudante.", example="123456789 or maria.silva@sc.estudante.senai.br")
     */
    private $userId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome do Aluno.", readOnly=true, example="Maria da Silva")
     */
    private $nome;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email do Aluno.", readOnly=true, example="maria.silva@sc.estudante.senai.br")
     */
    private $email;

    /**
     * @return string
     */
    public function getCursoId(): string {
        return $this->cursoId;
    }

    /**
     * @param string $cursoId
     * @return Estudante
     */
    public function setCursoId(string $cursoId): Estudante {
        $this->cursoId = $cursoId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): string {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return Estudante
     */
    public function setUserId(string $userId): Estudante {
        $this->userId = $userId;
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
     * @return Estudante
     */
    public function setNome(string $nome): Estudante {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Estudante
     */
    public function setEmail(string $email): Estudante {
        $this->email = $email;
        return $this;
    }

    public static function fromGoogle(\Google_Service_Classroom_Student $student): Estudante {
        $googleEstudante = new Estudante();
        $googleEstudante->setCursoId($student->getCourseId())
            ->setUserId($student->getUserId());
        /** @var \Google_Service_Classroom_UserProfile $userProfile */
        $userProfile = $student->getProfile();
        $googleEstudante->setEmail($userProfile->getEmailAddress());
        /** @var \Google_Service_Classroom_Name $userName */
        $userName = $userProfile->getName();
        $googleEstudante->setNome($userName->getFullName());

        return $googleEstudante;
    }
}