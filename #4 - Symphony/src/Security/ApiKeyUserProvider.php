<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 03/04/2018
 * Time: 10:59
 */

namespace App\Security;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getUsernameForApiKey($apiKey) {
        /** @var Usuario $usuario */
        $usuario = $this->em->getRepository('App:Usuario')->findOneBy(['apiKey' => $apiKey]);
        if ($usuario)
            return $usuario->getUsername();
    }

    public function loadUserByUsername($email) {
        return $this->em->getRepository('App:Usuario')->findOneBy(['email' => $email]);
    }

    public function refreshUser(UserInterface $user) {
        return $user;
    }

    public function supportsClass($class) {
        return Usuario::class === $class;
    }
}