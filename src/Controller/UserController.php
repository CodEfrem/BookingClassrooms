<?php

namespace App\Controller;

use App\Form\ClientType;
use App\Service\ClientService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/complete-profile', name: 'complete_profile')]
    public function index(
        Request $request,
        ClientService $ClientService,
        EntityManagerInterface $em
    ): Response
    {
        $form = $this->createForm(ClientType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ClientService->updateProfile($form, $this->getUser(), $em);
            
            $this->addFlash('success', 'Your profile has been updated');
            return $this->redirectToRoute('account');
        }
        return $this->render('user/client.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * User account route for displaying it's own data on the app
     */
    #[Route('/account', name: 'account', methods: ['GET', 'POST'])]
    public function account(
        Request $request,
        EntityManagerInterface $em,
        ClientService $ClientService
    ): Response
    {
        if(!$this->getUser()->getUserIdentifier()) {
            return $this->redirectToRoute('complete_profile');
        }

        $form = $this->createForm(ClientType::class, $this->getUser());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $ClientService->updateProfile($form, $this->getUser(), $em);
            $this->addFlash('success', 'Your profile has been updated');
            return $this->redirectToRoute('account');
        }
        return $this->render('user/account.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
