<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 19/04/2018
 * Time: 13:57
 */

namespace App\Manager;


use App\Entity\Google\Estudante;
use App\Entity\Google\Professor;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;

class CursoManager
{
    const NOME = 'nome';

    const TURNO = 'turno';

    const DESCRICAO_CABECALHO = 'descricao_cabecalho';

    const DESCRICAO = 'descricao';

    const SALA = 'sala';

    const ID_DONO_CURSO = 'id_dono_curso';

    const GRUPO_EMAIL_PROFESSORES = "grupo_email_professores";

    const GRUPO_EMAIL_CURSO = "grupo_email_curso";

    const USER_ID = "user_id";

    public function getCursoFromRequest(Request $request, \Google_Service_Classroom_Course $curso = null): \Google_Service_Classroom_Course {

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $data */
        $data = $request->request;

        if (!isset($curso)) {
            $curso = new \Google_Service_Classroom_Course();
        }

        if ($data->has(self::NOME))
            $curso->setName($data->get(self::NOME));

        if ($data->has(self::TURNO))
            $curso->setSection($data->get(self::TURNO));

        if ($data->has(self::DESCRICAO_CABECALHO))
            $curso->setDescriptionHeading($data->get(self::DESCRICAO_CABECALHO));

        if ($data->has(self::DESCRICAO))
            $curso->setDescription($data->get(self::DESCRICAO));

        if ($data->has(self::SALA))
            $curso->setRoom($data->get(self::SALA));

        if ($data->has(self::ID_DONO_CURSO))
            $curso->setOwnerId($data->get(self::ID_DONO_CURSO));

        if ($data->has(self::GRUPO_EMAIL_PROFESSORES))
            $curso->setTeacherGroupEmail($data->get(self::GRUPO_EMAIL_PROFESSORES));

        if ($data->has(self::GRUPO_EMAIL_CURSO))
            $curso->setCourseGroupEmail($data->get(self::GRUPO_EMAIL_CURSO));

        return $curso;
    }

    public function getEstudanteFromRequest(Request $request): \Google_Service_Classroom_Student {

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $data */
        $data = $request->request;

        $estudante = new \Google_Service_Classroom_Student();

        if ($data->has(self::USER_ID))
            $estudante->setUserId($data->get(self::USER_ID));

        return $estudante;
    }

    public function getProfessorFromRequest(Request $request): \Google_Service_Classroom_Teacher {

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $data */
        $data = $request->request;

        $professor = new \Google_Service_Classroom_Teacher();

        if ($data->has(self::USER_ID))
            $professor->setUserId($data->get(self::USER_ID));

        return $professor;
    }

    public function listEstudanteGoogleToListEstudante($list): ArrayCollection {
        $collection = new ArrayCollection();
        foreach ($list->students as $estudante) {
            $collection->add(Estudante::fromGoogle($estudante));
        }
        return $collection;
    }

    public function listProfessorGoogleToListProfessor($list): ArrayCollection {
        $collection = new ArrayCollection();
        foreach ($list->teachers as $teacher) {
            $collection->add(Professor::fromGoogle($teacher));
        }
        return $collection;
    }


}