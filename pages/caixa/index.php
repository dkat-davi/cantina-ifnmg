<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente', 'caixa']);
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <?php
            $path_to_logout = '../users/logout.php';
            $path_to_admin = '../admin';
            $path_to_gerenciar = '../gerenciar';
            $path_to_home = '../../index.php';
            $path_to_perfil = '../perfil';
            $path_to_news = '../news';
            include_once '../../includes/header.inc.php';
        ?>
    </header>
    <main>
        <h1>Caixa Registradora<h1>
    </main>
</body>

</html>