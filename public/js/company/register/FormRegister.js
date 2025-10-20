class FormRegister {
    element = document.querySelector('#form-container');
    url = "/company/register";
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    setMask() {
        $('#cnpj').mask('00.000.000/0000-00');
    }

    whenSubmit() {
        this.element.addEventListener('submit', async (event) => {
        event.preventDefault();

        const companyName = document.getElementById('company-name').value;
        const companyCNPJ = document.getElementById('company-cnpj').value;
        const companyPassword = document.getElementById('company-password').value;

        const registerCompanyURL = '/company/register';

        const response = await fetch(registerCompanyURL, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
            companyName: companyName,
            companyCNPJ: companyCNPJ,
            companyPassword: companyPassword
            })
        });

        if (response.status === 201) {
            location.href = '/company/login';
        }

        console.log(response);
        });
    }
}

const formRegister = new FormRegister();