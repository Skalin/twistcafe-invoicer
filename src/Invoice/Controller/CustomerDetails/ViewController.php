<?php

namespace App\Invoice\Controller\CustomerDetails;

use App\Invoice\Entity\CustomerDetails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer-details/{customerDetails}/view', name: 'customer_details_view', requirements: ['customerDetails' => '\d+'], methods: ['GET'])]
class ViewController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(CustomerDetails $customerDetails): Response
    {

        $data = [
            'model' => $customerDetails
        ];
        return $this->render(
            view: 'invoice/customer_details/view.html.twig',
            parameters: $data
        );
    }
}
