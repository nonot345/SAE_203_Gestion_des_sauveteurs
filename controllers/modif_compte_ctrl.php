<?php

// On inclut le modèle qui contient les fonctions pour la base de données
require_once('../models/modif_compte_model.php');

// On récupère tous les comptes pour afficher la liste à gauche
$resultComptes = getAllComptes($conn);

// Variable pour stocker le compte sélectionné (null par défaut)
$compteSelectionne = null;

// Variable pour afficher un message de confirmation ou d'erreur
$message = "";

// --- CAS 1 : L'utilisateur a cliqué sur un nom dans la liste ---
// On vérifie si un ID est passé dans l'URL (ex: modif_compte_view.php?id=3)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // On récupère les infos du compte correspondant à cet ID
    $compteSelectionne = getCompteById($conn, $id);
}

// --- CAS 2 : L'utilisateur a cliqué sur le bouton "Enregistrer" ---
// On vérifie si le formulaire a été envoyé (méthode POST)
if (isset($_POST['enregistrer'])) {

    // On récupère les données saisies dans le formulaire
    $id          = $_POST['id'];
    $nom         = $_POST['nom'];
    $prenom      = $_POST['prenom'];
    $role        = $_POST['role'];
    $departement = $_POST['departement'];
    $numtel      = $_POST['numtel'];
    $login       = $_POST['login'];
    $passwd      = $_POST['passwd'];

    // On appelle la fonction du modèle pour mettre à jour la base de données
    updateCompte($conn, $id, $nom, $prenom, $role, $departement, $numtel, $login, $passwd);

    // On prépare un message de confirmation
    $message = "Le compte a bien été modifié.";

    // On recharge les infos du compte pour les réafficher dans le formulaire
    $compteSelectionne = getCompteById($conn, $id);
}

// On affiche la vue
require_once('../views/modif_compte_view.php');
?>
