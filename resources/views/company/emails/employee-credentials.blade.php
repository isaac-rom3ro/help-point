<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Credentials</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/company/emails/employee-credentials/style.css') }}">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Bem-vindo à Equipe!</h1>
            <p>Suas credenciais de acesso</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="welcome-text">
                Olá, {{ $employeeName }}<br><br>
                Sua conta de funcionário foi criada. Abaixo estão suas credenciais de login para acessar o sistema.
            </p>

            <div class="credentials-box">
                <div class="credential-item">
                    <div class="credential-label">CPF</div>
                    <div class="credential-value">{{ $employeeCpf }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">Senha</div>
                    <div class="credential-value">{{ $employeePassword }}</div>
                </div>
            </div>

            <div class="instructions">
                <strong>Próximos Passos:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Use essas credenciais para fazer login no sistema</li>
                    <li>Você será solicitado a alterar sua senha no primeiro acesso</li>
                    <li>Mantenha essas informações seguras e confidenciais</li>
                </ul>
            </div>

            <div class="warning">
                <strong>⚠️ Importante:</strong> Por motivos de segurança, altere sua senha imediatamente após o primeiro login.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Help Point. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>
