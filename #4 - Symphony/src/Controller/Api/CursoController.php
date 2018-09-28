<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/04/2018
 * Time: 11:01
 */

namespace App\Controller\Api;

use App\Business\UserBusiness;
use App\Exception\DominioException;
use App\Manager\CursoManager;
use App\Service\Google\CursoService;
use App\Utils\JsonApiResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use App\Entity\Google\Curso;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Utils\EstudanteLista;
use App\Entity\Google\Estudante;
use App\Utils\ProfessorLista;
use App\Entity\Google\Professor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsuarioController
 * @package AppBundle\Controller\Api
 * @Rest\Route("/curso"))
 */
class CursoController extends FOSRestController
{

    /**
     * @Rest\Get("/{idCurso}")
     * @SWG\Get(
     *     summary="Busca o curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Response(response=200, description="Lista de Cursos", @Model(type=Curso::class)),
     *     @SWG\Response(response=404, description="Curso não encontrado"),
     * )
     */
    public function idAction(string $idCurso,
                             CursoService $cursoService,
                             JsonApiResponse $jsonApiResponse,
                             UserBusiness $userBusiness) {
        try {
            $googleCourse = $cursoService->getCurso($idCurso);
            $userProfile = $cursoService->getProfileClassroom($googleCourse->getOwnerId());
            if (!$userBusiness->isDominioValido($this->getUser(), $userProfile->getEmailAddress()))
                throw new DominioException(Response::HTTP_FORBIDDEN);
            $curso = Curso::fromGoogle($googleCourse);
            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($curso, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Post("/")
     * @SWG\Post(
     *     summary="Cadastra um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter( name="Curso", in="body", description="Json com os dados do curso", required=true, @Model(type=Curso::class)),
     *     @SWG\Response(response=200, description="Curso Salvo", @Model(type=Curso::class)),
     *     @SWG\Response(response=409, description="Erro encontrado"),
     * )
     */
    public function postAction(Request $request,
                               CursoService $cursoService,
                               CursoManager $cursoManager,
                               JsonApiResponse $jsonApiResponse,
                               UserBusiness $userBusiness) {
        try {
            $googleCourse = $cursoManager->getCursoFromRequest($request);
            $userProfile = $cursoService->getProfileClassroom($googleCourse->getOwnerId());
            if (!$userBusiness->isDominioValido($this->getUser(), $userProfile->getEmailAddress()))
                throw new DominioException(Response::HTTP_FORBIDDEN);
            return Curso::fromGoogle($cursoService->postCurso($googleCourse));
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Put("/{idCurso}")
     * @SWG\Put(
     *     summary="Atualiza um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Parameter( name="Curso", in="body", description="Json com os dados do curso", required=true, @Model(type=Curso::class)),
     *     @SWG\Response(response=200, description="Curso Salvo", @Model(type=Curso::class)),
     *     @SWG\Response(response=409, description="Erro encontrado"),
     *     @SWG\Response(response=404, description="Curso não encontrado"),
     * )
     */
    public function putAction(string $idCurso,
                              Request $request,
                              CursoService $cursoService,
                              CursoManager $cursoManager,
                              JsonApiResponse $jsonApiResponse,
                              UserBusiness $userBusiness) {
        try {
            $googleCourse = $cursoService->getCurso($idCurso);
            $userProfile = $cursoService->getProfileClassroom($googleCourse->getOwnerId());
            if (!$userBusiness->isDominioValido($this->getUser(), $userProfile->getEmailAddress()))
                throw new DominioException(Response::HTTP_FORBIDDEN);
            return Curso::fromGoogle($cursoService->updateCurso($idCurso, $cursoManager->getCursoFromRequest($request, $googleCourse)));
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{idCurso}")
     * @SWG\Delete(
     *     summary="Remove um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Response(response=200, description="Curso removido"),
     *     @SWG\Response(response=404, description="Curso não encontrado"),
     * )
     */
    public function deleteAction(string $idCurso,
                                 CursoService $cursoService,
                                 JsonApiResponse $jsonApiResponse) {
        try {
            $cursoService->deleteCurso($idCurso);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Get("/{idCurso}/estudante")
     * @SWG\Get(
     *     summary="Lista os estudantes de um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="email", in="query", type="string", description="Email do professor."),
     *     @SWG\Parameter(name="next_page_token", in="query", type="string", description="Token para a próxima página da busca."),
     *     @SWG\Parameter(name="page_size", in="query", type="integer", default="100", description="Resultados por página."),
     *     @SWG\Response(response=200, description="Lista de Cursos", @Model(type=EstudanteLista::class)),
     *     @SWG\Response(response=404, description="Curso não encontrado"),
     * )
     */
    public function getEstudanteAction(string $idCurso,
                                       Request $request,
                                       CursoService $cursoService,
                                       CursoManager $cursoManager,
                                       JsonApiResponse $jsonApiResponse) {
        try {
            $listEstudantesCurso = $cursoService->getEstudantesCurso(
                $idCurso,
                $request->query->get('next_page_token'),
                $request->query->get('page_size')
            );

            $response = new StudentResponse();
            $response->setNextPageToken($listEstudantesCurso->nextPageToken);

            $response->setEstudantes($cursoManager->listEstudanteGoogleToListEstudante($listEstudantesCurso));

            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($response, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }

    }

    /**
     * @Rest\Post("/{idCurso}/estudante")
     * @SWG\Post(
     *     summary="Adiciona um estudante em um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter( name="Estudante", in="body", description="Json com os dados do estudante", required=true, @Model(type=Estudante::class)),
     *     @SWG\Response(response=200, description="Estudante adicionado", @Model(type=Estudante::class)),
     *     @SWG\Response(response=409, description="Erro encontrado"),
     * )
     */
    public function postEstudanteAction(string $idCurso,
                                        Request $request,
                                        CursoService $cursoService,
                                        JsonApiResponse $jsonApiResponse,
                                        CursoManager $cursoManager) {
        try {
            return Estudante::fromGoogle($cursoService->addEstudanteCurso($idCurso, $cursoManager->getEstudanteFromRequest($request)));
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Get("/{idCurso}/estudante/{idEstudante}")
     * @SWG\Get(
     *     summary="Busca um estudante de um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Parameter(name="idEstudante", in="path", type="string", description="id do estudante."),
     *     @SWG\Response(response=200, description="Estudante", @Model(type=Estudante::class)),
     *     @SWG\Response(response=404, description="Curso ou Estudante não encontrado")
     * )
     */
    public function idEstudanteAction(string $idCurso,
                                      string $idEstudante,
                                      CursoService $cursoService,
                                      JsonApiResponse $jsonApiResponse) {
        try {
            /** @var \Google_Service_Classroom_Student $estudante */
            $estudante = $cursoService->getEstudanteCurso($idCurso, $idEstudante);

            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize(Estudante::fromGoogle($estudante), 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{idCurso}/estudante/{idEstudante}")
     * @SWG\Delete(
     *     summary="Remove um estudante de um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Parameter(name="idEstudante", in="path", type="string", description="id do curso."),
     *     @SWG\Response(response=200, description="Estudante removido."),
     *     @SWG\Response(response=404, description="Curso ou Estudante não encontrado"),
     * )
     */
    public function deleteEstudanteAction(string $idCurso,
                                          string $idEstudante,
                                          CursoService $cursoService,
                                          JsonApiResponse $jsonApiResponse) {
        try {
            $cursoService->deleteEstudanteCurso($idCurso, $idEstudante);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Get("/{idCurso}/professor")
     * @SWG\Get(
     *     summary="Lista os professores de um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Parameter(name="next_page_token", in="query", type="string", description="Token para a próxima página da busca."),
     *     @SWG\Parameter(name="max_result", in="query", type="integer", default="100", description="Resultados por página."),
     *     @SWG\Response(response=200, description="Lista de Professores do curso", @Model(type=ProfessorLista::class)),
     *     @SWG\Response(response=404, description="Lista de Cursos"),
     * )
     */
    public function getProfessorAction(string $idCurso,
                                       Request $request,
                                       CursoService $cursoService,
                                       CursoManager $cursoManager,
                                       JsonApiResponse $jsonApiResponse) {
        try {
            $listProfessoresCurso = $cursoService->getProfessoresCurso(
                $idCurso,
                $request->query->get('next_page_token'),
                $request->query->get('page_size')
            );

            $response = new TeachersResponse();
            $response->setNextPageToken($listProfessoresCurso->nextPageToken);

            $response->setProfessores($cursoManager->listProfessorGoogleToListProfessor($listProfessoresCurso));

            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($response, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Post("/{idCurso}/professor")
     * @SWG\Post(
     *     summary="Adiciona um professor em um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter( name="Professor", in="body", description="Json com os dados do professor", required=true, @Model(type=Professor::class)),
     *     @SWG\Response(response=200, description="Professor adicionado", @Model(type=Professor::class)),
     *     @SWG\Response(response=409, description="Erro encontrado"),
     * )
     */
    public function postProfessorAction(string $idCurso,
                                        Request $request,
                                        CursoService $cursoService,
                                        JsonApiResponse $jsonApiResponse,
                                        CursoManager $cursoManager) {
        try {
            return Professor::fromGoogle($cursoService->addProfessorCurso($idCurso, $cursoManager->getProfessorFromRequest($request)));
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Get("/{idCurso}/professor/{idProfessor}")
     * @SWG\Get(
     *     summary="Busca um professor de um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Parameter(name="idProfessor", in="path", type="string", description="id do professor."),
     *     @SWG\Response(response=200, description="Professor", @Model(type=Professor::class)),
     *     @SWG\Response(response=404, description="Curso ou Professor não encontrado")
     * )
     */
    public function idProfessorAction(string $idCurso,
                                      string $idProfessor,
                                      CursoService $cursoService,
                                      JsonApiResponse $jsonApiResponse) {
        try {
            /** @var \Google_Service_Classroom_Teacher $estudante */
            $estudante = $cursoService->getProfessorCurso($idCurso, $idProfessor);

            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize(Professor::fromGoogle($estudante), 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{idCurso}/professor/{idProfessor}")
     * @SWG\Delete(
     *     summary="Remove um professor de um curso",
     *     tags={"Curso"},
     *     @SWG\Parameter(name="idCurso", in="path", type="string", description="id do curso."),
     *     @SWG\Parameter(name="idProfessor", in="path", type="string", description="id do professor."),
     *     @SWG\Response(response=200, description="Professor removido."),
     *     @SWG\Response(response=404, description="Curso ou Professor não encontrado"),
     * )
     */
    public function deleteProfessorAction(string $idCurso,
                                          string $idProfessor,
                                          CursoService $cursoService,
                                          JsonApiResponse $jsonApiResponse) {
        try {
            $cursoService->deleteProfessorCurso($idCurso, $idProfessor);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }

    }
}