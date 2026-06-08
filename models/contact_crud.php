<?php

function create_sauveteur(PDO $c, string $nom, string $prenom, string $dep, string $spe, string $date_heure, string $tel): void {
    $req = "INSERT INTO Sauveteur (nom, prenom, departement, specialite, DateHeureEngagement, NumTel)
            VALUES (:nom, :prenom, :dep, :spe, :date_heure, :tel)";

    $prep = $c->prepare($req);
    $prep->bindValue(':nom', $nom);
    $prep->bindValue(':prenom', $prenom);
    $prep->bindValue(':dep', $dep);
    $prep->bindValue(':spe', $spe);
    $prep->bindValue(':date_heure', $date_heure);
    $prep->bindValue(':tel', $tel);
    $prep->execute();
}
