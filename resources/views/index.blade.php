<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Help Point</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

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
      justify-content: space-between;
      align-items: center;
      background-color: #0056b3;
      padding: 0.5rem 1rem;
      position: relative;
    }

    .navbar-brand {
      color: white !important;
      text-decoration: none;
      font-weight: bold;
    }

    .hamburger {
      display: flex;
      flex-direction: column;
      cursor: pointer;
      gap: 0.35rem;
    }

    .hamburger span {
      width: 25px;
      height: 3px;
      background-color: white;
      border-radius: 2px;
    }

    .nav-links {
      position: absolute;
      top: 100%;
      right: 1rem;
      background-color: #0056b3;
      display: flex;
      flex-direction: column;
      gap: 0;
      width: 200px;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
      padding: 0;
      margin: 0;
      list-style: none;
    }

    .hamburger:hover + .nav-links,
    .nav-links:hover {
      opacity: 1;
      visibility: visible;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      padding: 0.75rem 1rem;
      display: block;
      transition: background-color 0.2s ease;
    }

    .nav-links a:hover {
      background-color: #004085;
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
      <a class="navbar-brand" href="#">Brand</a>

      <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <div class="nav-links">
        <!-- <a href="/company/register">Registrar</a> -->
        <!-- <a href="/company/login">Entrar</a> -->
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
