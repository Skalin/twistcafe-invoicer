<?php

namespace App\Invoice\Controller\Invoice;

use App\Invoice\DTO\Invoice\UpdateInvoiceDTO;
use App\Invoice\Entity\Invoice;
use App\Invoice\Form\Type\InvoiceFormType;
use App\Invoice\Service\Invoice\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice/{invoice}/update', name: 'invoice_update', requirements: ['invoice' => '\d+'], methods: ['GET', 'POST'])]
class UpdateController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(Request $request, Invoice $invoice): Response
    {
        $model = new UpdateInvoiceDTO();
        $model->hydrateFromEntity($invoice);
        $form = $this->createForm(InvoiceFormType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UpdateInvoiceDTO $model */
            $model = $form->getData();
            $this->manager->update($model, $invoice);
            return $this->redirectToRoute('invoice_index', [], 301);
        }

        $data = [
            'form' => $form,
            'model' => $model,
        ];
        return $this->render(
            view: 'invoice/invoice/update.html.twig',
            parameters: $data
        );
    }
}
