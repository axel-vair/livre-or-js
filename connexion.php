<?php
require_once 'src/User.php';

if (isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = $_POST['password'];
//    $hash_password = $results['password'];
//    password_verify($password, $results['password']); //vérifier le pass

    $new_connection = new User();
    //var_dump($new_connection->connection($login, $password));
    echo $new_connection->connection($login, $password);

    die();
}


?>
<h1>Connexion</h1>
<form id="form-connection" method="post">
    <label for="login">Login</label>
    <input id="login" name="login" type="text">
    <label for="password">Mot de passe</label>
    <input id="password" name="password" type="password">
    <button type="submit" id="connect_form_button" name="submit">Se connecter</button>
</form>


