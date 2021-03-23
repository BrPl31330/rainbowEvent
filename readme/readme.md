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