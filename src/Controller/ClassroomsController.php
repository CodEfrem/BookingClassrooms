<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Classroom;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassroomsController extends AbstractController
{
    private $entityManager;
    private $paginator;

    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
    }
    
    #[Route('/classrooms', name: 'classrooms')]
    public function classrooms(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $classrooms = $this->entityManager
            ->getRepository(Classroom::class)
            ->findAll();
        
        $pagination = $this->paginator->paginate($classrooms,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('classrooms/classrooms.html.twig', [
            'classrooms' => $pagination,
        ]);
    }

    #[Route('/classroom/{id}', name: 'classroom_show')]
    public function show(Classroom $classroom, Request $request): Response
    {
        return $this->render('classrooms/show.html.twig', [
            'classroom' => $classroom,
        ]);
    }
}
