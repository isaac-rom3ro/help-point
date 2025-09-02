const formLogin = document.querySelector('#form-login');
formLogin.addEventListener('submit', async function(e) {
    e.preventDefault();

    const name = document.querySelector('#input-name').value;
    const password = document.querySelector('#input-password').value;

    const url = "http://localhost:8000/login"

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            password: password
        })
    });
}) ;