<?php
require_once '../../classes/user.class.php';

if (
    !empty($_GET['name']) &&
    !empty($_GET['email']) &&
    !empty($_GET['password']) &&
    !empty($_GET['birth']) &&
    !empty($_GET['role'])
) {
    $name = $_GET['name'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $birth = $_GET['birth'];
    $role = $_GET['role'];

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

    <main>
        <form method="get">
            <fieldset>
                <legend>Novo Usuário</legend>

                <label for="name">Nome:</label>
                <input type="text" id="name" name="name"> <br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email"> <br>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password"> <br>

                <label for="birth">Data de Nascimeto:</label>
                <input type="date" id="birth" name="birth"> <br>

                <label for="role">Tipo de usuário</label>
                <select name="role" id="role">
                    <option value="admin">Administrador</option>
                    <option value="caixa">Caixa</option>
                    <option value="cliente">Cliente</option>
                    <option value="gerente">Gerente</option>
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