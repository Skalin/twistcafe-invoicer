<?php

namespace App\Invoice\Controller\CustomerDetails;

use App\Invoice\DTO\CustomerDetails\UpdateCustomerDetailsDTO;
use App\Invoice\Entity\CustomerDetails;
use App\Invoice\Form\Type\CustomerDetailsFormType;
use App\Invoice\Service\CustomerDetails\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer-details/{customerDetails}/update', name: 'customer_details_update', requirements: ['customerDetails' => '\d+'], methods: ['GET', 'POST'])]
class UpdateController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(Request $request, CustomerDetails $customerDetails): Response
    {
        $model = new UpdateCustomerDetailsDTO();
        $model->hydrateFromEntity($customerDetails);

        $form = $this->createForm(CustomerDetailsFormType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UpdateCustomerDetailsDTO $model */
            $model = $form->getData();
            $this->manager->update($model, $customerDetails);
            return $this->redirectToRoute('customer_details_index', [], 301);
        }

        $data = [
            'form' => $form,
            'model' => $model,
        ];
        return $this->render(
            view: 'invoice/customer_details/update.html.twig',
            parameters: $data
        );
    }
}
