<?php

namespace App\Invoice\Controller\Invoice;

use App\Invoice\Command\CreateInvoiceCommand;
use App\Invoice\DTO\Invoice\CreateInvoiceDTO;
use App\Invoice\Form\Type\InvoiceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/create',
    name: 'invoice_create',
    methods: [
        'GET',
        'POST'
    ])
]
class CreateController extends AbstractController
{
    public function __construct(private readonly CreateInvoiceCommand $createInvoiceCommand)
    {
    }

    public function __invoke(Request $request): Response
    {

        $model = new CreateInvoiceDTO();
        $form = $this->createForm(InvoiceFormType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateInvoiceDTO $model */
            $model = $form->getData();
            $this->createInvoiceCommand->setModel($model);
            $this->createInvoiceCommand->execute();
            return $this->redirectToRoute('invoice_update', ['invoice' => $this->createInvoiceCommand->getInvoice()->getId()], 301);
        }

        $data = [
            'form' => $form
        ];
        return $this->render(
            view: 'invoice/invoice/create.html.twig',
            parameters: $data
        );
    }
}
