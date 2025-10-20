<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/company/login/style.css') }}">

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

    <!-- Footer Text -->
    <div class="footer-text">
      Não tem uma conta? <a href="/company/register">Cadastre aqui</a> para aproveitar os benefícios de fazer parte da Help Point!
    </div>
  </div>

  <!-- jQuery Lib -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- jQuery Mask Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <script>
    $(function() {
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
      if (response.status === 200) {
        location.href = '/company/dashboard';
      }
    });
  </script>
</body>
</html>