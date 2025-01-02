<?php

namespace App\Invoice\Controller\InvoiceItem;

use App\Invoice\DTO\InvoiceItem\CreateInvoiceItemDTO;
use App\Invoice\Entity\Invoice;
use App\Invoice\Form\Type\InvoiceItemFormType;
use App\Invoice\Service\InvoiceItem\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/{invoice}/invoice-item/create', name: 'invoice_item_create', requirements: ['invoice' => '\d+'], methods: [
    'GET',
    'POST'
])]
class CreateController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(Request $request, Invoice $invoice): Response
    {

        $model = new CreateInvoiceItemDTO();
        $form = $this->createForm(InvoiceItemFormType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateInvoiceItemDTO $model */
            $model = $form->getData();
            $this->manager->create($model, $invoice);
            return $this->redirectToRoute('invoice_update', ['invoice' => $invoice->getId()], 301);
        }

        $data = [
            'form' => $form
        ];
        return $this->render(
            view: 'invoice/invoice_item/create.html.twig',
            parameters: $data
        );
    }
}
