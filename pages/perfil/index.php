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
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
            $path_to_logout = '../users/logout.php';
            $path_to_admin = '../admin';
            $path_to_gerenciar = '../gerenciar';
            $path_to_caixa = '../caixa';
            $path_to_home = '../../index.php';
            $path_to_news = '../news';
            $path_to_perfil = '';
            $path_to_products = '../products';
            include_once '../../includes/header.inc.php';
        ?>
    <h1>Perfil</h1>
    <ul>
        <li>Nome: <?=$name?></li>
        <li>Email: <?=$email?></li>
        <li>Data de Nascimento: <?=$birth?></li>
        <li>Tipo de usuário: <?=$role?></li>
    </ul>

    <a href="../users/logout.php">LOGOUT</a>
</body>

</html>