    VERIFIER LA VERSION DE PHP
    OUVRIR UN TERMINAL DANS VSCODE ET ENTRER LA LIGNE

    php -v

    ENSUITE ON A BESOIN DE COMPOSER 2

    composer -v

    INSTALLATION 

    DANS VSCODE OUVRIR LE DOSSIER www/
    ET ENSUITE OUVRIR UN TERMINAL

    VERIFIER QUE VOTRE TERMINAL EST DANS LE DOSSIER www

    ET ENSUITE LANCER LA LIGNE DE COMMANDE

    composer create-project symfony/website-skeleton symfony

 ## INSTALLATION DU .htaccess POUR APACHE

    https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules


    OUVRIR UN TERMINAL DANS LE DOSSIER symfony/

    ATTENTION A NE PAS AVOIR DE (ENTREE) RETOUR CHARIOT EN TROP...

    composer require symfony/apache-pack

    REPONDRE y

    => RESULTAT ON DOIT AVOIR UN FICHIER public/.htaccess 

## ACTIVER GIT AVEC SYMFONY

    PRE-REQUIS: IL FAUT AVOIR GIT DEJA INSTALLE

    OUVRIR UN TERMINAL DANS LE DOSSIER symfony/

    git --version

    git init

    DANS VSCODE, FAIRE UN PREMIER COMMIT...

    SI BESOIN CONFIGURER user.name ET user.email

    git config user.name "votre nom ici"
    git config user.email "votre.email@ici"

## CREER SA PREMIERE PAGE AVEC SYMFONY
## CREER SON CONTROLLER AVEC LA CONSOLE 

     OUVRIR UN TERMINAL DANS LE DOSSIER symfony/

    php bin/console make:controller

    ET DONNER LE NOM DE LA CLASSE (SANS LE SUFFIXE Controller)

    Choose a name for your controller class (e.g. GentleElephantController):
    > Site

        ENSUITE, ON CREE LES ROUTES POUR CHAQUE PAGE...
    ET AUSSI LES TEMPLATES TWIG POUR CHAQUE PAGE...

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/galerie', name: 'galerie')]
    public function galerie(): Response
    {
        return $this->render('site/galerie.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('site/contact.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

}
```
# CREER DES LIENS VERS LES ROUTES DANS TWIG


    https://symfony.com/doc/current/templates.html#linking-to-pages

    https://symfony.com/doc/current/reference/twig_reference.html#path

```twig

        <nav>
            <a href="{{ path('index') }}">accueil</a>
            <a href="{{ path('galerie') }}">galerie</a>
            <a href="{{ path('contact') }}">contact</a>
        </nav>

```
## CREER DES URLS POUR LES FICHIERS CSS, JS, IMAGES, etc...
```twig
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Projet Symfony</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ path('index') }}">accueil</a>
            <a href="{{ path('galerie') }}">galerie</a>
            <a href="{{ path('contact') }}">contact</a>
        </nav>
    </header>
    <main>
        <section>
            <h1>MON TITRE1</h1>
            <p>Lorem ipsum dolor </p>
            <img src="{{ asset('images/photo1.jpg') }}" alt="photo1">
        </section>
    </main>
    <footer>
        <p>tous droits réservés</p>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

```
## BASE DE DONNEES ET SYMFONY
    SYMFONY UTILISE LE CODE DU PROJET DOCTRINE POUR GERER LA PARTIE AVEC LA DATABASE...


    AJOUTER LA LIGNE DE CONFIG DANS LE FICHIER .env

```
###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
# DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
# A modifier dans le fichier (important)
DATABASE_URL="mysql://root:@localhost:3306/nomduprojet?serverVersion=5.7"
# DANS MON CAS 
# DATABASE_URL="mysql://root:@localhost:3306/symfony?serverVersion=mariadb-10.4.17"
###< doctrine/doctrine-bundle ###

```
    ET ENSUITE DANS LE TERMINAL LANCER LA COMMANDE

    php bin/console doctrine:database:create

    ET SI TOUT SE PASSE BIEN, ON PEUT VERIFIER AVEC PHPMYADMIN QUE LA DATABASE EST CREEE...

## AJOUTER UNE TABLE SQL POUR ENREGISTRER LES INSCRIPTIONS A UNE NEWSLETTER

    Table SQL renseignements
        id                  INT             INDEX=PRIMARY   A_I
        nom                 VARCHAR(255)
        email               VARCHAR(255)
        telephone           VARCHAR(255)
        sujet               VARCHAR(255)
        message             text
        date_creation       DATETIME 

    => ASSISTANT POUR CREER LA CLASSE ET LES PROPRIETES

    ENSUITE QUAND ON EST BON SUR LA CLASSE ENTITE renseignements.php
    ON PEUT LANCER LA COMMANDE SUIVANTE...

    php bin/console make:entity
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate

## GENERER UN CRUD A PARTIR D'UNE ENTITE 
     ON A UNE LIGNE DE COMMANDE QUI PERMET DE GENERER LE CODE POUR UN CRUD A PARTIR D'UNE ENTITE

    php bin/console make:crud

         The class name of the entity to create CRUD (e.g. BravePopsicle):
    > Renseignements


    Create      => FORMULAIRE POUR AJOUTER UNE NOUVELLE LIGNE
    Read        => AFFICHAGE LISTE ET AFFICHAGE UNE SEULE LIGNE
    Update      => FORMULAIRE POUR MODIFIER UNE LIGNE EXISTANTE
    Delete      => FORMULAIRE POUR SUPPRIMER UNE LIGNE EXISTANTE


```php
// ON AJOUTERA LE PREFIXE /admin A TOUTES LES ROUTES OBTENUES AVEC LE make:crud
// => ON PREPARE LA PROTECTION POUR AUTORISER L'ACCES SEULEMENT LES ADMINISTRATEURS

