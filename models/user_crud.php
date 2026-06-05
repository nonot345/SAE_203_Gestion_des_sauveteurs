<?php



function recuperation_auth(PDO $connex, int $id):array {
	 require('config/config.php');
    $req = "SELECT login, passwd, type FROM Utilisateur WHERE login = :login";
    
    $prep = $connex->prepare($req);
    $prep->bindValue(':id', $id);
    $prep->execute();
    $auth = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    return $auth;
 }
 