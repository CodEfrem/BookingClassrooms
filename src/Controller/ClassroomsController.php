<?php

namespace App\Controller;

use App\Entity\Classroom;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry; // Importez ManagerRegistry

class ClassroomsController extends AbstractController
{
    private $managerRegistry;
    private $entityManager;
    private $paginator;


    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->managerRegistry = $managerRegistry; // Affectez le managerRegistry
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
    }
    
    #[Route('/classrooms', name: 'classrooms')]
    public function classrooms(Request $request
    ): Response
    {
            if (!$this->getUser()) {
                return $this->redirectToRoute('app_login');
            }

        $classrooms = $this->entityManager
            ->getRepository(Classroom::class)
            ->findAll();
        
            $pagination = $this->paginator->paginate($classrooms,
            $request->query->getInt('page', 1), 12

        );

        return $this->render('classrooms/classrooms.html.twig', [
            'classrooms' => $pagination,
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
