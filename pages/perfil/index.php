<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\util.class.php';
    if(User::islogado()) {
        Util::SessionStart();
        $name = $_SESSION['user']['name'];
        $email = $_SESSION['user']['email'];
        $birth = new DateTime($_SESSION['user']['birth']);
        $birth = $birth->format("d/m/Y");
        $role = $_SESSION['user']['role'];

    } else {
        header("Location: ../login");
        die();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <header>
        <?php
            $path_to_logout = '../users/logout.php';
            $path_to_admin = '../admin';
            $path_to_gerenciar = '../gerenciar';
            $path_to_caixa = '../caixa';
            $path_to_home = '../../index.php';
            $path_to_news = '../news';
            include_once '../../includes/header.inc.php';
        ?>
    </header>
    <h1>Perfil</h1>
    <ul>
        <li>Nome: <?=$name?></li>
        <li>Email: <?=$email?></li>
        <li>Data de Nascimento: <?=$birth?></li>
        <li>Tipo de usuário: <?=$role?></li>
    </ul>
</body>

</html>