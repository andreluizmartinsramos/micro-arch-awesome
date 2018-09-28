<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 07/05/2018
 * Time: 15:15
 */

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Business\UserBusiness;
use App\Entity\Google\Grupo;
use App\Exception\DominioException;
use App\Manager\GrupoManager;
use App\Service\Google\GrupoService;
use App\Utils\JsonApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GrupoController
 * @package App\Controller\Api
 * * @Rest\Route("/grupo"))
 */
class GrupoController extends FOSRestController
{

//    /**
//     * @Rest\Get("/{idGrupo}")
//     * @SWG\GET(
//     *     summary="Busca um grupo pelo id",
//     *     tags={"Grupo"},
//     *     @SWG\Parameter(description="Id ou Email do grupo", format="string", in="path", name="id", required=true, type="string"),
//     *     @SWG\Response(response=200, description="Retorna um usuário", @Model(type=Grupo::class)),
//     *     @SWG\Response(response=404, description="Usuário não encontrado."),
//     * )
//     */
//    public function idAction(string $idGrupo,
//                             GrupoService $grupoService,
//                             UserBusiness $userBusiness,
//                             JsonApiResponse $jsonApiResponse) {
//        try {
//            $grupo = $grupoService->get($idGrupo);
//            if (!$userBusiness->isDominioValido($this->getUser(), $grupo->getEmail()))
//                throw new DominioException(Response::HTTP_FORBIDDEN);
//            $serializer = $this->get('jms_serializer');
//            return new JsonResponse($serializer->serialize(Grupo::fromGoogle($grupo), 'json'), Response::HTTP_OK, [], true);
//        } catch (\Exception $exception) {
//            return $jsonApiResponse->getJsonError($exception);
//        }
//    }
//
//    /**
//     * @Rest\Post("/")
//     * @SWG\Post(
//     *     summary="Cadastra um grupo",
//     *     tags={"Grupo"},
//     *     @SWG\Parameter(name="Grupo", in="body", description="Json com os dados do grupo", required=true, @Model(type=Grupo::class)),
//     *     @SWG\Response(response=200, description="Retorna o grupo cadastrado", @Model(type=Grupo::class)),
//     *     @SWG\Response(response=409, description="Erro encontrado"),
//     * )
//     */
//    public function postAction(Request $request,
//                               GrupoManager $grupoManager,
//                               GrupoService $grupoService,
//                               UserBusiness $userBusiness,
//                               JsonApiResponse $jsonApiResponse) {
//        try {
//        $googleGrupo = $grupoManager->getGrupoFromRequest($request);
//        if (!$userBusiness->isDominioValido($this->getUser(), $googleGrupo->getEmail()))
//            throw new DominioException(Response::HTTP_FORBIDDEN);
//        return Grupo::fromGoogle($grupoService->post($googleGrupo));
//        } catch (\Exception $exception) {
//            return $jsonApiResponse->getJsonError($exception);
//        }
//    }
//
//    /**
//     * @Rest\Put("/{idGrupo}")
//     * @SWG\Put(
//     *     summary="Altera um grupo",
//     *     tags={"Grupo"},
//     *     @SWG\Parameter(description="Id ou Email do grupo", format="string", in="path", name="id", required=true, type="string"),
//     *     @SWG\Parameter(name="Grupo", in="body", description="Json com os dados do usuário", required=true, @Model(type=Grupo::class)),
//     *     @SWG\Response(response=200, description="Retorna o usuário atualizado", @Model(type=Grupo::class)),
//     *     @SWG\Response(response=404, description="Usuário não encontrado.")
//     * )
//     */
//    public function updateAction(string $idGrupo,
//                                 Request $request,
//                                 GrupoService $grupoService,
//                                 GrupoManager $grupoManager,
//                                 UserBusiness $userBusiness,
//                                 JsonApiResponse $jsonApiResponse) {
//        try {
//            $grupo = $grupoService->get($idGrupo);
//            if (!$userBusiness->isDominioValido($this->getUser(), $grupo->getEmail()))
//                throw new DominioException(Response::HTTP_FORBIDDEN);
//            return Grupo::fromGoogle($grupoService->update($idGrupo, $grupoManager->getGrupoFromRequest($request, $grupo)));
//        } catch (\Exception $exception) {
//            return $jsonApiResponse->getJsonError($exception);
//        }
//    }
//
//    /**
//     * @Rest\Delete("/{idGrupo}")
//     * @SWG\Delete(
//     *     summary="Remove um grupo",
//     *     tags={"Grupo"},
//     *     @SWG\Parameter(description="Id ou email do grupo", format="string", in="path", name="id", required=true, type="string"),
//     *     @SWG\Parameter(name="Grupo", in="body", description="Json com os dados do grupo", required=true, @Model(type=Grupo::class)),
//     *     @SWG\Response(response=200, description="Retorna o grupo atualizado", @Model(type=Grupo::class)),
//     *     @SWG\Response(response=404, description="Grupo não encontrado."),
//     * )
//     */
//    public function deleteAction(string $idGrupo,
//                                 GrupoService $grupoService,
//                                 UserBusiness $userBusiness,
//                                 JsonApiResponse $jsonApiResponse) {
//        try {
//            $grupo = $grupoService->get($idGrupo);
//            if (!$userBusiness->isDominioValido($this->getUser(), $grupo->getEmail()))
//                throw new DominioException(Response::HTTP_FORBIDDEN);
//            $grupoService->delete($idGrupo);
//            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
//        } catch (\Exception $exception) {
//            return $jsonApiResponse->getJsonError($exception);
//        }
//    }
}