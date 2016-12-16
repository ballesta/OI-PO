<?php
    /* Redirection vers une page différente du même dossier */
    $host  = $_SERVER['HTTP_HOST'];

    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $page = 'client/page_acceuil.php';

    //echo "Location: http://$host$uri/$extra";
    header("Location: http://$host$uri/$page");

    exit;
?>
