<?php

function recuperation_auth(PDO $c, string $login): ?array {
    $req = "SELECT login, passwd, type FROM Utilisateur WHERE login = :login";
    $prep = $c->prepare($req);
    $prep->bindValue(':login', $login);
    $prep->execute();
    $auth = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    return $auth ?: null;
}
