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
    $active = isset($_POST['active']);

    User::Create(
        $name,
        $email,
        $password,
        $birth,
        $role,
        $active
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
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/users/create.css">
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
        $path_to_cardapio = '../cardapio';
        include_once '../../includes/header.inc.php';
    ?>

    <main>
        <form method="post">
            <div>
                <?php
                    if(User::IsLogado()) {
                        echo "<h1>Criar usuários</h1>";
                    } else {
                        echo "<h1>Cadastre-se</h1>";
                    }
                ?>


            </div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required placeholder="Insira seu nome">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required placeholder="Insira seu email">

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required placeholder="Insira seu senha">

            <label for="birth">Data de Nascimeto:</label>
            <input type="date" id="birth" name="birth" required placeholder="Insira sua data de nascimento">


            <label for="role">Tipo de usuário:</label>
            <select name="role" id="role" required placeholder="Selecione o tipo de usuário">
                <option value="" disable selected style=" color:gray;">Selecione uma opção</option>
                <?php
                        if(isset($role)) {
                            if($role === 'admin') {
                                echo "<option value=\"admin\">Administrador</option>";
                                echo "<option value=\"gerente\">Gerente</option>";
                                echo "<option value=\"caixa\">Caixa</option>";
                            } else if($role === 'gerente') {
                                echo "<option value=\"caixa\">Caixa</option>";
                            }
                        }
                    ?>
                <option value="cliente">Cliente</option>
            </select>

            <?php
                    if(isset($role)) {
                        if($role === 'admin' || $role === 'gerente') {
                        ?>
            <div id="active-user">
                <label for="active">Ativar usuário:</label>
                <input type="checkbox" id="active" name="active">
            </div>
            <?php
                        }
                    }
            ?>

            <div class="submit-form">
                <button type="submit" class="submit">Salvar</button>
                <button class="cancel"><a href="./index.php">Cancelar</a></button>
            </div>

            <?php
                if(isset($_GET['success'])) {
                    echo 
                    '<p 
                        style="
                            color:darkgreen; 
                            width: 100%; 
                            text-align:center;
                            padding: 1rem;
                            background-color: #70b38688;
                            border-radius: 5px;
                        ">
                        Usuário criado com successo!
                    </p>';
                    if(User::IsLogado()) {
                        if($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'gerente') {
                            header("Refresh: 3; URL= ./index.php");    
                        } else {
                            header("Refresh: 3; URL= ../login");
                        }
                        
                    } else {
                        header("Refresh: 3; URL= ../login");
                    }
                }
            ?>
        </form>
    </main>
</body>

</html>