<?php
require_once 'src/User.php';
?>

<form id="form-register" method="post">
    <label for="login">Login</label>
    <input id="login" name="login" type="text">
    <label for="password">Mot de passe</label>
    <input id="password" name="password" type="password">
    <button type="submit" id="envoie" name="envoie">S'inscrire</button>
</form>


<?php

if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];

    $new_user = new User();
    $new_user->register($login, $password);
}