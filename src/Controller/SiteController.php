<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Renseignements;
use App\Form\RenseignementsType;
use App\Repository\BlogEventRepository;
use App\Entity\BlogEvent;
use App\Repository\LocationRepository;
use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\ArtisteRepository;
use App\Entity\Artiste;

class SiteController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(BlogEventRepository $blogEventRepository): Response
    {
        $blog_events = $blogEventRepository->findBy([], ["dateCreation" => "DESC"]);
        return $this->render('site/index.html.twig', [
           'blog_events' => $blog_events,
        ]);
    }

    #[Route('/boutique', name: 'boutique')]
    public function boutique(): Response
    {
        return $this->render('site/boutique.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/mention_legale', name: 'mention_legale')]
    public function mention_legale(): Response
    {
        return $this->render('site/mention_legale.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/conditionVente', name: 'conditionVente')]
    public function conditionVente(): Response
    {
        return $this->render('site/conditionVente.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/conditionUtilisation', name: 'conditionUtilisation')]
    public function conditionUtilisation(): Response
    {
        return $this->render('site/conditionUtilisation.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/cours', name: 'cours')]
    public function cours(): Response
    {
        return $this->render('site/cours.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/labels', name: 'labels')]
    public function labels(ArtisteRepository $artisteRepository): Response
    {
        return $this->render('site/labels.html.twig', [
            'artistes' => $artisteRepository->findAll(),
        ]);
    }

    #[Route('/location', name: 'location', methods: ['GET', 'POST'])]
    public function location(Request $request, LocationRepository $locationRepository): Response
    {
        $location = $locationRepository->findBy([], ["categorie"=>"DESC"]);
        $location = new Location();
        
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $objetDate = new \DateTime();   
            $location->setDateCreation($objetDate);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();

            //return $this->redirectToRoute('location_index');
        }

        return $this->render('site/location.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/rechercher', name: 'rechercher')]
    public function rechercher(Request $request, LocationRepository $locationRepository): Response
    {
        $mot = $request->get('mot');
        dump($mot);
        if (!empty($mot)) {
            //recherche mot exact
            //$blog_events = $blogEventRepository->findby([
               // "titre" =>$mot,
            //], ["dateCreation" => "DESC"]);
            //titre + texte 
            $locations = $locationRepository->chercherMot($mot);   
        }

        //changer blog_event pour recherche matos
        return $this->render('site/rechercher.html.twig', [
            'mot'         => $mot,
            'locations' => $locations ?? [],
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

    #[Route('/{id}', name: 'annonce', methods: ['GET'])]
    public function annonce(BlogEvent $blogEvent): Response
    {
        return $this->render('site/annonce.html.twig', [
            'blog_event' => $blogEvent,
        ]);
    }

    #[Route('/location/{id}', name: 'annonceloc', methods: ['GET'])]
    public function annonceloc(Location $location): Response
    {
        return $this->render('site/annonceloc.html.twig', [
            'location' => $location,
        ]);
    }

    #[Route('/labels/{id}', name: 'label', methods: ['GET'])]
    public function label(Artiste $artiste): Response
    {
        return $this->render('site/label.html.twig', [
            'artiste' => $artiste,
        ]);
    }

}
