<?php

/**
 * Récupère tous les comptes utilisateurs
 */
function get_all_comptes(PDO $c): array
{
    $req = "SELECT ID, login, type, nom, prenom, nomdep, num_tel FROM Utilisateur ORDER BY nom, prenom";
    $res = $c->query($req);
    $comptes = $res->fetchAll(PDO::FETCH_ASSOC);
    $res->closeCursor();
    return $comptes;
}

/**
 * Récupère un compte par son ID
 */
function get_compte_by_id(PDO $c, int $id): ?array
{
    $req = "SELECT ID, login, type, nom, prenom, nomdep, num_tel FROM Utilisateur WHERE ID = :id";
    $prep = $c->prepare($req);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->execute();
    $compte = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    return $compte ?: null;
}

/**
 * Met à jour un compte (mot de passe optionnel)
 */
function update_compte(PDO $c, int $id, string $nom, string $prenom, string $role, string $nomdep, string $num_tel, string $login, string $passwd): void
{
    $req = "UPDATE Utilisateur SET nom = :nom, prenom = :prenom, type = :role, nomdep = :dep, num_tel = :tel, login = :login WHERE ID = :id";
    $prep = $c->prepare($req);
    $prep->bindValue(':nom', $nom);
    $prep->bindValue(':prenom', $prenom);
    $prep->bindValue(':role', $role);
    $prep->bindValue(':dep', $nomdep);
    $prep->bindValue(':tel', $num_tel);
    $prep->bindValue(':login', $login);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->execute();

    if (!empty($passwd)) {
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        $req2 = "UPDATE Utilisateur SET passwd = :passwd WHERE ID = :id";
        $prep = $c->prepare($req2);
        $prep->bindValue(':passwd', $hash);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);
        $prep->execute();
    }
}
