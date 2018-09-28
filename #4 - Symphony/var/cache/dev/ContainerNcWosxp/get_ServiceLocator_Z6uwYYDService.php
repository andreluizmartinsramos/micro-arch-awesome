<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.z6uwYYD' shared service.

return $this->privates['.service_locator.z6uwYYD'] = new \Symfony\Component\DependencyInjection\ServiceLocator(array('eventoManage' => function (): \App\Manager\EventoManager {
    return ($this->privates['App\Manager\EventoManager'] ?? $this->load('getEventoManagerService.php'));
}, 'eventoService' => function (): \App\Service\Google\EventoService {
    return ($this->privates['App\Service\Google\EventoService'] ?? $this->load('getEventoServiceService.php'));
}, 'jsonApiResponse' => function (): \App\Utils\JsonApiResponse {
    return ($this->privates['App\Utils\JsonApiResponse'] ?? $this->load('getJsonApiResponseService.php'));
}));
