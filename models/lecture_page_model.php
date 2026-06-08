<?php

$pdo = new PDO('mysql:host=localhost;dbname=projet3_tp1;charset=utf8mb4', 'root', '');

$date = $_GET['date'] ?? date('Y-m-d');

$sauveteurs = $pdo->query('SELECT ID_Sauveteur, Nom, Prenom, Specialite FROM Sauveteur ORDER BY Nom, Prenom')->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT ID_Mission, DtaHeureDebut, DtaHeureFin, ID_Sauveteur FROM Mission WHERE DATE(DtaHeureDebut) = ? OR DATE(DtaHeureFin) = ?');
$stmt->execute([$date, $date]);
$missions = $stmt->fetchAll(PDO::FETCH_ASSOC);