#[Route('/admin/newsletter')]                                                        // PREFIXE COMMUN POUR LES URLS DANS LA CLASSE
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'newsletter_index', methods: ['GET'])]                       // URL DANS LE NAVIAGATEUR /admin/newsletter/
    public function index(NewsletterRepository $newsletterRepository): Response
    {
    }

    #[Route('/new', name: 'newsletter_new', methods: ['GET', 'POST'])]              // URL DANS LE NAVIGATEUR /admin/newsletter/new
    public function new(Request $request): Response
    {
    }

}
```
    LES METHODES CONTROLLER SONT RELIEES A DES TEMPLATES TWIG
    QUI HERITENT DE base.html.twig

    => ATTENTION AU CODE DANS base.html.twig
        IL FAUT GARDER LES BLOCS title ET body

## ACTIVATION DU MODE BOOTSTRAP POUR LA PARTIE ADMIN
    MODIFIER LE FICHIER config/packages/twig.yaml

```yaml

twig:
    default_path: '%kernel.project_dir%/templates'
    form_themes: ['bootstrap_4_layout.html.twig']
```

    ET ENSUITE COMPLETER base.html.twig POUR CHARGER LE CODE DE BOOTSTRAP

```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {# Run `composer require symfony/webpack-encore-bundle`
           and uncomment the following Encore helpers to start using Symfony UX #}

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
   
        {% block stylesheets %}
            {#{{ encore_entry_link_tags('app') }}#}
        {% endblock %}
        
    </head>
    <body>
        <div class="container">
            {% block body %}{% endblock %}
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        {% block javascripts %}
            {#{{ encore_entry_script_tags('app') }}#}
        {% endblock %}
    </body>
</html>

```

## GIT EN LIGNE DE COMMANDE

    * pour commit

    git add -A
    git commit -a -m "message pour la modif"

    * pour envoyer sur github.com

    git push

    * pour récupérer sur github.com

    git pull

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// ne pas oublier de rajouter les lignes use...
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Newsletter;
use App\Form\NewsletterType;

class SiteController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $messageConfirmation    = 'merci de remplir le formulaire';
        $classConfirmation      = 'gris';

        $newsletter = new Newsletter(); // code créé avec le make:entity
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);
        // bloc if pour le traitement du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // alors on traite le formulaire

            // ici on peut compléter les infos manquantes
            $objetDate = new \DateTime();   // objet qui contient la date actuelle
            $newsletter->setDateInscription($objetDate);
    
            // on envoie les infos en base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletter);
            $entityManager->flush();

            // tout s'est bien passé
            $messageConfirmation    = 'merci de votre inscription';
            $classConfirmation      = 'vert';

            // pas de redirection pour la page d'accueil
            // return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('site/index.html.twig', [
            'classConfirmation'     => $classConfirmation,
            'messageConfirmation'   => $messageConfirmation,    // tuyau de transmission entre PHP et twig
            'newsletter' => $newsletter,
            'form' => $form->createView(),
            'controller_name' => 'SiteController',
        ]);
    }

    // ...
}

```

```twig
{% extends 'parent.html.twig' %}

{# 
le template enfant ne fait que remplir 
des blocks definis par le parent
#}

{% block titre1 %}
<h1>Accueil PAR DEV1</h1>

{{ form_start(form) }}
    {{ form_widget(form) }}
    <button class="btn">{{ button_label|default('Save') }}</button>
    <div class="{{ classConfirmation ?? 'gris' }}">{{ messageConfirmation ?? "texte par défaut" }}</div>
{{ form_end(form) }}

{% endblock %}


```
## GESTION DES UTILISATEURS ET SECURITE DANS SYMFONY
    LANCER DANS LE TERMINAL (DANS LE DOSSIER symfony/)

    php bin/console make:user

    ON A UNE BASE DE CODE POUR L'ENTITE User
    MAIS IL MANQUE DES PROPRIETES

    email           string(255)      VARCHAR(255)
    dateCreation    datetime         DATETIME

       LANCER LA COMMANDE POUR COMPLETER LES PROPRIETES...
    ...

    SE POSER DES QUESTIONS SUR LE RGPD ET LA LEGALITE DES INFOS SUR LES UTILISATEURS...

    * CONNECTER NOTRE ENTITE AVEC LE SYSTEME DE SECURITE DE SYMFONY

    PS C:\laragon\www\symfony> php bin/console make:auth

 What style of authentication do you want? [Empty authenticator]:  [0] Empty authenticator
  [1] Login form authenticator
 > 1

 The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > LoginFormAuthenticator

 Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
 > 

 Do you want to generate a '/logout' URL? (yes/no) [yes]:        
 >

      LANCER LA COMMANDE POUR COMPLETER LES PROPRIETES...

    php bin/console make:entity

    SE POSER DES QUESTIONS SUR LE RGPD ET LA LEGALITE DES INFOS SUR LES UTILISATEURS...

    * CONNECTER NOTRE ENTITE AVEC LE SYSTEME DE SECURITE DE SYMFONY

    * ON VA LANCER LA COMMANDE 

    php bin/console make:registration-form

    CA VA GENERER LE CODE...    