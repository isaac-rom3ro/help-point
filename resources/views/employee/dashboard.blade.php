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
<link rel="stylesheet" href="{{ asset('css/employee/dashboard/style.css') }}">
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