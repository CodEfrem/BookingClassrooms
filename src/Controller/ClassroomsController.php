<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry; 

class ClassroomsController extends AbstractController
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/classrooms', name: 'app_classrooms')]
    public function index(): Response
    {
    
        $classrooms = $this->managerRegistry
            ->getRepository(Classroom::class)
            ->findAll();
        
        return $this->render('classrooms/index.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    
}
