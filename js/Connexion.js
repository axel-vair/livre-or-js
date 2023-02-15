// Module d'affichage du formulaire de connexion
export default function connexion() {
    const divConnexion = document.getElementById('connection')
    divConnexion.innerHTML =
        `<form id="form-connection" method="post">
<label for="login">Login</label>
<input id="login" name="login" type="text">
<label for="password">Mot de passe</label>
<input id="password" name="password" type="password">
<button type="submit" id="connect_form_button" name="submit">Se connecter</button>
</form>`

}