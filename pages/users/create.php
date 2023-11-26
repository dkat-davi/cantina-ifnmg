<?php
require_once __DIR__ . '\..\..\classes\user.class.php';
require_once __DIR__ . '\..\..\classes\util.class.php';

if(User::islogado()) {
    Util::SessionStart();
    $role = $_SESSION['user']['role'];
}

if (
    !empty($_POST['name']) &&
    !empty($_POST['email']) &&
    !empty($_POST['password']) &&
    !empty($_POST['birth']) &&
    !empty($_POST['role'])
) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birth = $_POST['birth'];
    $role = $_POST['role'];

    User::Create(
        $name,
        $email,
        $password,
        $birth,
        $role
    );

    header("Location: create.php?success");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
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
            include_once '../../includes/header.inc.php';
        ?>
    </header>
    <main>
        <h1>Criar usuários</h1>
        <form method="post">
            <fieldset>
                <legend>Novo Usuário</legend>

                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required> <br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required> <br>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required> <br>

                <label for="birth">Data de Nascimeto:</label>
                <input type="date" id="birth" name="birth" required> <br>

                <label for="role">Tipo de usuário</label>
                <select name="role" id="role" required>
                    <option value="" disable selected style=" color:gray;">Selecione uma opção</option>
                    <?php
                        if(isset($role)) {
                            if($role === 'admin') {
                                echo "<option value=\"admin\">Administrador</option>";
                                echo "<option value=\"gerente\">Gerente</option>";
                                echo "<option value=\"caixa\">Caixa</option>";
                            } else if($role === 'admin' || $role === 'gerente') {
                                echo "<option value=\"gerente\">Gerente</option>";
                                echo "<option value=\"caixa\">Caixa</option>";
                            }
                        }
                    ?>
                    <option value="cliente">Cliente</option>
                </select>
                <button type="submit">Cadastrar</button>
            </fieldset>
        </form>
        <?php
            echo isset($_GET['success']) ? '<p style="color:green;">Usuário criado com sucesso!</p>' : '';
        ?>
    </main>
</body>

</html>