<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 19/04/2018
 * Time: 11:44
 */

namespace App\Service\Google;


class CursoService extends AdminConsoleService
{
    public function getCurso(string $idCurso) {
        return $this->getServiceClassroom()->courses->get($idCurso);
    }

    public function postCurso(\Google_Service_Classroom_Course $curso) {
        return $this->getServiceClassroom()->courses->create($curso);
    }

    public function updateCurso(string $idCurso, \Google_Service_Classroom_Course $curso) {
        return $this->getServiceClassroom()->courses->update($idCurso, $curso);
    }

    public function deleteCurso(int $idCurso) {
        return $this->getServiceClassroom()->courses->delete($idCurso);
    }

    public function getEstudanteCurso(string $idCurso, string $idEstudante) {
        return $this->getServiceClassroom()->courses_students->get($idCurso, $idEstudante);
    }

    public function getEstudantesCurso(string $idCurso, $pageToken = null, $pageSize = 100) {
        $optParams = [
            'pageToken' => $pageToken,
            'pageSize' => $pageSize,
        ];
        return $this->getServiceClassroom()->courses_students->listCoursesStudents($idCurso, $optParams);
    }

    public function addEstudanteCurso(string $idCurso, \Google_Service_Classroom_Student $estudante) {
        return $this->getServiceClassroom()->courses_students->create($idCurso, $estudante);
    }

    public function deleteEstudanteCurso(string $idCurso, string $idEstudante) {
        return $this->getServiceClassroom()->courses_students->delete($idCurso, $idEstudante);
    }

    public function getProfessoresCurso(string $idCurso, $pageToken = null, $pageSize = 100) {
        $optParams = [
            'pageToken' => $pageToken,
            'pageSize' => $pageSize,
        ];
        return $this->getServiceClassroom()->courses_teachers->listCoursesTeachers($idCurso, $optParams);
    }

    public function getProfessorCurso(string $idCurso, string $idProfessor) {
        return $this->getServiceClassroom()->courses_teachers->get($idCurso, $idProfessor);
    }

    public function addProfessorCurso(string $idCurso, \Google_Service_Classroom_Teacher $professor) {
        return $this->getServiceClassroom()->courses_teachers->create($idCurso, $professor);
    }

    public function deleteProfessorCurso(string $idCurso, string $estudante) {
        return $this->getServiceClassroom()->courses_teachers->delete($idCurso, $estudante);
    }

    public function getProfileClassroom(string $id): \Google_Service_Classroom_UserProfile {
        return $this->getServiceClassroom()->userProfiles->get($id);
    }

}