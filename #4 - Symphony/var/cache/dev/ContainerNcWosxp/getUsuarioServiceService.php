<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Service\Google\UsuarioService' shared autowired service.

include_once $this->targetDirs[3].'/src/Service/Google/AdminConsoleService.php';
include_once $this->targetDirs[3].'/src/Service/Google/UsuarioService.php';

return $this->privates['App\Service\Google\UsuarioService'] = new \App\Service\Google\UsuarioService(($this->privates['Google_Client'] ?? $this->load('getGoogleClientService.php')));
