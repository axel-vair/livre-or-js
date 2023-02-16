const btnRegister = document.getElementById('btn-register')
const btnConnection = document.getElementById('btn-connection')

btnRegister.addEventListener('click', async () => {
    await fetch('inscription.php')
        .then((response) => {
            return response.text()
        })
        .then((content) => {
            const divRegister = document.getElementById('inscription')
            divRegister.innerHTML = content;
        })
    let form = document.querySelector('#form-register')
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const myRegisterForm = new FormData(form);
        fetch('inscription.php', {
            method: "POST",
            body: myRegisterForm
        })

    })

})

btnConnection.addEventListener('click', async() => {
    await fetch('connexion.php')
        .then((response) => {
            return response.text()
        })
        .then((content) => {
            const divConnection = document.getElementById('connection')
            divConnection.innerHTML = content;
            let formConnection = document.querySelector('#form-connection')
            formConnection.addEventListener('submit', (e) => {
                e.preventDefault();
                const myConnectionForm = new FormData(formConnection);
                fetch('connexion.php', {
                    method: "POST",
                    body: myConnectionForm
                })
                    .then((response_connect) => {
                        return response_connect;
                    })
        })


    })


})

