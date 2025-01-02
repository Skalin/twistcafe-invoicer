<?php

namespace App\Invoice\Controller\Invoice;

use App\Invoice\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/{invoice}/view',
    name: 'invoice_view',
    requirements: ['invoice' => '\d+'],
    methods: ['GET']
)]
class ViewController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(Invoice $invoice): Response
    {

        $data = [
            'model' => $invoice
        ];
        return $this->render(
            view: 'invoice/invoice/view.html.twig',
            parameters: $data
        );
    }
}
