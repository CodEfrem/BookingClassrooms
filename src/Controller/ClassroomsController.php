<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry; // Importez ManagerRegistry
use Doctrine\ORM\EntityManagerInterface;

class ClassroomsController extends AbstractController
{
    private $managerRegistry;

    private $entityManager;

    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        $this->managerRegistry = $managerRegistry; // Affectez le managerRegistry
        $this->entityManager = $entityManager;
    }
    
    #[Route('/classrooms', name: 'classrooms')]
    public function classrooms(): Response
    {
        $classrooms = $this->entityManager
            ->getRepository(Classroom::class)
            ->findAll();

        return $this->render('classrooms/classrooms.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/classrooms/{id}', name: 'classroom_show')]
    public function show(Classroom $classroom): Response
    {
        return $this->render('classrooms/show.html.twig', [
            'classroom' => $classroom,
        ]);
    }


    
}
