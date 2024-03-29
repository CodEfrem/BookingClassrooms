<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\Classroom;
use App\Entity\Equipment;
use App\Entity\Software;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('user/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<img src="/images/logoBC.jpeg" width="50">')
        ->setFaviconPath('/images/logoBC.jpeg')
        ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Classrooms', 'fa fa-graduation-cap', Classroom::class);
        yield MenuItem::linkToCrud('Bookings', 'fa fa-tags', Booking::class);
        yield MenuItem::linkToCrud('Clients', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Equipments', 'fa fa-list', Equipment::class);
        yield MenuItem::linkToCrud('Softwares', 'fa fa-desktop', Software::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-arrow-left', 'classrooms');
    }
}
