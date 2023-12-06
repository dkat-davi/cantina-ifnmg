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
    <link rel="stylesheet" href="../../styles/users/carteira.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
        $path_to_logout = '../users/logout.php';
        $path_to_admin = '../admin';
        $path_to_gerenciar = '../admin';
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

        <h1 class="title">Gerenciamento de Carteira de Usuários</h1>

        <form method="post" class="search">
            <label for="name">Pesquisar usuário:</label><br>
            <input type="search" id="name" name="name" placeholder="Nome do usuário">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <?php
            if(isset($_POST['name'])) {
                $name = $_POST['name'];
                $users = User::GetUserByName($name);
            }
        ?>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Carteira</th>
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
                        <td><?=strtoupper($user->role)?></td>
                        <td>
                            <?php
                            if($user->carteira) {
                            ?>
                            <a href="./active-carteira.php?id=<?=$user->id?>" class="unactive">Desativar</a>
                            <?php
                            } else {
                            ?>
                            <a href="./active-carteira.php?id=<?=$user->id?>" class="active">Ativar</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td><a href="../caixa/historico.php?id=<?=$user->id?>" class="edit">Débitos</a></td>
                    </tr>
                    <?php
                            }
                        ?>
                </tbody>
            </table>
        </div>

    </main>
</body>

</html>