<?php

namespace App\Invoice\Controller\CustomerDetails;

use App\Invoice\DTO\CustomerDetails\CreateCustomerDetailsDTO;
use App\Invoice\Form\Type\CustomerDetailsFormType;
use App\Invoice\Service\CustomerDetails\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer-details/create',
    name: 'customer_details_create',
    methods: [
        'GET',
        'POST'
    ]
)]
class CreateController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(Request $request): Response
    {

        $model = new CreateCustomerDetailsDTO();
        $form = $this->createForm(CustomerDetailsFormType::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateCustomerDetailsDTO $model */
            $model = $form->getData();
            $this->manager->create($model);
            return $this->redirectToRoute('customer_details_index', [], 301);
        }

        $data = [
            'form' => $form
        ];
        return $this->render(
            view: 'invoice/customer_details/create.html.twig',
            parameters: $data
        );
    }
}
