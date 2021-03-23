<?php

namespace App\Controller;

use App\Entity\Renseignements;
use App\Form\RenseignementsType;
use App\Repository\RenseignementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/renseignements')]
class RenseignementsController extends AbstractController
{
    #[Route('/', name: 'renseignements_index', methods: ['GET'])]
    public function index(RenseignementsRepository $renseignementsRepository): Response
    {
        return $this->render('renseignements/index.html.twig', [
            'renseignements' => $renseignementsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'renseignements_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        //récupération infos formulaire
        $renseignement = new Renseignements();
        //$renseignement->setDateCreation(new \DateTime());

        $form = $this->createForm(RenseignementsType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $objetDate = new \DateTime();   
            $renseignement->setDateCreation($objetDate);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($renseignement);
            $entityManager->flush();

            return $this->redirectToRoute('renseignements_index');
        }

        return $this->render('renseignements/new.html.twig', [
            'renseignement' => $renseignement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'renseignements_show', methods: ['GET'])]
    public function show(Renseignements $renseignement): Response
    {
        return $this->render('renseignements/show.html.twig', [
            'renseignement' => $renseignement,
        ]);
    }

    #[Route('/{id}/edit', name: 'renseignements_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Renseignements $renseignement): Response
    {
        $form = $this->createForm(RenseignementsType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('renseignements_index');
        }

        return $this->render('renseignements/edit.html.twig', [
            'renseignement' => $renseignement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'renseignements_delete', methods: ['POST'])]
    public function delete(Request $request, Renseignements $renseignement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$renseignement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($renseignement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('renseignements_index');
    }
}
