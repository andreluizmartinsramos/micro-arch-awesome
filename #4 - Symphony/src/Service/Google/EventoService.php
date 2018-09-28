<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/06/2018
 * Time: 11:11
 */

namespace App\Service\Google;


class EventoService extends AdminConsoleService
{

    /** @var \Google_Service_Calendar  */
    private $serviceCalendar;

    public function __construct(\Google_Client $googleClient) {
        parent::__construct($googleClient);
        $this->serviceCalendar = new \Google_Service_Calendar($this->getGoogleClient());
    }

    public function getEventosCalendario(string $idCalendario, $pageToken = null, $pageSize = 100): \Google_Service_Calendar_Events {
        $optParams = [
            'pageToken' => $pageToken,
            'maxResults' => $pageSize,
        ];
        return $this->serviceCalendar->events->listEvents($idCalendario, $optParams);
    }

    public function getEventoCalendario(string $idCalendario, string $idEvento): \Google_Service_Calendar_Event {
        return $this->serviceCalendar->events->get($idCalendario, $idEvento);
    }

    public function postEventoCalendario(string $idCalendario, \Google_Service_Calendar_Event $postBody): \Google_Service_Calendar_Event {
        return $this->serviceCalendar->events->insert($idCalendario, $postBody);
    }

    public function updateEventoCalendario(string $idCalendario, string $idEvento, \Google_Service_Calendar_Event $postBody): \Google_Service_Calendar_Event {
        return $this->serviceCalendar->events->update($idCalendario, $idEvento, $postBody);
    }

    public function patchEventoCalendario(string $idCalendario, string $idEvento, \Google_Service_Calendar_Event $postBody): \Google_Service_Calendar_Event {
        return $this->serviceCalendar->events->patch($idCalendario, $idEvento, $postBody);
    }

    public function deleteEventoCalendario(string $idCalendario, string $idEvento) {
        return $this->serviceCalendar->events->delete($idCalendario, $idEvento);
    }
}