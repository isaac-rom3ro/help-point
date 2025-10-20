class FormLogin {
    element = document.querySelector('#form-container');
    url = '/company/login';
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    setMask() {
        $('#company-cnpj').mask('00.000.000/0000-00');
    }

    whenSubmit() {
        this.element.addEventListener('submit', async function(event) {
            event.preventDefault();

            const companyCNPJ = document.getElementById('company-cnpj').value;
            const companyPassword = document.getElementById('company-password').value;

            const response = await fetch(this.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.token
                },
                body: JSON.stringify({
                    companyCNPJ: companyCNPJ,
                    companyPassword: companyPassword
                })
            });

            console.log(response);

            if (response.status === 200) {
                location.href = '/company/dashboard';
            }
        });
    }
}

const formLogin = new FormLogin();