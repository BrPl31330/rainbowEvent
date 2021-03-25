<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Renseignements;
use App\Form\RenseignementsType;
use App\Repository\BlogEventRepository;

class SiteController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(BlogEventRepository $blogEventRepository): Response
    {
        return $this->render('site/index.html.twig', [
            'blog_events' => $blogEventRepository->findAll(),
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
        $messageConfirmation = '<div class="gris">Merci de remplir le formulaire de renseignements</div>';
        $renseignement = new Renseignements();
        $form = $this->createForm(RenseignementsType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objetDate = new \DateTime();   
            $renseignement->setDateCreation($objetDate);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($renseignement);
            $entityManager->flush();

            $messageConfirmation = '<div class="vert">Vos informations vont être traitées rapidement </div>';
            //return $this->redirectToRoute('renseignements_index');
        }

        return $this->render('site/renseignements.html.twig', [
            'messageConfirmation' =>$messageConfirmation,
            'renseignement' => $renseignement,
            'form' => $form->createView(),
            'controller_name' => 'SiteController',
        ]);
    }
}
