<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 16/04/2018
 * Time: 15:41
 */

namespace App\Controller\Api;


use App\Manager\CalendarioManager;
use App\Manager\EventoManager;
use App\Service\Google\CalendarioService;
use App\Service\Google\EventoService;
use App\Utils\GrupoLista;
use App\Utils\JsonApiResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Google\Calendario;
use App\Entity\Google\Evento;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsuarioController
 * @package AppBundle\Controller\Api
 * @Rest\Route("/calendario"))
 */
class CalendarioController extends FOSRestController
{
    /**
     * @Rest\Get("/{idCalendario}")
     * @SWG\Get(
     *     summary="Busca um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Response(response=200, description="Calendário", @Model(type=Calendario::class)),
     *     @SWG\Response(response=404, description="Calendário não encontrado")
     * )
     */
    public function getAction(string $idCalendario,
                              CalendarioManager $calendarioManager,
                              CalendarioService $calendarioService,
                              JsonApiResponse $jsonApiResponse) {
        try {
            $googleEntity = $calendarioService->getCalendario($idCalendario);
            $calendario = $calendarioManager->getGoogleCalendarioById($idCalendario);
            if (!isset($calendario))
                $calendario = new Calendario();
            $calendarioManager->fromGoogleEntity($calendario, $googleEntity);
            $calendarioManager->postGoogleCalendario($calendario);
            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($calendario, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Post("/")
     * @SWG\Post(
     *     summary="Salva um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="Calendário", in="body", description="Json com os dados do calendário", required=true, @Model(type=Calendario::class)),
     *     @SWG\Response(response=200, description="Calendário", @Model(type=Calendario::class)),
     *     @SWG\Response(response=409, description="Erro encontrado")
     * )
     */
    public function postAction(Request $request,
                               CalendarioManager $calendarioManager,
                               CalendarioService $calendarioService,
                               JsonApiResponse $jsonApiResponse) {
        try {
            $calendario = new Calendario();
            $calendarioManager->fromRequest($calendario, $request);
            $googleCalendario = $calendarioManager->toGoogleEntity($calendario);
            $novoCalendario = $calendarioService->postCalendario($googleCalendario);
            $calendarioManager->fromGoogleEntity($calendario, $novoCalendario);
            $calendarioManager->postGoogleCalendario($calendario);
            return $calendario;
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Put("/{idCalendario}")
     * @SWG\Put(
     *     summary="Altera um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="Calendário", in="body", description="Json com os dados do calendário", required=true, @Model(type=Calendario::class)),
     *     @SWG\Response(response=200, description="Calendário", @Model(type=Calendario::class)),
     *     @SWG\Response(response=404, description="Calendário não encontrado"),
     *     @SWG\Response(response=409, description="Erro encontrado")
     * )
     */
    public function putAction(string $idCalendario,
                              Request $request,
                              CalendarioManager $calendarioManager,
                              CalendarioService $calendarioService,
                              JsonApiResponse $jsonApiResponse) {
        try {
            $calendario = $calendarioManager->getGoogleCalendarioById($idCalendario);
            if (!isset($calendario))
                $calendario = new Calendario();
            $calendarioManager->fromRequest($calendario, $request);
            $googleEntity = $calendarioManager->toGoogleEntity($calendario);
            $calendarioService->patchCalendario($idCalendario, $googleEntity);
            $calendarioManager->postGoogleCalendario($calendario);
            return $calendario;
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{idCalendario}")
     * @SWG\Delete(
     *     summary="Remove um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Response(response=200, description="Calendário excluído."),
     *     @SWG\Response(response=404, description="Calendário não encontrado")
     * )
     */
    public function deleteAction(string $idCalendario,
                                 CalendarioManager $calendarioManager,
                                 CalendarioService $calendarioService,
                                 JsonApiResponse $jsonApiResponse) {
        try {
            $calendarioService->deleteCalendario($idCalendario);
            $calendario = $calendarioManager->getGoogleCalendarioById($idCalendario);
            $calendarioManager->removeGoogleCalendario($calendario);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Get("/{idCalendario}/evento")
     * @SWG\Get(
     *     summary="Lista os eventos de um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Response(response=200, description="Lista de eventos", @SWG\Schema(type="array",@Model(type=Evento::class))),
     *     @SWG\Response(response=404, description="Calendário não encontrado")
     * )
     */
    public function getAllEventoAction(string $idCalendario,
                                       Request $request,
                                       EventoManager $eventoManager,
                                       EventoService $eventoService,
                                       JsonApiResponse $jsonApiResponse) {
        try {

            $listEventosCalendario = $eventoService->getEventosCalendario(
                $idCalendario,
                $request->query->get('next_page_token'),
                $request->query->get('page_size')
            );

            $response = new GrupoLista();
            $response->setNextPageToken($listEventosCalendario->nextPageToken);

            $eventos = $eventoManager->listEventosGoogleToListEvento($listEventosCalendario->getItems());
            $response->setEventos($eventos);

            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($response, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Get("/{idCalendario}/evento/{idEvento}")
     * @SWG\Get(
     *     summary="Busca um evento em um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="idEvento", in="path", type="integer", description="Id do evento."),
     *     @SWG\Response(response=200, description="Evento", @Model(type=Evento::class)),
     *     @SWG\Response(response=404, description="Calendário ou Evento não encontrado")
     * )
     */
    public function getEventoAction(string $idCalendario,
                                    string $idEvento,
                                    EventoService $eventoService,
                                    EventoManager $eventoManager,
                                    JsonApiResponse $jsonApiResponse) {
        try {
            /** @var \Google_Service_Calendar_Event $googleEntity */
            $googleEntity = $eventoService->getEventoCalendario($idCalendario, $idEvento);

            $evento = new Evento();
            $eventoManager->fromGoogleEntity($evento, $googleEntity);

            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($evento, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Post("/{idCalendario}/evento")
     * @SWG\Post(
     *     summary="Adiciona um evento em um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="Evento", in="body", description="Json com os dados do evento", required=true, @Model(type=Evento::class)),
     *     @SWG\Response(response=200, description="Evento", @Model(type=Evento::class)),
     *     @SWG\Response(response=404, description="Calendário não encontrado"),
     *     @SWG\Response(response=409, description="Erro encontrado")
     * )
     */
    public function postEventoAction(string $idCalendario,
                                     Request $request,
                                     EventoManager $eventoManager,
                                     EventoService $eventoService,
                                     JsonApiResponse $jsonApiResponse) {
        try {
            $evento = new Evento();
            $eventoManager->fromRequest($evento, $request);
            $googleEvento = $eventoManager->toGoogleEntity($evento);
            $novoGoogleEvento = $eventoService->postEventoCalendario($idCalendario, $googleEvento);
            $eventoManager->fromGoogleEntity($evento, $novoGoogleEvento);
            $evento->setCalendarioId($idCalendario);
            $eventoManager->postEvento($evento);
            $serializer = $this->get('jms_serializer');
            return new JsonResponse($serializer->serialize($evento, 'json'), Response::HTTP_OK, [], true);
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Put("/{idCalendario}/evento/{idEvento}")
     * @SWG\Put(
     *     summary="Altera um evento em um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="idEvento", in="path", type="integer", description="Id do evento."),
     *     @SWG\Parameter(name="Evento", in="body", description="Json com os dados do evento", required=true, @Model(type=Evento::class)),
     *     @SWG\Response(response=200, description="Evento", @Model(type=Evento::class)),
     *     @SWG\Response(response=404, description="Calendário ou Evento não encontrado"),
     *     @SWG\Response(response=409, description="Erro encontrado",)
     * )
     */
    public function putEventoAction(string $idCalendario,
                                    string $idEvento,
                                    Request $request,
                                    EventoManager $eventoManager,
                                    EventoService $eventoService,
                                    JsonApiResponse $jsonApiResponse) {
        try {
            $evento = $eventoManager->getEventoById($idEvento);
            if (!isset($evento)) {
                $evento = new Evento();
                $evento->setCalendarioId($idCalendario);
            }
            $eventoManager->fromRequest($evento, $request);
            $googleEvento = $eventoManager->toGoogleEntity($evento);
            $novoGoogleEvento = $eventoService->patchEventoCalendario($idCalendario, $idEvento, $googleEvento);
            $eventoManager->fromGoogleEntity($evento, $novoGoogleEvento);
            $eventoManager->putEvento($evento);
            return $evento;
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{idCalendario}/evento/{idEvento}")
     * @SWG\Delete(
     *     summary="Remove um evento em um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="idEvento", in="path", type="integer", description="Id do evento."),
     *     @SWG\Response(response=200, description="Evento removido."),
     *     @SWG\Response(response="404", description="Evento não encontrado.")
     * )
     */
    public function removeEventoAction(string $idCalendario,
                                       string $idEvento,
                                       EventoService $eventoService,
                                       EventoManager $eventoManage,
                                       JsonApiResponse $jsonApiResponse) {
        try {
            $eventoService->deleteEventoCalendario($idCalendario, $idEvento);
            $evento = $eventoManage->getEventoById($idEvento);
            $eventoManage->removeEvento($evento);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Post("/{idCalendario}/usuario/{idUsuario}")
     * @SWG\Post(
     *     summary="Adiciona um usuario em um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="idUsuario", in="path", type="integer", description="Email do usuário."),
     *     @SWG\Response(response=200, description="Calendário", @Model(type=Calendario::class)),
     *     @SWG\Response(response=404, description="Calendário não encontrado"),
     *     @SWG\Response(response=409, description="Erro encontrado")
     * )
     */
    public function postUsuarioAction(string $idCalendario,
                                      string $idUsuario,
                                      CalendarioManager $calendarioManager,
                                      CalendarioService $calendarioService,
                                      JsonApiResponse $jsonApiResponse) {
        try {
            $calendarioService->addUsuarioCalendario($idCalendario, $idUsuario);
            $calendarioManager->addUsuarioCalendarioById($idCalendario, $idUsuario);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Usuário adicionado com Sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }

    /**
     * @Rest\Delete("/{idCalendario}/usuario/{idUsuario}")
     * @SWG\Delete(
     *     summary="Remove um usuario de um calendário",
     *     tags={"Calendario"},
     *     @SWG\Parameter(name="idCalendario", in="path", type="integer", description="Id do calendário."),
     *     @SWG\Parameter(name="idUsuario", in="path", type="integer", description="Email do usuário."),
     *     @SWG\Response(response=200, description="Usuario removido."),
     *     @SWG\Response(response="404", description="Usuario não encontrado.")
     * )
     */
    public function removeUsuarioAction(string $idCalendario,
                                        string $idUsuario,
                                        CalendarioService $calendarioService,
                                        CalendarioManager $calendarioManager,
                                        JsonApiResponse $jsonApiResponse) {
        try {
            $calendarioService->removeUsuarioCalendario($idCalendario, $idUsuario);
            $calendarioManager->removeUsuarioCalendarioById($idCalendario, $idUsuario);
            return JsonApiResponse::getJsonSucesso(Response::HTTP_OK, 'Excluído com sucesso.', "Sucesso");
        } catch (\Exception $exception) {
            return $jsonApiResponse->getJsonError($exception);
        }
    }
}