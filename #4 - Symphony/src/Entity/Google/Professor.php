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
 * Class Professor
 * @package App\Entity
 */
class Professor
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
     * @SWG\Property(description="Id google do professor.", example="123456789 ou joao.silva@sc.docente.senai.br")
     */
    private $userId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome do Aluno.", readOnly=true, example="João da Silva")
     */
    private $nome;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email do Professor.", readOnly=true, example="joao.silva@sc.docente.senai.br")
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
     * @return Professor
     */
    public function setCursoId(string $cursoId): Professor {
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
     * @return Professor
     */
    public function setUserId(string $userId): Professor {
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
     * @return Professor
     */
    public function setNome(string $nome): Professor {
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
     * @return Professor
     */
    public function setEmail(string $email): Professor {
        $this->email = $email;
        return $this;
    }

    public static function fromGoogle(\Google_Service_Classroom_Teacher $teacher): Professor {
        $googleProfessor = new Professor();
        $googleProfessor->setCursoId($teacher->getCourseId())
            ->setUserId($teacher->getUserId());
        /** @var \Google_Service_Classroom_UserProfile $userProfile */
        $userProfile = $teacher->getProfile();
        $googleProfessor->setEmail($userProfile->getEmailAddress());
        /** @var \Google_Service_Classroom_Name $userName */
        $userName = $userProfile->getName();
        $googleProfessor->setNome($userName->getFullName());

        return $googleProfessor;
    }
}