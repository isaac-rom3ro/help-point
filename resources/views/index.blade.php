<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Full VH Page</title>
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
      justify-content: space-between;
      align-items: center;
      background-color: #0056b3;
      padding: 0.5rem 1rem;
    }

    .nav-links {
      display: flex;
      gap: 1rem; /* spacing between links */
    }

    .nav-links a {
      color: white;
      text-decoration: none;
    }

    .content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 2rem;
    }
  </style>
</head>
<body>
  <div class="full-vh">
    <nav class="navbar w-100">
      <a class="navbar-brand text-white" href="#">Brand</a>
      <div class="nav-links">
        <a href="/company/register">Registrar</a>
        <a href="/company/login">Entrar</a>
        <a href="#">Contatos</a>
        <a href="#">Sobre Nós</a>
      </div>
    </nav>

    <div class="content">
        <a class="navbar-brand text-white" href="#"><img src="{{ asset('images/logo-1.png') }}" alt="" width="256px" height="256px"></a>
    </div>
  </div>
</body>
</html>
