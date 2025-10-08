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
    padding: 2rem;
    overflow-y: auto;
}

.table-container {
    background-color: white;
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 1100px;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
    flex-wrap: wrap;
    gap: 1rem;
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

.table-wrapper {
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    min-width: 700px;
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

.custom-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid #f0f0f0;
    color: #495057;
    font-size: 0.95rem;
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
    overflow-y: auto;
    padding: 1rem;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background-color: white;
    border-radius: 0.75rem;
    padding: 2rem;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    position: relative;
    margin: auto;
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

.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    font-size: 0.95rem;
    box-sizing: border-box;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-submit, .btn-cancel {
    flex: 1;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem;
    font-size: 1rem;
    font-weight: 500;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-submit {
    background-color: #007bff;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.btn-cancel {
    background-color: #6c757d;
}

.btn-cancel:hover {
    background-color: #5a6268;
}
</style>
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <a href="#" class="sidebar-icon active" title="Usuários">
            <i class="bi bi-people"></i>
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
            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Funcionários</h2>
                    <a href="#modal" class="add-button" onclick="event.preventDefault(); document.getElementById('modalOverlay').classList.add('show');">
                        <i class="bi bi-plus-circle"></i>
                        Adicionar Novo Funcionário
                    </a>
                </div>
                
                <div class="table-wrapper">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>WhatsApp</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>João Silva</td>
                                <td>Gerente</td>
                                <td>(11) 99999-9999</td>
                                <td>joao@email.com</td>
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
            </div>
        </main>
    </div>
</div>

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
                <input type="text" id="employee-cpf" class="form-input" placeholder="000.000.000-00">
            </div>

            <div class="form-group">
                <label class="form-label">Cargo</label>
                <input type="text" id="employee-role" class="form-input" placeholder="Digite o cargo">
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp</label>
                <input type="text" id="employee-whatsapp" class="form-input" placeholder="(00) 00000-0000">
            </div>

            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" id="employee-email" class="form-input" placeholder="exemplo@email.com">
            </div>

            <div class="form-group">
                <label class="form-label">Horas Atribuídas</label>
                <input type="number" id="employee-assigned-hours" class="form-input" placeholder="Ex: 160">
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
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
$(function () {
    $('#employee-cpf').mask('000.000.000-00');
    $('#employee-whatsapp').mask('(00) 00000-0000');
});
</script>

<script>
const form = document.getElementById('form-store-employee');

form.addEventListener('submit', async function(event) {
    event.preventDefault(); 

    const employeeName = document.querySelector('#employee-name').value;
    const employeeCpf = document.querySelector('#employee-cpf').value;
    const employeeRole = document.querySelector('#employee-role').value;
    const employeeAssignedHours = document.querySelector('#employee-assigned-hours').value;
    const employeeWhatsapp = document.querySelector('#employee-whatsapp').value;
    const employeeEmail = document.querySelector('#employee-email').value;

    const storeEmployeeURL = '/company/dashboard/employee';  

    const response = await fetch(storeEmployeeURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            employeeName,
            employeeCpf,
            employeeRole,
            employeeAssignedHours,
            employeeWhatsapp,
            employeeEmail
        })
    });

    console.log(response);
});
</script>
</body>
</html>