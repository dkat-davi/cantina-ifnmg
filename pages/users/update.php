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

            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $user = User::GetById($id);
            } else {
                header("Location: index.php");
                die();
            }
        ?>
    </header>
    <main>
        <h1>Editar Usuário</h1>
        <form method="post">
            <fieldset>
                <legend>Editar Usuário</legend>

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
                <button type="submit">Cadastrar</button>
            </fieldset>
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
            
                User::Update(
                    $id,
                    $name,
                    $email,
                    $password,
                    $birth,
                    $role
                );
            
                header("Location: index.php");
            }
            
            echo isset($_GET['success']) ? '<p style="color:green;">Usuário criado com sucesso!</p>' : '';
        ?>
    </main>
</body>

</html>