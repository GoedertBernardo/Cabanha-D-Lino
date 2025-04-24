<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('users.json');
    $users = json_decode($json, true);

    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user'] = $username;
            header('Location: dashboard.php');
            exit;
        }
    }

    $error = "Usuário ou senha incorretos.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <main class="container">
        <form method="POST" action="">
            <h1>Login</h1>

            <div class="input-box">
                <input name="username" placeholder="Usuário" type="text" required>
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="input-box">
                <input name="password" placeholder="Senha" type="password" required>
                <i class="bi bi-lock-fill"></i>
            </div>
            <div class="remenber-forgot">
                <label>
                    <input type="checkbox" name="lembrar">
                    Lembrar senha
                </label>
                <a href="#">Esqueci a senha</a>
            </div>
            <button type="submit" class="login">Login</button>

            <div class="register-link">
                <p>Não tem uma conta? <a href="#">Cadastre-se</a> </p>
            </div>
        </form>
    </main>
    <div class="logo">
        <img src="images/logos/logomg.png" alt="">
    </div>
</body>

</html>