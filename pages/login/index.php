<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';

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
</head>

<body>
    <header>
        <?php
            $path_to_logout = '../users/logout.php';
            $path_to_perfil = '../perfil';
            $path_to_admin = '../admin';
            $path_to_gerenciar = '../gerenciar';
            $path_to_caixa = '../caixa';
            $path_to_home = '../../index.php';
            include_once '../../includes/header.inc.php';
        ?>
    </header>
    <form method="post">
        <label>Email:</label>
        <input type="text" name="email" id="email"><br>

        <label>Senha:</label>
        <input type="password" name="password" id="password"><br>

        <input type="submit" value="Login"><br>

        <a href="../users/create.php">Cadastre-se</a>
    </form>
    <?php
        if(isset($_GET['unauthorized'])) {
            echo "<p style=\"color:red;\">Email e/ou senha incorretos! Tente novamente.</p>";
        }
    ?>
</body>

</html>