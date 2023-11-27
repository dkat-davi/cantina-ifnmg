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
    <main>
        <h1>Bem-Vindo</h1>
        <p>Insira seus dados para acessar o sistema</p>
        <form method="post">
            <label>Email:</label>
            <input type="text" name="email" id="email">
            <label>Senha:</label>
            <input type="password" name="password" id="password">
            <button type="submit">Acessar</button>
            <a href="../users/create.php">Cadastre-se</a>
            <?php
                if(isset($_GET['unauthorized'])) {
                    echo "<p style=\"color:red;\">Email e/ou senha incorretos! Tente novamente.</p>";
                }
            ?>
        </form>

    </main>
</body>

</html>