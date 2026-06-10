<?php

/**
 * Formulaire de connexion
 */
function login_form_view(?string $route)
{
    require('views/header.php');
    echo '<h2>Connexion</h2>';
    echo '<p>Merci de vous authentifier pour accéder à l\'application.</p>';
    echo '<form action="index.php?route=auth&ask=' . $route . '" method="post">';
    echo '<p><label>Login :</label> <input type="text" name="login"></p>';
    echo '<p><label>Mot de passe :</label> <input type="password" name="password"></p>';
    echo '<p><input type="submit" value="Se connecter"></p>';
    echo '</form>';
    require('views/footer.php');
}
