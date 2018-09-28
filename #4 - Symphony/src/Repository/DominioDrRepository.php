<?php

namespace App\Repository;

use App\Entity\DominioDr;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DominioDr|null find($id, $lockMode = null, $lockVersion = null)
 * @method DominioDr|null findOneBy(array $criteria, array $orderBy = null)
 * @method DominioDr[]    findAll()
 * @method DominioDr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DominioDrRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DominioDr::class);
    }

    public function findByUsuarioDominio(Usuario $usuario, string $dominio) {
        return $this->createQueryBuilder('d')
            ->join('d.dr', 'dr')
            ->join('dr.usuarios', 'usuario')
            ->where('usuario = :usuario')
            ->setParameter('usuario', $usuario)
            ->andWhere('d.dominio = :dominio')
            ->setParameter('dominio', $dominio);
    }

}
