<?php

require_once 'config.php';

// Récupère tous les sauveteurs
function get_all_sauveteurs(PDO $c): array {
    $req = "SELECT ID_Sauveteur, Nom, Prenom, Specialite FROM Sauveteur ORDER BY Nom, Prenom";
    $res = $c->query($req);
    $sauveteurs = $res->fetchAll(PDO::FETCH_ASSOC);
    $res->closeCursor();
    return $sauveteurs;
}

// Récupère les missions d'une journée
function get_missions_by_date(PDO $c, string $date): array {
    $req = "SELECT ID_Mission, DtaHeureDebut, DtaHeureFin, ID_Sauveteur FROM Mission WHERE DATE(DtaHeureDebut) = :date OR DATE(DtaHeureFin) = :date";
    $prep = $c->prepare($req);
    $prep->bindValue(':date', $date, PDO::PARAM_STR);
    $prep->execute();
    $missions = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    return $missions;
}


