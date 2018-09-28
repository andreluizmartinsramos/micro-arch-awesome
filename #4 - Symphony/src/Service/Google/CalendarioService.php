<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 30/04/2018
 * Time: 08:54
 */

namespace App\Service\Google;


class CalendarioService extends AdminConsoleService
{
    /** @var \Google_Service_Calendar  */
    private $serviceCalendar;

    public function __construct(\Google_Client $googleClient) {
        parent::__construct($googleClient);
        $this->serviceCalendar = new \Google_Service_Calendar($this->getGoogleClient());
    }
    public function getCalendario(string $idCalendario): \Google_Service_Calendar_Calendar {
        return $this->serviceCalendar->calendars->get($idCalendario);
    }

    public function postCalendario($postBody): \Google_Service_Calendar_Calendar {
        $postBody->setTimeZone('America/Sao_Paulo');
        return $this->serviceCalendar->calendars->insert($postBody);
    }

    public function updateCalendario(string $idCalendario, $postBody) {
        return $this->serviceCalendar->calendars->update($idCalendario, $postBody);
    }

    public function patchCalendario(string $idCalendario, $postBody) {
        return $this->serviceCalendar->calendars->patch($idCalendario, $postBody);
    }

    public function deleteCalendario(string $idCalendario) {
        return $this->serviceCalendar->calendars->delete($idCalendario);
    }

    public function addUsuarioCalendario(string $idCalendario, string $idUsuario) {
        $this->setSubject($idUsuario);
        $calendarListEntry = new \Google_Service_Calendar_CalendarListEntry();
        $calendarListEntry->setId($idCalendario);
        return $this->serviceCalendar->calendarList->insert($calendarListEntry);
    }
    public function removeUsuarioCalendario(string $idCalendario, string $idUsuario) {
        $this->setSubject($idUsuario);
        return $this->serviceCalendar->calendarList->delete($idCalendario);
    }


}