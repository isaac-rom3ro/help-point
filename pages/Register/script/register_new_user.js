formSubmit = document.getElementById('form-register');
formSubmit.addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData();

    const name = document.querySelector('#input-name').value;
    const password = document.querySelector('#input-password').value;

    formData.append('name', name);
    formData.append('password', password);

    // Show key and values from form
    // formData.forEach((value, key) => {
    //     console.log(key, value);
    // });

    try {
        const url = 'http://localhost:8000/register';

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

        const data = await response.json();

        // Show the api_key
        // Maybe let's save it inside a login?
        document.querySelector('#p-api-key').innerHTML = `User registered, here it's your api key: ${data.api_key}`;
    } catch(error) {
        console.log(error);
    }
});