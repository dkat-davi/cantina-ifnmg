<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência de usuários</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    </style>
</head>

<body>
    <header>
        <?php
            $path_to_logout = '../users/logout.php';
            $path_to_admin = '../admin';
            $path_to_gerenciar = '../gerenciar';
            $path_to_caixa = '../caixa';
            $path_to_home = '../../index.php';
            $path_to_perfil = '../perfil';
            $path_to_news = '../news';
            include_once '../../includes/header.inc.php';
        ?>
    </header>
    <main>
        <h1>Gerência de Usuários</h1>

        <ul>
            <li><a href="./create.php">Criar novos usuários</a></li>
        </ul>

        <table>
            <caption>Usuários</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nasc.</th>
                    <th>Tipo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>



                <?php
                    $users = User::GetAll();
                    foreach ($users as $user) {
                        $birth = new DateTime($user->birth);
                        $birth = $birth->format('d/m/Y');
                ?>
                <tr>
                    <td><?=$user->id?></td>
                    <td><?=$user->name?></td>
                    <td><?=$user->email?></td>
                    <td><?=$birth?></td>
                    <td><?=strtoupper($user->role)?></td>
                    <td><a href="./update.php?id=<?=$user->id?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="./delete.php?id=<?=$user->id?>"><i class="fa-solid fa-trash"></i></i></a></td>
                </tr>
                <?php
                    }
                ?>

            </tbody>
        </table>

    </main>
</body>

</html>