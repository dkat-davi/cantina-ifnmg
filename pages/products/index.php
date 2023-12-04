<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/products/index.css">
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
        $path_to_products = '';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <h1>Produtos</h1>

        <?php
            require_once __DIR__ . '\..\..\classes\user.class.php';
            require_once __DIR__ . '\..\..\classes\util.class.php';
            if(User::IsLogado()) {
                Util::SessionStart();
                if($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'gerente') {
                    echo '<h2><a href="./create.php">Adicionar produtos</a></h2>';
                }
            }
        ?>

        <div class="products">
            <?php
                require_once __DIR__ . '\..\..\classes\product.class.php';
                $products = Product::GetAll();
                if(empty($products)) {
                    echo 'Não há nenhum produto cadastrado';
                }
                foreach ($products as $product) {
                    ?>

            <div class="card-product">
                <div class="image">
                    <img src="../../assets/img/products/<?=$product->image?>"
                        alt="Image do produto <?=$product->name?>">
                </div>
                <div class="description">
                    <p id="name">
                        <?=$product->name?>
                    </p>
                    <p id="price">
                        R$<?=$product->price?>
                    </p>
                </div>
            </div>

            <?php    
                }
            ?>
        </div>

    </main>
</body>

</html>