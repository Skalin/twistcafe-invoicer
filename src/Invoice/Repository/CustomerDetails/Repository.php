<?php

namespace App\Invoice\Repository\CustomerDetails;

use App\Invoice\Entity\CustomerDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CustomerDetails>
 */
class Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerDetails::class);
    }
}
