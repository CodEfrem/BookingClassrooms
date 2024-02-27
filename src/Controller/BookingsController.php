<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Classroom;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'app_bookings')]

    public function index(Request $request, BookingRepository $bookingRepository): Response
    {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
  
        $startDateString = $request->query->get('startDate');
        $endDateString = $request->query->get('endDate');

        
        $startDate = DateTime::createFromFormat('Y-m-d', $startDateString);
        $endDate = DateTime::createFromFormat('Y-m-d', $endDateString);

        
        $bookings = $bookingRepository->findBookingsByDates($startDate, $endDate);

        return $this->render('bookings/index.html.twig', [
            'controller_name' => 'BookingsController',
            'bookings' => $bookings,
        ]);
    }
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/bookings/request', name: 'app_bookings_request')]
public function requestBooking(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
{

    if (!$this->getUser()) {
        return $this->redirectToRoute('app_login');
    }

    $user = new User();

    $booking = new Booking();
    $booking->setNumber(uniqid())
    ->setCreatedAt(new \DateTime('now'))
    ->setUser($user);
    
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