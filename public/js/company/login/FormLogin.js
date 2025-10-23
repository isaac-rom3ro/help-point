class FormLogin {
    element = document.querySelector('#form-container');
    url = '/company/login';
    dashboard = '/company/dashboard';
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    setMask() {
        $('#cnpj').mask('00.000.000/0000-00');
    }

    whenSubmit() {
        this.element.addEventListener('submit', async (event) => {
            event.preventDefault();

            const cnpj = document.getElementById('cnpj').value;
            const password = document.getElementById('password').value;

            const response = await fetch(this.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.token
                },
                body: JSON.stringify({
                    cnpj: cnpj,
                    password: password
                })
            });

            console.log(response);

            if (response.status === 200) {
                location.href = this.dashboard;
            }
        });
    }
}

const formLogin = new FormLogin();