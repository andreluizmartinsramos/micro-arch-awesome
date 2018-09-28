<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 05/04/2018
 * Time: 10:01
 */

namespace App\EventListener;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class AccessListener
{
    private $_container;

    public function __construct(ContainerInterface $_container) {
        $this->_container = $_container;
    }

    public function onKernelController(FilterControllerEvent $event) {
        $token = $this->_container->get('security.token_storage')->getToken();
        if ($token && $token->getUsername()) {
            $username = $token->getUsername();
            $logger = $this->_container->get('monolog.logger.access_api');
            $logger->info($username . ' - ' . $event->getRequest());
        }

    }
}