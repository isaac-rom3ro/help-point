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
    padding: 2rem;
}

.table-container {
    background-color: white;
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    width: 900px;
    max-width: 100%;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.table-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
}

.add-button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.6rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.add-button:hover {
    background-color: #0056b3;
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.35);
    transform: translateY(-2px);
    color: white;
}

.custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.custom-table thead th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid #e9ecef;
    font-size: 0.9rem;
}

.custom-table thead th:first-child {
    border-radius: 0.5rem 0 0 0;
}

.custom-table thead th:last-child {
    border-radius: 0 0.5rem 0 0;
}

.custom-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid #f0f0f0;
    color: #495057;
    font-size: 0.95rem;
}

.custom-table tbody tr:last-child td {
    border-bottom: none;
}

.custom-table tbody tr {
    transition: background-color 0.2s ease;
}

.custom-table tbody tr:hover {
    background-color: #f8f9fa;
}

.action-icons {
    display: flex;
    gap: 0.75rem;
}

.action-icon {
    color: #6c757d;
    font-size: 1.3rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.action-icon:hover {
    color: #007bff;
    transform: scale(1.1);
}

.action-icon.delete:hover {
    color: #dc3545;
}

/* Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background-color: white;
    border-radius: 0.75rem;
    padding: 2rem;
    width: 500px;
    max-width: 90%;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    position: relative;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
}

.close-button {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #6c757d;
    cursor: pointer;
    transition: color 0.2s ease;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close-button:hover {
    color: #dc3545;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.help-icon {
    color: #6c757d;
    font-size: 1rem;
    cursor: help;
    position: relative;
}

.help-icon:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}

.tooltip-text {
    visibility: hidden;
    opacity: 0;
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    font-size: 0.85rem;
    font-weight: 400;
    transition: opacity 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.tooltip-text::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border-width: 5px;
    border-style: solid;
    border-color: #2c3e50 transparent transparent transparent;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    font-size: 0.95rem;
    transition: border-color 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.modal-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-submit {
    flex: 1;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
}

.btn-cancel {
    flex: 1;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
}
</style>
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="sidebar-icon active" title="Usuários">
            <i class="bi bi-people"></i>
        </a>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <header class="top-bar">
            <div class="brand-title">Brand</div>
            <a href="#" class="profile-icon" title="Perfil">
                <i class="bi bi-person-circle"></i>
            </a>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Funcionários</h2>
                    <a href="#modal" class="add-button" onclick="event.preventDefault(); document.getElementById('modalOverlay').classList.add('show');">
                        <i class="bi bi-plus-circle"></i>
                        Adicionar Novo Funcionário
                    </a>
                </div>
                
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>João Silva</td>
                            <td>Gerente</td>
                            <td>
                                <div class="action-icons">
                                    <i class="bi bi-eye action-icon" title="Visualizar"></i>
                                    <i class="bi bi-pencil action-icon" title="Editar"></i>
                                    <i class="bi bi-trash action-icon delete" title="Excluir"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Maria Santos</td>
                            <td>Analista</td>
                            <td>
                                <div class="action-icons">
                                    <i class="bi bi-eye action-icon" title="Visualizar"></i>
                                    <i class="bi bi-pencil action-icon" title="Editar"></i>
                                    <i class="bi bi-trash action-icon delete" title="Excluir"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Pedro Costa</td>
                            <td>Desenvolvedor</td>
                            <td>
                                <div class="action-icons">
                                    <i class="bi bi-eye action-icon" title="Visualizar"></i>
                                    <i class="bi bi-pencil action-icon" title="Editar"></i>
                                    <i class="bi bi-trash action-icon delete" title="Excluir"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ana Oliveira</td>
                            <td>Designer</td>
                            <td>
                                <div class="action-icons">
                                    <i class="bi bi-eye action-icon" title="Visualizar"></i>
                                    <i class="bi bi-pencil action-icon" title="Editar"></i>
                                    <i class="bi bi-trash action-icon delete" title="Excluir"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Carlos Ferreira</td>
                            <td>Coordenador</td>
                            <td>
                                <div class="action-icons">
                                    <i class="bi bi-eye action-icon" title="Visualizar"></i>
                                    <i class="bi bi-pencil action-icon" title="Editar"></i>
                                    <i class="bi bi-trash action-icon delete" title="Excluir"></i>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div id="modalOverlay" class="modal-overlay" onclick="if(event.target === this) this.classList.remove('show');">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Adicionar Funcionário</h3>
            <button class="close-button" onclick="document.getElementById('modalOverlay').classList.remove('show');">
                <i class="bi bi-x"></i>
            </button>
        </div>
        
        <form id="form-store-employee">
            <div class="form-group">
                <label class="form-label">Nome</label>
                <input type="text" id="employee-name" class="form-input" placeholder="Digite o nome completo">
            </div>
            
            <div class="form-group">
                <label class="form-label">CPF</label>
                <input type="text" id="employee-cpf"  class="form-input" placeholder="000.000.000-00">
            </div>
            
            <div class="form-group">
                <label class="form-label">Cargo</label>
                <input type="text" id="employee-role" class="form-input" placeholder="Digite o cargo">
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Horas Atribuídas
                    <span class="help-icon">
                        <i class="bi bi-question-circle"></i>
                        <span class="tooltip-text">Carga horária de trabalho mensal</span>
                    </span>
                </label>
                <input type="number" id="employee-assinged-hours"  class="form-input" placeholder="Ex: 160">
            </div>
            
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('modalOverlay').classList.remove('show');">
                    Cancelar
                </button>
                <button type="submit" id="btn-store-employee" class="btn-submit">
                    Adicionar
                </button>
            </div>
        </form>
    </div>

<!-- Jquery Lib -->
<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

<!-- jQuery Mask Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
  $(function () {
    $('#employee-cpf').mask('000.000.000-00');
  });
</script>

<script>
    const form = document.getElementById('form-store-employee');
    
    form.addEventListener('submit', async function(event) {
        event.preventDefault(); 

        const employeeName = document.querySelector('#employee-name').value;
        const employeeCpf = document.querySelector('#employee-cpf').value;
        const employeeRole = document.querySelector('#employee-role').value;
        const employeeAssigned_hours= document.querySelector('#employee-assinged-hours').value;

        const storeEmployeeURL = '/company/dashboard/employee';  

        const response = await fetch(storeEmployeeURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                employeeName: employeeName,
                employeeCpf: employeeCpf,
                employeeRole: employeeRole,
                employeeAssigned_hours: employeeAssigned_hours
            })
        });

        console.log(response);

        // if (response.status === 200) {
        //   location.href = '/company/dashboard';
        // }
    });
</script>
</div>
</body>
</html>