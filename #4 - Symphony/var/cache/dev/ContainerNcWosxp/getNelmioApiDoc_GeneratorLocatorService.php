<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'nelmio_api_doc.generator_locator' shared service.

return $this->privates['nelmio_api_doc.generator_locator'] = new \Symfony\Component\DependencyInjection\ServiceLocator(array('default' => function () {
    return ($this->services['nelmio_api_doc.generator'] ?? $this->load('getNelmioApiDoc_GeneratorService.php'));
}));
