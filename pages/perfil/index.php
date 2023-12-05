<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\util.class.php';
    if(User::islogado()) {
        Util::SessionStart();
        $name = $_SESSION['user']['name'];
        $email = $_SESSION['user']['email'];
        $birth = new DateTime($_SESSION['user']['birth']);
        $birth = $birth->format("d/m/Y");
        $role = $_SESSION['user']['role'];

        $words = explode(' ', $name);
        $first_letter = mb_substr($words[0], 0, 1, 'UTF-8');
        $last_letter = mb_substr($words[count($words) - 1], 0, 1, 'UTF-8');
        $sigla = $first_letter . $last_letter;

    } else {
        header("Location: ../login");
        die();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/pbs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpopcy="no-referrer" />
</head>

<body>
    <?php
        $path_to_logout = '../users/logout.php';
        $path_to_admin = '../admin';
        $path_to_gerenciar = '../admin';
        $path_to_caixa = '../caixa';
        $path_to_home = '../../index.php';
        $path_to_news = '../news';
        $path_to_perfil = '';
        $path_to_products = '../products';
        $path_to_cardapio = '../cardapio';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <div class="container">
            <h1>Perfil de Usuário</h1>
            <div class="personal-info">
                <div class="sigla">
                    <h2><?=$sigla?></h2>
                </div>
                <div>
                    <label>Nome:</label>
                    <input type="text" value="<?=$name?>" disabled>
                    <label>Email:</label>
                    <input type="text" value="<?=$email?>" disabled>
                    <a href="../users/logout.php" class="logout">LOGOUT</a>
                </div>
                <div>
                    <label>Data de Nascimento:</label>
                    <input type="text" value="<?=$birth?>" disabled>

                    <label>Tipo de usuário:</label>
                    <input type="text" value="<?= strtoupper($role)?>" disabled>
                </div>
            </div>
        </div>
    </main>
</body>

</html>