
<?php
#ceci est la partie "view" de la page de login, le header et le footer ne sont pour l'instant pas actif


function login_form_view(?string $route) {
    #require('header.php');

    echo '<h2>Page d\'authentification</h2>';
    echo '<form action="index.php?route=auth&ask=' . $route . '" method="post">';
    echo '<p>Login<input type="text" name="login" /></p>';
    echo '<p>Mot de passe<input type="password" name="password" /></p>';
    echo '<p><input type="submit" value="Valider" /></form>';

    #require('footer.php');
}