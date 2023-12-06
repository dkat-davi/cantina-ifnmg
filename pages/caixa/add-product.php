<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\compra.class.php';
    User::AllowAccess(['admin', 'gerente', 'caixa']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Registradora</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/caixa/add-product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
        $path_to_logout = '../users/logout.php';
        $path_to_admin = '../admin';
        $path_to_gerenciar = '../admin';
        $path_to_home = '../../index.php';
        $path_to_perfil = '../perfil';
        $path_to_news = '../news';
        $path_to_caixa = './';
        $path_to_products = '../products';
        $path_to_logo = '../../assets/logo.png';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <div class="container">
            <h1 class="title">Adicionar Produtos</h1>
            <div class="wrapper">
                <form action="finalizar-compra.php" method="post" class="products">
                    <div class="submit-form">
                        <button type="submit">Continuar venda</button>
                        <a href="./cancelar.php">Cancelar venda</a>
                    </div>
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

                                <p id="description"><?=$product->description?></p>
                                
                        <?php
                                if($product->qtde == 0) {
                        ?>
                                <p style="font-weight: bold; margin-top: 2rem;">PRODUTO ESGOTADO</p>
                        <?php
                                } else {
                        ?>
                                <p id="price">R$<?=$product->price .' - '. $product->unidade?></p>
                        <?php
                                    }
                        ?>
                                <div  class="add-product">
                                    <label for="products">Adicionar</label>
                                    <input
                                        type="checkbox"
                                        name="products[]"
                                        value="<?=$product->id?>"
                                        id="products"
                                    >
                                </div>
                                <div class="add-product qtde">
                                    <label for="qtde_<?= $product['id']; ?>">Quantidade</label>
                                    <input
                                        type="number"
                                        name="qtde[<?=$product->id?>]"
                                        id="qtde_<?= $product['id']; ?>"
                                        min="1"
                                    >
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                </form>
            </div>
        </div>
    </main>
</body>
</html>