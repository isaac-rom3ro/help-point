<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
html, body {
    height: 100%;
    margin: 0;
}

.dashboard-container {
    display: flex;
    height: 100vh;
    overflow: hidden;
}

/* Sidebar */
.sidebar {
    width: 80px;
    background: linear-gradient(180deg, #0056b3 0%, #003d82 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 0;
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.sidebar-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    border-radius: 0.5rem;
    transition: background-color 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.sidebar-icon:hover {
    background-color: rgba(255, 255, 255, 0.15);
    color: white;
}

.sidebar-icon.active {
    background-color: rgba(255, 255, 255, 0.25);
}

/* Main content */
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    background-color: #f5f6fa;
    min-width: 0;
}

/* Top bar */
.top-bar {
    height: 70px;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    flex-shrink: 0;
}

.brand-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #007bff;
}

.profile-icon {
    width: 45px;
    height: 45px;
    background-color: #007bff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.profile-icon:hover {
    background-color: #0056b3;
}

/* Content area */
.content-area {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 2rem;
    overflow-y: auto;
    gap: 2rem;
}

/* Clock */
#clock {
    font-size: 5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    font-family: 'Courier New', monospace;
    letter-spacing: 0.1em;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

@keyframes blink {
    0%, 45% {
        opacity: 1;
    }
    50%, 95% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Centered button */
.centered-button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 0.75rem;
    padding: 1.5rem 3rem;
    font-size: 1.25rem;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.centered-button:hover {
    background-color: #0056b3;
    box-shadow: 0 12px 30px rgba(0, 123, 255, 0.4);
    transform: translateY(-3px);
    color: white;
}

.centered-button i {
    font-size: 1.5rem;
}

/* Modal Overlay */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background-color: white;
    border-radius: 0.75rem;
    padding: 2.5rem;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    position: relative;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.modal-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.modal-close-btn {
    background: none;
    border: none;
    font-size: 1.75rem;
    color: #6c757d;
    cursor: pointer;
    padding: 0;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.25rem;
    transition: all 0.2s ease;
}

.modal-close-btn:hover {
    background-color: #f0f0f0;
    color: #495057;
}

.modal-body {
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    font-size: 0.95rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.modal-footer {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-modal {
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel {
    background-color: #6c757d;
    color: white;
}

.btn-cancel:hover {
    background-color: #5a6268;
}

.btn-submit {
    background-color: #007bff;
    color: white;
}

.btn-submit:hover {
    background-color: #0056b3;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}
</style>
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <a href="#" class="sidebar-icon active" title="Dashboard">
            <i class="bi bi-house-door"></i>
        </a>
    </aside>

    <div class="main-content">
        <header class="top-bar">
            <div class="brand-title">Brand</div>
            <a href="#" class="profile-icon" title="Perfil">
                <i class="bi bi-person-circle"></i>
            </a>
        </header>

        <main class="content-area">
            <p id="clock"></p>
            <button class="centered-button" id="open-modal-btn">
                <i class="bi bi-plus-circle"></i>
                Clique Aqui
            </button>
        </main>
    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="modal-overlay" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
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
    const modalOverlay = new bootstrap.Modal(document.getElementById('modal-overlay'));

    function show()
    {
        modalOverlay.show();
    }

    function getTime()
    {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const timeString = `${hours}<span style="animation: blink 3s infinite;">:</span>${minutes}`;
        document.getElementById('clock').innerHTML = timeString;
    }

    getTime();
    setInterval(getTime, 1000);
</script>
</body>
</html>