<?php

declare(strict_types=1);


namespace App\Shared\Request\Pager;

use App\Shared\Request\Query\QueryParamsProvider;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

readonly class Pager
{
    public function __construct(private ?string $entityClass = null)
    {
    }

    /**
     *
     * @param QueryBuilder $queryBuilder
     * @param QueryParamsProvider $queryParamsProvider
     * @return Pagerfanta
     */
    public function getPager(QueryBuilder $queryBuilder, QueryParamsProvider $queryParamsProvider): Pagerfanta
    {
        $queryAdapter = new QueryAdapter($queryBuilder);
        return Pagerfanta::createForCurrentPageWithMaxPerPage(
            $queryAdapter,
            $queryParamsProvider->getCurrentPage($this->entityClass),
            $queryParamsProvider->getMaxPerPage($this->entityClass)
        );
    }

}