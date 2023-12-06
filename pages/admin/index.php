<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
        $path_to_logout = '../users/logout.php';
        $path_to_gerenciar = '../admin';
        $path_to_caixa = '../caixa';
        $path_to_home = '../../index.php';
        $path_to_perfil = '../perfil';
        $path_to_news = '../news';
        $path_to_admin = '';
        $path_to_products = '../products';
        $path_to_cardapio = '../cardapio';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <div class="container">
            <h1 class="title"> Gerenciamento</h1>

            <div class="cards">
                <a href="../users/" class="card users">
                    <div>
                        <p>Usuários</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-users"></i>
                    </div>
                </a>

                <a href="../products/admin.php" class="card products">
                    <div>
                        <p>Produtos</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                </a>

                <a href="../news" class="card news">
                    <div>
                        <p>Notícias</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                </a>

                <a href="../caixa" class="card cardapio">
                    <div>
                        <p>Caixa</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </a>
            </div>
        </div>
    </main>
</body>

</html>