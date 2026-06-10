<?php

/**
 * Liste des statuts (utilisé pour les select)
 */
function get_statuts(PDO $pdo): array
{
    $sql = "SELECT ID, TypeStatut FROM Statut ORDER BY TypeStatut";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Liste des sauveteurs
 */
function get_sauveteurs(PDO $pdo): array
{
    $sql = "SELECT ID, nom, prenom, specialite FROM Sauveteur ORDER BY nom, prenom";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Missions d'une journée avec leur statut
 */
function get_missions_planning(PDO $pdo, string $date): array
{
    $sql = "SELECT m.ID_Sauveteur, m.DateHeureDebut, m.DateHeureFin, m.EnPrepa, s.TypeStatut
            FROM Mission m
            JOIN Statut s ON m.ID_statut = s.ID
            WHERE DATE(m.DateHeureDebut) = :date
               OR DATE(m.DateHeureFin)   = :date
            ORDER BY m.ID_Sauveteur, m.DateHeureDebut";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':date' => $date]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
