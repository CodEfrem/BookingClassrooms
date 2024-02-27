<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'app_bookings')]
    public function index(Request $request, BookingRepository $bookingRepository): Response
    {
        
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
}
