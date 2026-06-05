<?php

// On inclut le fichier de connexion à la base de données
require_once('../config/config.php');

// Fonction pour récupérer tous les comptes dans la table Utilisateur
// On joint avec Sauveteur pour avoir le nom et le prénom
function getAllComptes($conn) {
    $sql = "SELECT Utilisateur.ID, Utilisateur.login, Utilisateur.type, 
                   Sauveteur.nom, Sauveteur.prenom, Sauveteur.departement, Sauveteur.NumTel
            FROM Utilisateur
            JOIN Sauveteur ON Sauveteur.ID = Utilisateur.ID";
    
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Fonction pour récupérer un seul compte à partir de son ID
function getCompteById($conn, $id) {
    $sql = "SELECT Utilisateur.ID, Utilisateur.login, Utilisateur.type,
                   Sauveteur.nom, Sauveteur.prenom, Sauveteur.departement, Sauveteur.NumTel
            FROM Utilisateur
            JOIN Sauveteur ON Sauveteur.ID = Utilisateur.ID
            WHERE Utilisateur.ID = $id";

    $result = mysqli_query($conn, $sql);
    // On retourne directement la ligne du résultat
    return mysqli_fetch_assoc($result);
}

// Fonction pour mettre à jour un compte dans la base de données
function updateCompte($conn, $id, $nom, $prenom, $role, $departement, $numtel, $login, $passwd) {

    // Mise à jour de la table Sauveteur (nom, prénom, département, téléphone)
    $sql1 = "UPDATE Sauveteur 
             SET nom = '$nom', prenom = '$prenom', departement = '$departement', NumTel = '$numtel'
             WHERE ID = $id";
    mysqli_query($conn, $sql1);

    // Mise à jour de la table Utilisateur (login, type/rôle)
    $sql2 = "UPDATE Utilisateur 
             SET login = '$login', type = '$role'
             WHERE ID = $id";
    mysqli_query($conn, $sql2);

    // On met à jour le mot de passe seulement si l'utilisateur en a saisi un nouveau
    if ($passwd != "") {
        // On utilise password_hash pour ne pas stocker le mot de passe en clair
        $passwd_hash = password_hash($passwd, PASSWORD_DEFAULT);
        $sql3 = "UPDATE Utilisateur 
                 SET passwd = '$passwd_hash'
                 WHERE ID = $id";
        mysqli_query($conn, $sql3);
    }
}
?>
