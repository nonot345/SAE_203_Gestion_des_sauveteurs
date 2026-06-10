<?php

/**
 * Récupère les infos d'authentification d'un utilisateur
 */
function recuperation_auth(PDO $connex, string $login): ?array
{
    require_once('config/config.php');
    $req = "SELECT ID, login, passwd, type FROM Utilisateur WHERE login = :login";
    $prep = $connex->prepare($req);
    $prep->bindValue(':login', $login);
    $prep->execute();
    $auth = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    return $auth ?: null;
}
