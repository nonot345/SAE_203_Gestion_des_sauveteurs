<?php

/**
 * Switch to the appropriate controller according to HTTP method
 */
function contact_ctrl() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        contact_write_ctrl();
    } else {
        contact_form_ctrl();
    }
}

/**
 * Form display
 */
function contact_form_ctrl() {
    // Print form
    require('views/contact_form_view.php');
}

/**
 * Form processing
 */
function contact_write_ctrl() {
    // On récupère les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dep = $_POST['dep'];
    $spe = $_POST['spe'];
    $tel = $_POST['tel'];
    $date = $_POST['ladate_lheure'];
    
   

    // On peut ajouter une petite validation simple
    if (empty($nom) || empty($prenom) || empty($tel)) {
        echo "Veuillez remplir tous les champs obligatoires !";
        return;
    }

    // Connexion à la base
    require('models/connection.php');
    $c = connection();

    // Création de la personne
    require('models/contact_crud.php');
    create_personne($spe, $nom, $prenom, $dep,$tel, $date_heure, $c);

    // Affichage de la page de confirmation
    require('views/welcome_view.php');
}