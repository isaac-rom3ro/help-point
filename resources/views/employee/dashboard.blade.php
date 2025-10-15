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
            <button class="centered-button" onclick="alert('Button clicked!')">
                <i class="bi bi-plus-circle"></i>
                Clique Aqui
            </button>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</body>
</html>