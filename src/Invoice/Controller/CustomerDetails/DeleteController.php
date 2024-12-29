<?php

namespace App\Invoice\Controller\CustomerDetails;

use App\Invoice\Entity\CustomerDetails;
use App\Invoice\Service\CustomerDetails\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer-details/{customerDetails}/delete', name: 'customer_details_delete', requirements: ['customerDetails' => '\d+'], methods: ['GET', 'DELETE'])]
class DeleteController extends AbstractController
{
    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function __invoke(CustomerDetails $customerDetails): Response
    {
        $this->manager->delete($customerDetails);
        return $this->redirectToRoute('customer_details_index', [], 301);
    }
}
