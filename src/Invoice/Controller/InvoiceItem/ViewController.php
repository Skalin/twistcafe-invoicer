<?php

namespace App\Invoice\Controller\InvoiceItem;

use App\Invoice\Entity\InvoiceItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/{invoice}/invoice_item/{invoiceItem}/view',
    name: 'invoice_item_view',
    requirements: [
        'invoice' => '\d+',
        'invoiceItem' => '\d+'
    ],
    methods: ['GET']
)]
class ViewController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(InvoiceItem $invoiceItem): Response
    {

        $data = [
            'model' => $invoiceItem
        ];
        return $this->render(
            view: 'invoice/invoice_item/view.html.twig',
            parameters: $data
        );
    }
}
