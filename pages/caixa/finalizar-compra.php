<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\compra.class.php';
    User::AllowAccess(['admin', 'gerente', 'caixa']);
    if(isset($_POST['products']) && isset($_POST['qtde'])) {
        $products = $_POST['products'];
        foreach ($products as $productId) {
            $qtde = $_POST['qtde'][$productId];
            Compra::addProduct($productId, $qtde);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Registradora</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/caixa/finalizar-compra.css">
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
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <div class="container">
            <h1 class="title">Finalizar Compra</h1>
            <div class="submit-form">
                <!-- <button type="submit">Continuar venda</button> -->
                <a href="./add-product.php" style="background-color: rgb(255, 187, 0); color: rgb(43, 29, 0);">Adicionar Produtos</a>
                <a href="./cancelar.php">Cancelar venda</a>
            </div>
            <div class="wrapper">
                <div class="cliente">
                    <?php 
                        if(isset($_GET['carteira'])) {
                            echo "<a href=\"?\" class=\"a-vista\">Comprar a vista</a>";
                        } else {
                            echo "<a href=\"?carteira\" class=\"a-prazo\">Comprar a prazo</a>";
                        }
                    ?>

                    <div>

                    </div>
                </div>
                <div class="table">
                    <table>
                        <caption>Lista de compra</caption>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
                        $products = Compra::getAllProducts();
                        if(count($products) === 0) {
                            header("Location: add-product.php");
                        }
                        if(is_array($products)) {
                            foreach ($products as $product) {
    ?>
                                <tr>
                                    <td><?=$product['product']->code?></td>
                                    <td><?=$product['product']->description?></td>
                                    <td><?=$product['product']->price?></td>
                                    <td><?=$product['qtde']?></td>
                                    <td>
                                        <a href="./remove-product.php?id=<?=$product['product']->id?>" class="delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
    <?php
                            }
                        }
    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>