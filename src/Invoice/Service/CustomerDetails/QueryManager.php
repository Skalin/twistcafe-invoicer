<?php

namespace App\Invoice\Service\CustomerDetails;

use App\Invoice\Repository\CustomerDetails\Repository;

class QueryManager
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function getQueryBuilder(): \Doctrine\ORM\QueryBuilder
    {
        return $this->repository->createQueryBuilder(
            alias: 'customer_details'
        );
    }
}
