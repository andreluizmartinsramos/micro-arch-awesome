<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 25/04/2018
 * Time: 15:51
 */

namespace App\Business;


use App\Entity\Usuario;
use App\Utils\StringUtils;
use Doctrine\ORM\EntityManagerInterface;

class UserBusiness
{

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function isDominioValido(Usuario $usuario, string $email) {
        $dominio = StringUtils::extractDominioFromEmail($email);
        return $this->em->getRepository('App:DominioDr')
            ->findByUsuarioDominio($usuario, $dominio)
            ->select('count(d)')
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }
}