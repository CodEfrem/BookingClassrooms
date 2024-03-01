<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Classroom;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'app_bookings')]
    public function index(BookingRepository $bookingRepository): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        // Récupérer toutes les réservations effectuées par l'utilisateur actuel
        $user = $this->getUser();
        $bookings = $bookingRepository->findBy(['client' => $user]);
        

        return $this->render('bookings/index.html.twig', [
            'bookings' => $bookings,
        ]);
    }
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/bookings/request/{classroomId}', name: 'app_bookings_request')]
public function requestBooking(Request $request, 
EntityManagerInterface $entityManager, 
Security $security,
ClassroomRepository $classroomRepository,
$classroomId
): Response

{
    // Récupérer l'utilisateur connecté
    $user = $security->getUser();

    // Vérifier si l'utilisateur est connecté
    if (!$user) {
        return $this->redirectToRoute('app_login');
    }

// Récupérer la salle de classe correspondant à l'identifiant
$classroom = $classroomRepository->find($classroomId);

// Vérifier si une salle de classe a été trouvée
if (!$classroom) {
    // Si aucune salle de classe correspondante n'est trouvée
    // Rediriger l'utilisateur vers une page appropriée
    // (peut-être une page d'erreur ou une page de sélection de salle de classe)
    return $this->redirectToRoute('classrooms');
}

    $booking = new Booking();
    $booking->setNumber(uniqid())
    ->setCreatedAt(new \DateTime('now'))
    ->setClient($user)
    ->setClassroom($classroom)
    ;
    
    $form = $this->createForm(BookingType::class, $booking);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $classroom = $booking->getClassroom();

        // Vérifier si une salle est associée à la réservation
        if ($classroom !== null) {
            // Récupérer le prix de la salle
            $roomPrice = $classroom->getPrice();

            // Calculer le montant total de la réservation
            $amount = $roomPrice; 

            // Définir le montant de la réservation
            $booking->setAmount($amount);

            $entityManager->persist($booking);
            $entityManager->flush();

            // Ajouter un message de succès à la session
            $this->addFlash('success', 'Votre réservation a été effectuée avec succès.');

            // Rediriger l'utilisateur vers une page de succès ou une autre page appropriée
            return $this->redirectToRoute('classrooms');
        } else {
            // Si aucune salle n'est associée à la réservation
            // Afficher un message d'erreur à l'utilisateur
            $this->addFlash('error', 'Aucune salle n\'est associée à cette réservation.');

            // Rediriger l'utilisateur vers une page où il peut sélectionner une salle
            return $this->redirectToRoute('classrooms');
        }
    }

    return $this->render('bookings/request.html.twig', [
        'form' => $form->createView(),
    ]);
}
}