<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 08/06/2018
 * Time: 10:00
 */

namespace App\EventListener;


use App\Entity\Registro;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegistroListener
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(LifecycleEventArgs $args) {
        if ($this->isPossuiUsuarioLogado()) {
            $usuarioLogado = $this->tokenStorage->getToken()->getUser();
            /** @var Registro $entity */
            $entity = $args->getEntity();

            if ($entity->getId()) {
                $entity->setAlterador($usuarioLogado);
                $entity->setAlteracao(new \DateTime());
            }
            else {
                $entity->setCriador($usuarioLogado);
                $entity->setCriacao(new \DateTime());
            }
        }
    }

    private function isPossuiUsuarioLogado(): bool {
        if ($this->tokenStorage->getToken()) {
            return $this->tokenStorage->getToken()->getUser() == true;
        }
    }
}