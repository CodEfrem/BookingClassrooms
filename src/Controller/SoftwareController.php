<?php

namespace App\Controller;

use App\Entity\Software;
use App\Form\SoftwareType;
use App\Repository\SoftwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/software')]
class SoftwareController extends AbstractController
{
    #[Route('/', name: 'app_software_index', methods: ['GET'])]
    public function index(SoftwareRepository $softwareRepository): Response
    {
        return $this->render('software/index.html.twig', [
            'software' => $softwareRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_software_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $software = new Software();
        $form = $this->createForm(SoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($software);
            $entityManager->flush();

            return $this->redirectToRoute('app_software_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('software/new.html.twig', [
            'software' => $software,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_software_show', methods: ['GET'])]
    public function show(Software $software): Response
    {
        return $this->render('software/show.html.twig', [
            'software' => $software,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_software_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Software $software, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoftwareType::class, $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_software_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('software/edit.html.twig', [
            'software' => $software,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_software_delete', methods: ['POST'])]
    public function delete(Request $request, Software $software, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$software->getId(), $request->request->get('_token'))) {
            $entityManager->remove($software);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_software_index', [], Response::HTTP_SEE_OTHER);
    }
}