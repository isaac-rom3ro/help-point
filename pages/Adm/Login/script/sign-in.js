const formLogin = document.querySelector('#form-login');
formLogin.addEventListener('submit', async function(e) {
    e.preventDefault();

    const cnpj = document.querySelector('#input-cnpj').value;
    const password = document.querySelector('#input-password').value;

    const url = "http://localhost:8000/adm/login"

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            cnpj: cnpj,
            password: password
        })
    });

    if (response.status === 200) {
        location.href = "http://localhost:8000/point"
    } else if(response.status === 403) {
        document.querySelector("#p-error").innerHTML = "Incorrect Credentials";
    } else if(response.status === 404) {
        document.querySelector("#p-error").innerHTML = "User not Found";
    }
}) ;