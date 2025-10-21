class FormRegister {
    element = document.querySelector('#form-container');
    url = "/company/register";
    login = "/company/login";
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    setMask() {
        $('#cnpj').mask('00.000.000/0000-00');
    }

    whenSubmit() {
        this.element.addEventListener('submit', async (event) => {
            event.preventDefault();

            const legalName = document.querySelector('#legal-name').value;
            const cnpj = document.querySelector('#cnpj').value;
            const password = document.querySelector('#password').value;

            const response = await fetch(this.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.token
                },
                body: JSON.stringify({
                    legalName: legalName,
                    cnpj: cnpj,
                    password: password,
                })
            });

            if (response.status === 201) {
                location.href = this.login;
            }

            console.log(response);
        });
    }
}

const formRegister = new FormRegister();