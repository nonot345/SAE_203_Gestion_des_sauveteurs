<?php

/**
 * Crée une connexion PDO
 * @return PDO
 */
function connection(): PDO
{
    require_once('config/config.php');
    return new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
}
