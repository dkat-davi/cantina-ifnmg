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
        $path_to_gerenciar = '../admin';
        $path_to_caixa = '../caixa';
        $path_to_home = '../../index.php';
        $path_to_perfil = '../perfil';
        $path_to_news = '../news';
        $path_to_login = '../login';
        $path_to_products = '';
        $path_to_cardapio = '../cardapio';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <h1 class="title">Produtos</h1>

        <div class="container">
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
                            alt="Image do produto <?=$product->name?>" width="150" height="150">
                    </div>
                    <p id="description">
                        <?=$product->description?>
                    </p>
                    <?php
                        if($product->qtde == 0) {
                            ?>
                    <p style="font-weight: bold; margin-top: 2rem;">
                        PRODUTO ESGOTADO
                    </p>
                    <?php
                        } else {
                    ?>
                    <p id="price">
                        R$<?=$product->price .' - '. $product->unidade?>
                    </p>
                    <?php
                        }
                    ?>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

    </main>
</body>

</html>