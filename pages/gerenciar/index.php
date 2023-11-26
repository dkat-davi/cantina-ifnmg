<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Gerente</title>
</head>

<body>
    <header>
        <?php
            $path_to_logout = '../users/logout.php';
            $path_to_admin = '../admin';
            $path_to_caixa = '../caixa';
            $path_to_home = '../../index.php';
            $path_to_perfil = '../perfil';
            include_once '../../includes/header.inc.php';
        ?>
    </header>

    <h1> Página do Gerente</h1>
    <ul>
        <li><a href="../users/create.php">Criar Usuário</a></li>
        <li><a href="../users/all.php">Listar Usuários</a></li>
        <li><a href="../users/delete.php">Deletar Usuários</a></li>
        <li><a href="../users/update.php">Editar Usuários</a></li>
    </ul>
</body>

</html>