<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClassroomsController extends AbstractController
{
    #[Route('/classrooms', name: 'app_classrooms')]
    public function index(): Response
    {
        return $this->render('classrooms/index.html.twig', [
            'controller_name' => 'ClassroomsController',
        ]);
    }
}
