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
      background-color: #007bff;
      color: white;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      display: flex;
      justify-content: center; /* center brand */
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
      background-color: rgba(255, 255, 255, 0.15); /* slightly darker */
      padding: 2.5rem;
      border-radius: 1rem;
      width: 320px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* soft shadow */
      backdrop-filter: blur(5px); /* subtle blur */
    }
    .form-control {
      margin-bottom: 1rem;
      border-radius: 0.5rem;
      border: none;
    }
    .form-control:focus {
      box-shadow: none;
      outline: 2px solid #ffffff80; /* subtle focus effect */
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
        <h3 class="text-center mb-4">Bem Vindo de Volta!</h3>
        <input type="text" id="company-cnpj" class="form-control" placeholder="CNPJ">
        <input type="password" id="company-password" class="form-control" placeholder="Senha">
        <button type="submit" class="btn btn-primary mt-2">Entrar</button>
      </form>
    </div>
  </div>

<!-- Jquery Lib -->
<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

<!-- jQuery Mask Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
  $(function () {
    $('#company-cnpj').mask('00.000.000/0000-00');
  });
</script>

<script>
    const form = document.getElementById('form-container');
    
    form.addEventListener('submit', async function(event) {
        event.preventDefault(); 

        const companyCNPJ = document.getElementById('company-cnpj').value;
        const companyPassword = document.getElementById('company-password').value;

        const loginCompanyURL = '/company/login';  

        const response = await fetch(loginCompanyURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                companyCNPJ: companyCNPJ,
                companyPassword: companyPassword
            })
        });

        console.log(response);
  });
</script>
</body>
</html>

