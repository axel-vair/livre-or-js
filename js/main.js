// Hub JS qui vient appeler les modules.

import register from './Inscription.js';
import connexion from './Connexion.js';

const btnRegister = document.getElementById('btn-register')
const btnConnection = document.getElementById('btn-connection')

btnRegister.addEventListener('click', () => {
    register();
})

btnConnection.addEventListener('click', () => {
    connexion();
})

