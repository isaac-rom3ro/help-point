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

/* Modal Customization */
#modal-overlay .modal-content {
    background-color: #007bff;
    border-radius: 0.75rem;
    border: none;
}

#modal-overlay .modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
}

#modal-overlay .modal-title {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
}

#modal-overlay .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

#modal-overlay .btn-close:hover {
    opacity: 1;
}

#modal-overlay .modal-body {
    padding: 1.5rem;
}

#modal-overlay .modal-body label {
    color: white;
    font-weight: 500;
    margin-bottom: 0.75rem;
    display: block;
}

#modal-overlay .modal-body select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 0.5rem;
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 1rem;
}

#modal-overlay .modal-body select option {
    background-color: #0056b3;
    color: white;
}

#modal-overlay .modal-footer {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
    justify-content: flex-end;
    gap: 0.75rem;
}

.btn-modal-cancel {
    background-color: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 0.65rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-modal-cancel:hover {
    background-color: rgba(255, 255, 255, 0.3);
}

.btn-modal-submit {
    background-color: white;
    color: #007bff;
    border: none;
    padding: 0.65rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-modal-submit:hover {
    background-color: #f8f9fa;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
<div class="modal fade" id="modal-overlay" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="register-select">O que você deseja registrar?</label>
                <select name="register-select" id="slt-log-type">
                    <option value="time-in">Chegada</option>
                    <option value="lunch-in">Pausa para Almoço</option>
                    <option value="lunch-out">De Volta do Almoço</option>
                    <option value="time-out">Encerrando o Expediente</option>
                    <option value="other">Outro Tipo de Registro</option>
                </select>
                
                <input id="ipt-other-purpose" hidden type="text" placeholder="Motivo...">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btn-register-new-log" class="btn-modal-submit">Registrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    const purposeInput = document.getElementById('ipt-other-purpose');
    const selectTimeOption = document.getElementById('slt-log-type');

    if (purposeInput.hasAttribute('hidden') && selectTimeOption.value === 'other')
    {
            purposeInput.removeAttribute('hidden');    
            purposeInput.value = '';
    }

    const modalOverlay = new bootstrap.Modal(document.getElementById('modal-overlay'));

    const registerNewLogModal = document.getElementById('open-modal-btn');
    registerNewLogModal.addEventListener('click', function () {
        modalOverlay.show();
    });

    function convertJsDateToMysqlDatetime(jsDate) {
        const timePart = jsDate.slice(12, 20); // "HH:MM:SS"

        // Combine them with a space in between
        return `${timePart}`;
    }


    const btnRegisterNewLog = document.getElementById("btn-register-new-log").addEventListener('click', async function () {
        const logType = document.getElementById('slt-log-type').value;
        const otherPurpose = purposeInput.hasAttribute('hidden') ? '' :  purposeInput.value;
        const time = convertJsDateToMysqlDatetime(
            new Date().toLocaleString("pt-BR", { timeZone: "America/Sao_Paulo" })
        );

        const sendOnlyLogType = JSON.stringify({
            time: time,
            logType: logType
        });

        const sendOtherType = JSON.stringify({
            time: time,
            logType: logType,
            otherPurpose: otherPurpose
        });

        const body = otherPurpose !== '' ? sendOtherType : sendOnlyLogType;

        const timeRegisterURL = '/employee/dashboard/time-log';

        const response = await fetch(timeRegisterURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: body
        });

        console.log(response.status);
    });

    selectTimeOption.addEventListener('change', function(event) {
        const type = event.target.value;

        if (type === 'other') {
            purposeInput.removeAttribute('hidden');
        } else {
            purposeInput.value = '';
            purposeInput.setAttribute('hidden', true);
        }
    });

    function getTime() {
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