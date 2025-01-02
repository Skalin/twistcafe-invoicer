<?php

namespace App\Invoice\Controller\CustomerDetails;

use App\Invoice\Entity\CustomerDetails;
use App\Invoice\Service\CustomerDetails\EntityManager;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer-details/{customerDetails}/delete',
    name: 'customer_details_delete',
    //requirements: ['customerDetails' => '\d+'],
    methods: [
        'GET',
        'DELETE'
    ],
    priority: 1
)]
class DeleteController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(CustomerDetails $customerDetails): Response
    {
        try {
            $this->manager->delete($customerDetails);

        } catch (\Exception $e) {
            $this->addFlash('error', 'Could not delete the customer details because it is probably linked to invoice. Please remove it from the invoice first.');
        }

        return $this->redirectToRoute('customer_details_index', [], 301);
    }
}
