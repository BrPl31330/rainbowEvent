//On initialise le compteur à 0
let compteur = 0;


// On attend que le document soit chargé
window.onload = function () {

    // *********************Diaporama********************************
    // on va chercher toutes les classes diapo__element
    const ELEMENTS = document.querySelectorAll(".diapo__element");

    //On compte le nombre d'image (pour savoir ou arrêter le compteur)
    const NB_IMAGES = ELEMENTS.length;

    //on va chercher l'élément "fleche droite"
    const DROITE = document.querySelector("#fleche-droite");

    //On écoute l'événement "click"
    DROITE.addEventListener("click", function () {
        //on fait avancer une image
        //on fait évoluer le compteur (0, 1, 2, 0, 1, 2...)
        //avant de changer le compteur on enleve la classe diapo__element--active
        //on se trouve sur l'image à masquer
        ELEMENTS[compteur].classList.remove("diapo__element--active");

        //on vérifie si on est à la dernier image
        if (compteur === NB_IMAGES - 1) {
            compteur = 0;
        } else {
            compteur++;
        }

        //Après avoir changé le compteur on ajoute la classe diapo__element--active
        //on se trouve sur l'image à afficher
        ELEMENTS[compteur].classList.add("diapo__element--active");
    });

    const GAUCHE = document.querySelector("#fleche-gauche");
    //On écoute l'événement "click"
    GAUCHE.addEventListener("click", function () {
        //on fait reculer une image
        //on fait évoluer le compteur (0, 2, 1, 0, 2, 1...)
        //avant de changer le compteur on enleve la classe diapo__element--active
        //on se trouve sur l'image à masquer
        ELEMENTS[compteur].classList.remove("diapo__element--active");

        //on vérifie si on est à la première image
        if (compteur === 0) {
            //si on est à la première image on va à la dernière
            compteur = NB_IMAGES - 1;
        } else {
            //sinon on décrémente e compteur
            compteur--;
        }
        //Après avoir changé le compteur on ajoute la classe diapo__element--active
        //on se trouve sur l'image à afficher
        ELEMENTS[compteur].classList.add("diapo__element--active");
    });

    // ****************Questionnaire footer******************************
    


} //Fin window.onload