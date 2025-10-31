class FormEmployee {
    element = document.querySelector('#form-store-employee');
    url = '/company/dashboard/employee';
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    setMask() {
        $('#cpf').mask('000.000.000-00');
        $('#whatsapp').mask('(00) 00000-0000');
    }

    store() {
        this.element.addEventListener('submit', async (event) => {
            event.preventDefault(); 

            const name = document.querySelector('#name').value;
            const cpf = document.querySelector('#cpf').value;
            const role = document.querySelector('#role').value;
            const assignedHours = document.querySelector('#assigned-hours').value;
            const whatsapp = document.querySelector('#whatsapp').value;
            const email = document.querySelector('#email').value;

            const response = await fetch(this.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.token
                },
                body: JSON.stringify({
                    name: name,
                    cpf: cpf,
                    role: role,
                    assignedHours: assignedHours,
                    whatsapp: whatsapp,
                    email: email
                })
            });

            console.log(response); 
        })
    }
}

const formEmployee = new FormEmployee();