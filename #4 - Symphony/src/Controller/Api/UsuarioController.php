<?php

namespace App\Controller\Api;

use App\Business\UserBusiness;
use App\Exception\DominioException;
use App\Manager\UsuarioManager;
use App\Service\Google\UsuarioService;
use App\Utils\JsonApiResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use App\Entity\Google\Usuario;
use App\Utils\UsuarioLista;

/**
 * Class UsuarioController
 * @package AppBundle\Controller\Api
 * @Rest\Route("/usuario"))
 */
class UsuarioController extends FOSRestController
{

//    /**
//     * @Rest\Get("/dominio/{id}")
//     * @SWG\GET(
//     *     summary="Lista de usuários por domínio",
//     *     tags={"Usuário"},
//     *     @SWG\Parameter(name="id", in="path", type="string", description="Domínio para busca de usuários.", required=true),
//     *     @SWG\Parameter(name="next_page_token", in="query", type="string", description="Token para a próxima página da busca."),
//     *     @SWG\Parameter(name="max_result", in="query", type="string", default="100", description="Resultados por página."),
//     *     @SWG\Response(response=200, description="Lista de Usuários", @Model(type=UsuarioLista::class)),
//     * )
//     */
//    public function getAction(string $id,
//                              Request $request,
//                              UsuarioService $userService,
//                              UsuarioManager $userManager,
//                              UserBusiness $userBusiness,
//                              JsonApiResponse $jsonApiResponse) {
//
//        try {
//            if (!$userBusiness->isDominioValido($this->getUser(), $id))
//                throw new DominioException(Response::HTTP_FORBIDDEN);
//
//            $listUser = $userService->getUsers(
//                $id,
//                $request->query->get('next_page_token'),
//                $request->query->get('max_result')
//            );
//
//            $response = new UsuarioLista();
//            $response->setNextPageToken($listUser->nextPageToken);
//
//            $response->setUsers($userManager->listGoogleUserToListUser($listUser));
//
//            $serializer = $this->get('jms_serializer');
//            return new JsonResponse($serializer->serialize($response, 'json'), Response::HTTP_OK, [], true);
//        } catch (\Exception $exception) {
//            return $jsonApiResponse->getJsonError($exception);
//        }
//
//
//    }

    /**
     * @Rest\Get("/{id}")
     * @SWG\GET(
     *     summary="Busca um usuário pelo email",
     *     tags={"Usuário"},
     *     @SWG\Parameter(description="Email do usuário", format="string", in="path", name="id", required=true, type="string"),
     *     @SWG\Response(response=200, description="Retorna um usuário", @Model(type=Usuario::class)),
     *     @SWG\Response(response=404, description="Usuário não encontrado."),
     * )
     */
    public function idAction(string $id,
                             UsuarioService $userService,
                             UserBusiness $userBusiness,
                             UsuarioManager $usuarioManager,
                             JsonApiResponse $jsonApiResponse) {
        try {
            if (!$userBusiness->isDominioValido($this->getUser(), $id))
                throw new DominioException(Response::HTTP_FORBIDDEN);

            $user = $userService->getUser($id);
            $usuario = $usuarioManager->getGoogleUsuarioByEmail($id);
            if (!isset($usuario))
                $usuario = new Usuario();
            $usuario->fromGoogleEntity($user);
            $usuarioManager->postGoogleUsuario($usuario);
            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($usuario, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Post("/")
     * @SWG\Post(
     *     summary="Cadastra um usuário",
     *     tags={"Usuário"},
     *     @SWG\Parameter(name="Usuario", in="body", description="Json com os dados do usuário", required=true, @Model(type=Usuario::class)),
     *     @SWG\Response(response=200, description="Retorna o usuário cadastrado", @Model(type=Usuario::class)),
     *     @SWG\Response(response=409, description="Erro encontrado"),
     * )
     */
    public function postAction(Request $request,
                               UsuarioService $usuarioService,
                               UsuarioManager $usuarioManager,
                               UserBusiness $usuarioBusiness,
                               JsonApiResponse $jsonApiResponse) {
        try {
            /** @var \App\Entity\Usuario $usuarioLogado */
            $usuarioLogado = $this->getUser();
            $usuario = new Usuario();
            $usuario->fromRequest($request);
            $usuarioManager->geraDadosIniciais($usuario, $usuarioLogado);
            /** @var \Google_Service_Directory_User $googleEntity */
            $googleEntity = $usuario->toGoogleEntity();
            if (!$usuarioBusiness->isDominioValido($usuarioLogado, $usuario->getEmail()))
                throw new DominioException(Response::HTTP_FORBIDDEN);
            $usuarioGoogle = $usuarioService->insert($googleEntity);
            $novoUsuario = $usuario->fromGoogleEntity($usuarioGoogle);
            $usuarioManager->postGoogleUsuario($novoUsuario);
            return $novoUsuario;
        } catch (\Google_Service_Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Put("/{id}")
     * @SWG\Put(
     *     summary="Altera um usuário",
     *     tags={"Usuário"},
     *     @SWG\Parameter(description="Email do usuário", format="string", in="path", name="id", required=true, type="string"),
     *     @SWG\Parameter(name="Usuario", in="body", description="Json com os dados do usuário", required=true, @Model(type=Usuario::class)),
     *     @SWG\Response(response=200, description="Retorna o usuário atualizado", @Model(type=Usuario::class)),
     *     @SWG\Response(response=404, description="Usuário não encontrado.")
     * )
     */
    public function updateAction(string $id,
                                 Request $request,
                                 UsuarioService $userService,
                                 UsuarioManager $usuarioManager,
                                 UserBusiness $userBusiness,
                                 JsonApiResponse $jsonApiResponse) {
        try {
            if (!$userBusiness->isDominioValido($this->getUser(), $id))
                throw new DominioException(Response::HTTP_FORBIDDEN);
            $googleEntity = $userService->getUser($id);
            $usuario = $usuarioManager->getGoogleUsuarioByEmail($id);
            $usuario->fromGoogleEntity($googleEntity);
            $usuario->fromRequest($request);
            $googleEntity = $userService->update($usuario->toGoogleEntity());
            $usuarioManager->postGoogleUsuario($usuario);
            return $usuario->fromGoogleEntity($googleEntity);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{id}")
     * @SWG\Delete(
     *     summary="Remove um usuário",
     *     tags={"Usuário"},
     *     @SWG\Parameter(description="Email do usuário", format="string", in="path", name="id", required=true, type="string"),
     *     @SWG\Parameter(name="Usuario", in="body", description="Json com os dados do usuário", required=true, @Model(type=Usuario::class)),
     *     @SWG\Response(response=200, description="Retorna o usuário atualizado", @Model(type=Usuario::class)),
     *     @SWG\Response(response=404, description="Usuário não encontrado.",),
     * )
     */
    public function deleteAction(string $id,
                                 UsuarioService $userService,
                                 UsuarioManager $usuarioManager,
                                 UserBusiness $userBusiness,
                                 JsonApiResponse $jsonApiResponse) {
        try {
            if (!$userBusiness->isDominioValido($this->getUser(), $id))
                throw new DominioException(Response::HTTP_FORBIDDEN);
            $userService->deleteUser($id);
            $usuario = $usuarioManager->getGoogleUsuarioByEmail($id);
            if ($usuario)
                $usuarioManager->removeGoogleUsuario($usuario);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

}