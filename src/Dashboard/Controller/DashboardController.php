<?php

declare(strict_types=1);


namespace App\Dashboard\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('dashboard', name: 'dashboard', methods: ['GET'])]
class DashboardController extends AbstractController
{

    public function __invoke(): Response
    {
        return $this->render(
            view: 'dashboard/dashboard.html.twig'
        );
    }
}