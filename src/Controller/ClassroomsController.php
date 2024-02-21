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

    #[Route('/classrooms-detail/{id}', name: 'classroom')]
public function classroom($id): Response
{
    // Récupère les détails de la salle de classe spécifiée par son identifiant
    $classroom = $this->managerRegistry
        ->getRepository(Classroom::class)
        ->find($id);
    
    // Vérifie si la salle de classe existe
    if (!$classroom) {
        throw $this->createNotFoundException('Classroom not found');
    }

    // Rend la vue Twig en passant les détails de la salle de classe récupérée
    return $this->render('classrooms/detail.html.twig', [
        'classroom' => $classroom,
    ]);
}

    
    
}
