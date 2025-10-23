<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/company/dashboard/style.css') }}">

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
                        @if (! empty($employees))
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr id="{{ $employee->id }}">
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->role }}</td>
                                        <td>
                                            <div class="action-icons">
                                                <i class="bi bi-eye action-icon" title="Visualizar"></i>
                                                <i class="bi bi-pencil action-icon" title="Editar"></i>
                                                <i class="bi bi-trash action-icon delete" title="Excluir"></i>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
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
                <input type="text" id="name" class="form-input" placeholder="Digite o nome completo">
            </div>

            <div class="form-group">
                <label class="form-label">CPF</label>
                <input type="text" id="cpf" class="form-input" placeholder="000.000.000-00">
            </div>

            <div class="form-group">
                <label class="form-label">Cargo</label>
                <input type="text" id="role" class="form-input" placeholder="Digite o cargo">
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp</label>
                <input type="text" id="whatsapp" class="form-input" placeholder="(00) 00000-0000">
            </div>

            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" id="email" class="form-input" placeholder="exemplo@email.com">
            </div>

            <div class="form-group">
                <label class="form-label">Horas Atribuídas</label>
                <input type="number" id="assigned-hours" class="form-input" placeholder="Ex: 160">
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

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<!-- JS -->
 <script src="{{ asset('js/company/dashboard/FormEmployee.js') }}"></script>

<script>
$(function () {
    formEmployee.setMask();
    formEmployee.store();
});
</script>
</body>
</html>