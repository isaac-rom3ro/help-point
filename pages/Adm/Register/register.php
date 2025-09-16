<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Company Register Page</h1>

    <form id="form-register">
        <input id="input-name" type="text" placeholder="Your Name">
        <input id="input-cnpj" type="text" placeholder="CNPJ">
        <input id="input-password" type="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>

    <p id="p-error"></p>

    <p>Already have an account? <a href="http://localhost:8000/adm/login">Go to Login Page</a></p>
<script src="/pages/Adm/Register/script/register-new-company.js"></script>
</body>
</html>