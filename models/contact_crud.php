<?php

function create_sauveteur(PDO $connex, $nom, $prenom, $dep, $spe, $date, $heure, $role, $tel)
{
    $req = "INSERT INTO Sauveteur
            (nom, prenom, dep, spe, ladate, lheure, role, tel)
            VALUES
            (:nom, :prenom, :dep, :spe, :date, :heure, :role, :tel)";

    $prep = $connex->prepare($req);

    $prep->bindValue(':nom', $nom);
    $prep->bindValue(':prenom', $prenom);
    $prep->bindValue(':dep', $dep);
    $prep->bindValue(':spe', $spe);
    $prep->bindValue(':tel', $tel);
    $prep->bindValue(':date', $date);
    

    $prep->execute();
}


