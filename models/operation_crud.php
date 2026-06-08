<?php

function create_operation_crud(PDO $connex, string $date_debut, string $date_fin, string $lieu, int $en_prepa, int $id_sauveteur, int $id_statut, int $id_utilisateur): bool {
    
    // On insère les données dans la table Mission avec le champ Lieu ajouté
    $req = "INSERT INTO Mission (DateHeureDebut, DateHeureFin, EnPrepa, ID_Sauveteur, ID_statut, ID_Utilisateur, Lieu) 
            VALUES (:date_debut, :date_fin, :en_prepa, :id_sauveteur, :id_statut, :id_utilisateur, :lieu)";
    
    $prep = $connex->prepare($req);
    
    $prep->bindValue(':date_debut', $date_debut);
    $prep->bindValue(':date_fin', $date_fin);
    $prep->bindValue(':lieu', $lieu);
    $prep->bindValue(':en_prepa', $en_prepa, PDO::PARAM_INT);
    $prep->bindValue(':id_sauveteur', $id_sauveteur, PDO::PARAM_INT);
    $prep->bindValue(':id_statut', $id_statut, PDO::PARAM_INT);
    $prep->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    
    $resultat = $prep->execute();
    $prep->closeCursor();
    
    return $resultat;
}
?>