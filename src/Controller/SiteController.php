<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Renseignements;
use App\Form\RenseignementsType;

class SiteController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/boutique', name: 'boutique')]
    public function boutique(): Response
    {
        return $this->render('site/boutique.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/location', name: 'location')]
    public function location(): Response
    {
        return $this->render('site/location.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/renseignements', name: 'renseignements', methods: ['GET', 'POST'])]
    public function renseignements(Request $request): Response
    {
        
        $renseignement = new Renseignements();
        $form = $this->createForm(RenseignementsType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objetDate = new \DateTime();   
            $renseignement->setDateCreation($objetDate);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($renseignement);
            $entityManager->flush();

            //return $this->redirectToRoute('renseignements_index');
        }

        return $this->render('site/renseignements.html.twig', [
            'renseignement' => $renseignement,
            'form' => $form->createView(),
            'controller_name' => 'SiteController',
        ]);
    }
}