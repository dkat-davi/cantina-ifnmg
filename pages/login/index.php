<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';

    if(User::isLogado()) {
        header("Location: ../perfil");
    }

    if(isset($_POST['email']) && isset($_POST['password'])) {
        User::Login($_POST['email'], $_POST['password']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/login.css">
</head>

<body>
    <header>
        <h1><a href="../../index.php">LOGO</a></h1>
    </header>
    <main>
        <form method="post">
            <div>
                <h1>Bem-Vindo</h1>
                <p>Insira seus dados para acessar o sistema</p>
            </div>

            <input type="text" name="email" id="email" placeholder="Email " aria-label="email" required>

            <input type="password" name="password" id="password" placeholder="Senha " aria-label="senha" required>

            <button type="submit">Acessar</button>
            <p id="create-account">Não tem conta? <a href="../users/create.php">Cadastre-se</a></p>
            <?php
                if(isset($_GET['unauthorized'])) {
                    echo "<p style=\"color:red;\">Email e/ou senha incorretos! Tente novamente.</p>";
                }
            ?>
            <?php
                if(isset($_GET['unactive'])) {
                    echo "<p style=\"color:red;\">Infelizmente seu usuário ainda não está ativo, por favor entre em contato com a gestão.</p>";
                }
            ?>
        </form>

    </main>
</body>

</html>