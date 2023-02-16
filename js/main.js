const btnRegister = document.getElementById('btn-register')
const btnConnection = document.getElementById('btn-connection')
const spanMessage = document.getElementById('registerSuccess')

btnRegister.addEventListener('click', async () => {
    await fetch('inscription.php')
        .then((response) => {
            return response.text()
        })
        .then((content) => {
            const divRegister = document.getElementById('forms')
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
            .then((resp) =>{
                if(resp.ok){
                    return resp.json();
                }
        })
            .then((contentResp) => {
                if(contentResp['response'] === 'ok'){
                    document.getElementById('registerSuccess').innerHTML = contentResp['reussite'];
                    spanMessage.innerText = contentResp['reussite'];

                }else{
                    document.getElementById('registerSuccess').innerHTML = contentResp['echoue']
                    spanMessage.innerText = contentResp['echoue'];
                }
            })

    })

})

btnConnection.addEventListener('click', async() => {
    await fetch('connexion.php')
        .then((response) => {
            return response.text()
        })
        .then((content) => {
            const divConnection = document.getElementById('forms')
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
                        if((response_connect.ok)){
                            return response_connect.json();
                        }
                    })
                    .then((contentResponse_connect) => {
                        console.log(contentResponse_connect)

                        if(contentResponse_connect['reponse'] === "ok"){
                            document.getElementById('registerSuccess').innerHTML = contentResponse_connect['reussite'];
                            spanMessage.innerText = contentResponse_connect['reussite'];

                        }else{
                            document.getElementById('registerSuccess').innerHTML = contentResponse_connect['echoue']
                            spanMessage.innerText = contentResponse_connect['echoue'];
                        }
                    })
        })


    })


})

