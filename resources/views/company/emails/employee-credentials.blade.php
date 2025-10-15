<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Credentials</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #2c5282 0%, #3182ce 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .welcome-text {
            color: #2d3748;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .credentials-box {
            background: #edf2f7;
            border-left: 4px solid #3182ce;
            padding: 25px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .credential-item {
            margin-bottom: 20px;
        }

        .credential-item:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            color: #4a5568;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .credential-value {
            color: #1a202c;
            font-size: 1.2rem;
            font-weight: 600;
            font-family: monospace;
            background: #ffffff;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #cbd5e0;
        }

        .instructions {
            color: #4a5568;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .warning {
            background: #bee3f8;
            border-left: 4px solid #2b6cb0;
            padding: 15px;
            border-radius: 4px;
            color: #2c5282;
            font-size: 0.9rem;
        }

        .footer {
            background: #f7fafc;
            padding: 20px 30px;
            text-align: center;
            color: #718096;
            font-size: 0.85rem;
            border-top: 1px solid #e2e8f0;
        }
    </style>
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
