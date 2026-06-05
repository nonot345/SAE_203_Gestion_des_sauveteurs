<?php
    /**
     * The front controller
     * Vincent Verdon - 20240604
     */

    
    //Loads some functions for session managment and starts the session
    require('controllers/auth_utilities.php');
    session_start();
    //var_dump($_SESSION);
    
    //Erreurs à afficher SEULEMENT en phase de développement !
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    
    //The requested route
    $route = null;
    if (isset($_GET['route'])) {
        $route = 'invalid';
        if (preg_match('#^[a-zA-Z0-9 _]*$#', $_GET['route'])) {
            $route = $_GET['route'];
        }
    }
    
    //We switch to the good controller
    switch ($route) {

    
        case null:
            require('views/welcome_view.php');
            break;

        case '':
            require('views/welcome_view.php');
            break;
            
        case 'families':
            require('controllers/family_ctrl.php');
            families_list_ctrl();
            break;
            
        case 'family':
            require('controllers/family_ctrl.php');
            family_print_ctrl();
            break;
            
        case 'contact':
            require('views/contact_view.php');
            break;
            
        case 'solutions':
            require('controllers/solution_ctrl.php');
            solutions_list_ctrl();
            break;
            
        case 'add_equipment':
            require('controllers/equipment_ctrl.php');
            add_equipment_ctrl();
            break;

        case 'auth':
            require('controllers/auth_ctrl.php');
            login_ctrl();
            break;
              
        case 'logout':
            require('controllers/auth_ctrl.php');
            logout_ctrl();
            break;

        case 'add_utilisateurs_form':
            require('controllers/utilisateur_ctrl.php');
            add_utilisateurs_form_ctrl();
            break;

        case 'add_utilisateurs':
             require('controllers/utilisateur_ctrl.php');
            add_utilisateurs_write_ctrl();
            break;
                  

        case 'operations':
            require('views/operations_view.php');
            break;

        default:
            require('views/404_view.php');
            break;
            
    }
