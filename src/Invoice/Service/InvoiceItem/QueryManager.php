<?php

namespace App\Invoice\Service\InvoiceItem;

use App\Invoice\Repository\Invoice\Repository;

class QueryManager
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function getQueryBuilder(): \Doctrine\ORM\QueryBuilder
    {
        return $this->repository->createQueryBuilder(
            alias: 'invoice_item'
        );
    }
}
