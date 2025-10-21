<!DOCTYPE html>

<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Help Point</title>

    <!-- BOOTSTRAP -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/index/style.css') }}">
  </head>

  <body>
    <div class="full-vh">
      <nav class="navbar w-100">
        <a class="navbar-brand" href="#">Brand</a>

        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>

        <div class="nav-links">
          <a href="/company/login">Sou Empresa</a>
          <a href="/employee/login">Sou Funcionario</a>
          <a href="#">Sobre Nós</a>
          <a href="#">Contato</a>
        </div>
      </nav>

      <div class="content">
        <!-- Main content goes here -->
      </div>
    </div>
  </body>
</html>