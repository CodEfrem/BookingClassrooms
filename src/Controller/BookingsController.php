<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

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
    
    #[Route('/bookings/request', name: 'app_bookings_request')]
    public function requestBooking(Request $request, Security $security): Response
    {
        // Récupérer l'utilisateur actuellement connecté
        $currentUser = $security->getUser();

        // Créez une nouvelle instance de l'entité Booking
        $booking = new Booking();

        // Définir l'utilisateur actuel comme client de la réservation
        $booking->setClient($currentUser);

        // Créez le formulaire en passant l'entité Booking
        $form = $this->createForm(BookingType::class, $booking);

       

        // Passez le formulaire au modèle Twig pour l'affichage
        return $this->render('bookings/request.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}