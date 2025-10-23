<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Empresa</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/company/register/style.css') }}">
</head>
<body>
  <div class="full-vh">
    <!-- Navbar -->
    <nav class="navbar w-100">
      <a class="navbar-brand text-white" href="#">Brand</a>
    </nav>

    <!-- Registration Form -->
    <div class="content">
      <form id="form-container" class="form-container">
        <h3 class="text-center mb-4">Registre sua Empresa</h3>
        <input type="text" id="legal-name" class="form-control" placeholder="Nome da Empresa">
        <input type="text" id="cnpj" class="form-control" placeholder="CNPJ">
        <input type="password" id="password" class="form-control" placeholder="Senha">
        <button type="submit" class="btn btn-primary mt-2">Registrar</button>
      </form>
    </div>

    <!-- Footer Text -->
    <div class="footer-text">
      Já tem uma conta? <a href="/company/login">Entre aqui</a> para utilizar os serviços disponíveis para sua empresa.
    </div>
  </div>

  <!-- jQuery Lib -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- jQuery Mask Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <!-- JS -->
  <script src="{{ asset('js/company/register/FormRegister.js') }}"></script>

  <script>
    $(function() {
      formRegister.setMask();
      formRegister.whenSubmit();
    });
  </script>
</body>
</html>