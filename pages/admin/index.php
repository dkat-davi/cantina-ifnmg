<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Admin</title>
</head>

<body>
    <header>
        <?php
            $path_to_logout = '../users/logout.php';
            $path_to_gerenciar = '../gerenciar';
            $path_to_caixa = '../caixa';
            $path_to_home = '../../index.php';
            $path_to_perfil = '../perfil';
            include_once '../../includes/header.inc.php';
        ?>
    </header>
    <h1> Página do Admin</h1>
    <h2><a href="../users/">Administrar Usuários</a></h2>
    <h2><a href="#">Administrar Produtos</a></h2>
    <h2><a href="#">Administrar Notícias</a></h2>
</body>

</html>