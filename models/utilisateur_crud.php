<?php

/**
 * Crée un nouveau compte utilisateur
 */
function create_utilisateur_crud(PDO $c, string $nom, string $prenom, string $role, string $nomdep, string $num_tel, string $login, string $mdp_hache): void
{
    $req = "INSERT INTO Utilisateur (login, passwd, type, nom, prenom, nomdep, num_tel)
            VALUES (:login, :passwd, :type, :nom, :prenom, :nomdep, :num_tel)";
    $prep = $c->prepare($req);
    $prep->bindValue(':login', $login);
    $prep->bindValue(':passwd', $mdp_hache);
    $prep->bindValue(':type', $role);
    $prep->bindValue(':nom', $nom);
    $prep->bindValue(':prenom', $prenom);
    $prep->bindValue(':nomdep', $nomdep);
    $prep->bindValue(':num_tel', $num_tel);
    $prep->execute();
}
