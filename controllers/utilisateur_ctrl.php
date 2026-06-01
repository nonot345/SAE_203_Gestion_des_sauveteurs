<?php

error_reporting (E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);


function add_utilisateurs_form_ctrl() {
    require('views/creation_compte_view.php');
}


function add_utilisateurs_write_ctrl() {
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $role = $_POST['role'];
        $nomdep = $_POST['nomdep'];
        $num_tel = $_POST['num_tel'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $nom) || !preg_match('/^[a-zA-Z0-9_-]+$/', $login)) {
            
            $_SESSION['notification'] = "<span style='color:red;'>Erreur : Le nom ou le login contient des caractère non autorisés.</span>";
            require('views/add_utilisateur_form_view.php');
            
        } else {
            
            $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);
            
            create_utilisateur_crud($nom, $prenom, $role, $nomdep, $num_tel, $login, $mdp_hache);
            
            $_SESSION['notification'] = "Ajout du nouvel utilisateur réussi";
            
            header('Location: index.php');
            exit();
        }
    }
}
?>