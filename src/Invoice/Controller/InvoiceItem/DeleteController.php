<?php

namespace App\Invoice\Controller\InvoiceItem;

use App\Invoice\Entity\Invoice;
use App\Invoice\Entity\InvoiceItem;
use App\Invoice\Service\InvoiceItem\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/{invoice}/invoice_item/{invoiceItem}/delete',
    name: 'invoice_item_delete',
    requirements: [
        'invoice' => '\d+',
        'invoiceItem' => '\d+'
    ],
    methods: [
        'GET',
        'DELETE'
    ]
)]
class DeleteController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(InvoiceItem $invoiceItem, Invoice $invoice): Response
    {
        $this->manager->delete($invoiceItem);
        return $this->redirectToRoute('invoice_update', ['invoice' => $invoice->getId()], 301);
    }
}
