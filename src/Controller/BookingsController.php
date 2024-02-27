<?php

namespace App\Controller;

use App\Entity\Booking;
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
    public function index(BookingRepository $bookingRepository): Response
    {
        // Récupérer toutes les réservations effectuées par l'utilisateur actuel
        $user = $this->getUser();
        $bookings = $bookingRepository->findBy(['user' => $user]);
        

        return $this->render('bookings/index.html.twig', [
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
    $booking = new Booking();
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
            return $this->redirectToRoute('booking_success');
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