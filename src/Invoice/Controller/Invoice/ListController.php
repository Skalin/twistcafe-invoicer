<?php

namespace App\Invoice\Controller\Invoice;

use App\Invoice\Service\Invoice\QueryManager;
use App\Shared\Request\Pager\Pager;
use App\Shared\Request\Query\QueryParamsProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice',
    name: 'invoice_index',
    methods: ['GET']
)]
class ListController extends AbstractController
{
    public function __construct(private readonly QueryManager $query)
    {
    }

    public function __invoke(Request $request): Response
    {
        $pager = new Pager();
        $queryParamsProvider = new QueryParamsProvider($request);
        $data = [
            'pager' => $pager->getPager($this->query->getQueryBuilder(), $queryParamsProvider),
        ];

        return $this->render(
            view: 'invoice/invoice/list.html.twig',
            parameters: $data
        );
    }
}
