<?php

namespace App\Invoice\Controller\InvoiceItem;

use App\Invoice\DTO\InvoiceItem\UpdateInvoiceItemDTO;
use App\Invoice\Entity\InvoiceItem;
use App\Invoice\Form\Type\InvoiceItemFormType;
use App\Invoice\Service\InvoiceItem\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/{invoice}/invoice_item/{invoiceItem}/update',
    name: 'invoice_item_update',
    requirements: [
        'invoice' => '\d+',
        'invoiceItem' => '\d+'
    ],
    methods: [
        'GET',
        'POST'
    ]
)]
class UpdateController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(Request $request, InvoiceItem $invoiceItem): Response
    {
        $model = new UpdateInvoiceItemDTO();
        $model->hydrateFromEntity($invoiceItem);
        $form = $this->createForm(InvoiceItemFormType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UpdateInvoiceItemDTO $model */
            $model = $form->getData();
            $this->manager->update($model, $invoiceItem);
            return $this->redirectToRoute('invoice_update', ['invoice' => $invoiceItem->getInvoice()], 301);
        }

        $data = [
            'form' => $form,
            'model' => $model,
        ];
        return $this->render(
            view: 'invoice/invoice_item/update.html.twig',
            parameters: $data
        );
    }
}
