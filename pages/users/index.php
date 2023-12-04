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
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/users/index.css">
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
        $path_to_perfil = '../perfil';
        $path_to_news = '../news';
        $path_to_login = '../login';
        $path_to_products = '../products';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <?php
            $users = User::GetAll();
        ?>

        <h1 class="title">Gerenciamento de Usuários</h1>

        <div class="cards">
            <a href="./create.php" class="card add-users">
                <div>
                    <h1><?=count($users)?></h1>
                    <p>Adicionar Usuários</p>
                </div>
                <div>
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </a>

            <a href="./create.php" class="card debit">
                <div>
                    <p>Verificar débitos</p>
                </div>
                <div>
                    <i class="fa-solid fa-credit-card"></i>
                </div>
            </a>
        </div>


        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nasc.</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>



                <?php
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
                    <td>
                        <?php
                        if($user->active) {
                        ?>
                        <a href="./active.php?id=<?=$user->id?>" class="unactive">Desativar</a>
                        <?php
                        } else {  
                        ?>
                        <a href="./active.php?id=<?=$user->id?>" class="active">Ativar</a>
                        <?php
                        }
                        ?>
                    </td>
                    <td><a href="./update.php?id=<?=$user->id?>" class="edit">Editar</a></td>
                    <td><a href="./delete.php?id=<?=$user->id?>" class="delete">Excluir</a></td>
                </tr>
                <?php
                    }
                ?>

            </tbody>
        </table>

    </main>
</body>

</html>