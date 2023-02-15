// Module d'affichage du formulaire d'inscription
export default function register() {
    const divRegister = document.getElementById('inscription')
    divRegister.innerHTML =
        `<form id="form-register" method="post">
<label for="login">Login</label>
<input id="login" name="login" type="text">
<label for="password">Mot de passe</label>
<input id="password" name="password" type="password">
<button type="submit" id="envoie" name="envoie">S'inscrire</button>
</form>`
}