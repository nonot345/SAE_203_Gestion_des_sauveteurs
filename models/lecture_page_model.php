<?php

require('config/config.php');

// Récupère tous les sauveteurs
function get_all_sauveteurs(PDO $c): array {
    $req = "SELECT ID, nom, prenom, specialite FROM Sauveteur ORDER BY Nom, Prenom";
    return $c->query($req)->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère les missions d'une date
function get_missions_by_date(PDO $c, string $date): array {
    $req = "
        SELECT ID, DateHeureDebut, DateHeureFin, ID_Sauveteur
        FROM Mission
        WHERE DATE(DateHeureDebut) = :date
           OR DATE(DateHeureFin) = :date
    ";

    $stmt = $c->prepare($req);
    $stmt->bindValue(':date', $date);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

