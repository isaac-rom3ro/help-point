formSubmit = document.getElementById('form-register');
formSubmit.addEventListener('submit', async function(e) {
    e.preventDefault();

    const pError = document.querySelector('#p-error'); 

    const name = document.querySelector('#input-name').value;
    const cnpj = document.querySelector("#input-cnpj").value;
    const password = document.querySelector('#input-password').value;

    try {
        const url = 'http://localhost:8000/adm/register';

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                cnpj: cnpj,
                password: password
            })
        });

        const data = await response.json();

        if (response.status === 500) {
            // Internal Server Error
            pError.innerHTML = "Internal Server Error";
        }
        if (response.status === 400) {
            // Bad Request
            pError.innerHTML = "Bad Request";
        }
        if (response.status === 200) {
            // Success
            location.href = "http://localhost:8000/login";
        }

    } catch(error) {
        console.log(error);
    }
});