<?php

function login_form_view(?string $route) {
    require('views/header.php');

    echo '<h2>Page d\'authentification</h2>';
    echo '<p>Merci de vous authentifier pour accéder à cette fonctionnalité.</p>';
    echo '<form action="index.php?route=auth&ask=' . $route . '" method="post">';
    echo '<p><label>Login :</label> <input type="text" name="login"></p>';
    echo '<p><label>Mot de passe :</label> <input type="password" name="password"></p>';
    echo '<p><input type="submit" value="Valider"></p>';
    echo '</form>';

    require('views/footer.php');
}
