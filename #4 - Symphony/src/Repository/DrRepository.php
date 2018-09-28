<?php

namespace App\Repository;

use App\Entity\Dr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dr[]    findAll()
 * @method Dr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dr::class);
    }

}
