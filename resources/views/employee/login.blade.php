<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    .full-vh {
      height: 100vh;
      background-color: #ffffffff;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #0056b3;
      padding: 1rem 0;
    }

    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: rgba(38, 114, 255, 1);
      padding: 2.5rem;
      border-radius: 1rem;
      width: 320px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(5px);
    }

    .form-control {
      margin-bottom: 1rem;
      border-radius: 0.5rem;
      border: none;
    }

    .form-control:focus {
      box-shadow: none;
      outline: 2px solid #ffffff80;
    }

    .btn-primary {
      width: 100%;
      background-color: #0056b3;
      border: none;
      border-radius: 0.5rem;
      padding: 0.5rem;
    }

    .btn-primary:hover {
      background-color: #004494;
    }
  </style>
</head>

<body>
  <div class="full-vh">
    <!-- Navbar -->
    <nav class="navbar w-100">
      <a class="navbar-brand text-white" href="#">Brand</a>
    </nav>

    <!-- Login Form -->
    <div class="content">
      <form id="form-container" class="form-container">
        <h3 class="text-center mb-4">Bem Vindo!</h3>
        <input type="text" id="employee-cpf" class="form-control" placeholder="CPF">
        <input type="password" id="employee-password" class="form-control" placeholder="Senha">
        <button type="submit" class="btn btn-primary mt-2">Entrar</button>
      </form>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-primary">
        <div class="modal-header border-0">
          <h5 class="modal-title text-white" id="changePasswordLabel">Alterar Senha</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="change-password-form">
            <input type="text" class="form-control mb-3" id="employee-cpf-update-password" placeholder="CPF">
            <input type="password" class="form-control mb-3" id="current-password" placeholder="Senha Atual">
            <input type="password" class="form-control mb-3" id="new-password" placeholder="Nova Senha">
            <!-- <input type="password" class="form-control" id="confirm-password" placeholder="Confirmar Senha"> -->
          </form>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="btn-update-password" class="btn btn-dark">Alterar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"
          integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
          crossorigin="anonymous"></script>

  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery Mask Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <script>
    $(function () {
      $('#employee-cpf').mask('000.000.000-00');
      $('#employee-cpf-update-password').mask('000.000.000-00');
    });
  </script>

  <script>
    // Get modal password update reference
    const changePasswordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));

    // Show modal
    function showChangePasswordModal() {
      $('#employee-cpf-update-password').val($('#employee-cpf').val());
      $('#current-password').val($('#employee-password').val());
      changePasswordModal.show();
    }

    // Hide modal
    function hideChangePasswordModal() {
      changePasswordModal.hide();
    }

    // Update Password
    const btnUpdatePassword = document.querySelector('#btn-update-password');
    btnUpdatePassword.addEventListener('click', async function (event) {
      const employeeCpf = document.getElementById('employee-cpf-update-password').value;
      const currentPassword = document.getElementById('current-password').value;
      const newPassword = document.getElementById('new-password').value;

      const updateLoginURL = '/employee/login/password';

      const response = await fetch(updateLoginURL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          employeeCpf: employeeCpf,
          currentPassword: currentPassword,
          newPassword: newPassword
        })        
      });

      if (response.status === 201) {
        location.href = "/employee/dashboard";
      }

    });

    // Login form submission
    const form = document.getElementById('form-container');
    form.addEventListener('submit', async function (event) {
      event.preventDefault();

      const employeeCpf = document.getElementById('employee-cpf').value;
      const employeePassword = document.getElementById('employee-password').value;
      const loginEmployeeURL = '/employee/login';

      const response = await fetch(loginEmployeeURL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          employeeCpf: employeeCpf,
          employeePassword: employeePassword
        })
      });

      console.log(response);
      if (response.status === 200) {
        location.href = '/employee/dashboard';
      } else if (response.status === 202) {
        showChangePasswordModal();
      } else if (response.status === 201) {
        location.reload();        
      }
    });
  </script>
</body>
</html>
