<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/06/2018
 * Time: 11:00
 */

namespace App\Manager;


use App\Entity\Dr;
use App\Entity\Google\Evento;
use App\Entity\Usuario;
use App\Utils\DateUtils;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EventoManager extends AbstractGoogleManager
{
    /** @var Usuario  */
    private $usuarioLogado;

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em) {
        $this->usuarioLogado = $tokenStorage->getToken()->getUser();
        $this->em = $em;
    }

    public function postEvento(Evento $evento) {
        $this->em->persist($evento);
        $this->em->flush();
    }

    public function putEvento(Evento $evento) {
        $this->em->merge($evento);
        $this->em->flush();
    }

    public function removeEvento(Evento $evento) {
        $this->em->remove($evento);
        $this->em->flush();
    }

    public function getEventoById(string $id) {
        return $this->em->getRepository("App:Google\Evento")
            ->find($id);
    }

    public function listEventosGoogleToListEvento($list): array {
        $collection = array();
        foreach ($list as $eventoGoogle) {
            $evento = new Evento();
            $collection[] = $this->fromGoogleEntity($evento, $eventoGoogle);
        }
        return $collection;
    }

    /**
     * @param Evento $entity
     * @param \Google_Service_Calendar_Event $googleEntity
     * @return Evento $entity
     */
    public function fromGoogleEntity(&$entity, $googleEntity): void {
        parent::fromGoogleEntity($entity, $googleEntity);

        $entity->setInicio(DateUtils::formatDateTime($googleEntity->getStart()->getDateTime(), Dr::TIMEZONES[$this->usuarioLogado->getDr()->getEstado()]))
            ->setTermino(DateUtils::formatDateTime($googleEntity->getEnd()->getDateTime(), Dr::TIMEZONES[$this->usuarioLogado->getDr()->getEstado()]));
    }

    /**
     * @param Evento $entity
     * @return \Google_Service_Calendar_Event $googleEntity
     */
    public function toGoogleEntity(&$entity) {
        /** @var \Google_Service_Calendar_Event $googleEntity */
        $googleEntity = parent::toGoogleEntity($entity);

        if ($entity->getInicio() != null) {
            $start = new \Google_Service_Calendar_EventDateTime();
            $start->setTimeZone(Dr::TIMEZONES[$this->usuarioLogado->getDr()->getEstado()]);
            $start->setDateTime($entity->getInicio());
            $googleEntity->setStart($start);
        }

        if ($entity->getTermino() != null) {
            $end = new \Google_Service_Calendar_EventDateTime();
            $end->setTimeZone(Dr::TIMEZONES[$this->usuarioLogado->getDr()->getEstado()]);
            $end->setDateTime($entity->getTermino());
            $googleEntity->setEnd($end);
        }

        return $googleEntity;
    }
}