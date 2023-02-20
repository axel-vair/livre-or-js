<?php

$getHeader = function($isConnected) {
    $header = "<header><nav class='nav'><a href=''>ACCUEIL</a><a href=''>Livre d'or</a>";

    if (!$isConnected) {
        $header .= "
        <a role='button' id='btn-register'>Inscription</a>
        <button id='btn-connection'>Connexion</button>";
    } else {
        $header .= "
        <a id='btn-register'>Profil</a>
        <a href='logout.php'>Deconnexion</a>
        <a id='btn-connection'>Commenter</a>
        ";
    }

    // finish it

    $header .= "</ul></nav></header>";

    return $header;
};

if (isset($_GET['textOnly'])) {
//    echo "I love you more more more";
    echo $getHeader(true);
    exit();
}


require_once "src/User.php";
session_start();
// var_dump($_SESSION);




// check if user is connected
$isConnected = isset($_SESSION['login']);

$headerHTML = $getHeader($isConnected);

echo $headerHTML;





