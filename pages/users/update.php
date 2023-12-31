<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuários</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/users/update.css">
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
        $path_to_products = '../products';
        $path_to_logo = '../../assets/logo.png';
        include_once '../../includes/header.inc.php';

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = User::GetById($id);
        } else {
            header("Location: index.php");
            die();
        }
    ?>
    <main>
        <form method="post">
            <div class="title">
                <h1>Editar Usuário</h1>
            </div>

            <input type="hidden" name="id" value="<?=$user->id?>">

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?=$user->name?>" required> <br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?=$user->email?>" required> <br>

            <label for=" password">Senha:</label>
            <input type="password" id="password" name="password" required> <br>

            <label for="birth">Data de Nascimeto:</label>
            <input type="date" id="birth" name="birth" value="<?=$user->birth?>" required> <br>

            <label for="role">Tipo de usuário</label>
            <select name="role" id="role" required>
                <option value="" disable style=" color:gray;">Selecione uma opção</option>
                <option value="admin" <?= $user->role === 'admin' ? 'selected' : ''?>>Administrador</option>
                <option value="gerente" <?= $user->role === 'gerente' ? 'selected' : ''?>>Gerente</option>
                <option value="caixa" <?= $user->role === 'caixa' ? 'selected' : ''?>>Caixa</option>
                <option value="cliente" <?= $user->role === 'cliente' ? 'selected' : ''?>>Cliente</option>
            </select>

            <div id="active-user">
                <label for="active">Ativar usuário:</label>
                <input type="checkbox" id="active" name="active" <?=$user->active ? 'checked' : ''?>>
            </div>

            <div class="submit-form">
                <button type="submit" class="submit">Salvar</button>
                <button class="cancel"><a href="./index.php">Cancelar</a></button>
            </div>
        </form>
        <?php
            if (
                !empty($_POST['id']) &&
                !empty($_POST['name']) &&
                !empty($_POST['email']) &&
                !empty($_POST['password']) &&
                !empty($_POST['birth']) &&
                !empty($_POST['role'])
            ) {

                
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $birth = $_POST['birth'];
                $role = $_POST['role'];
                $active = isset($_POST['active']);
            
                User::Update(
                    $id,
                    $name,
                    $email,
                    $password,
                    $birth,
                    $role,
                    $active
                );
            
                header("Location: index.php");
            }
            
            echo isset($_GET['success']) ? '<p style="color:green;">Usuário criado com sucesso!</p>' : '';
        ?>
    </main>
</body>

</html>