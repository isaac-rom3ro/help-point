<!DOCTYPE html>

<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Entrar</title>

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
          <input type="text" id="cnpj" class="form-control" placeholder="CNPJ">
          <input type="password" id="password" class="form-control" placeholder="Senha">
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
    
    <!-- JS -->
    <script src="{{ asset('js/company/login/FormLogin.js') }}"></script>

    <script>
      $(function() {
        formLogin.setMask();
        formLogin.whenSubmit();
      });
    </script>
  </body>
</html>