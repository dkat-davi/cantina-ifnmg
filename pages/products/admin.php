<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/products/admin.css">
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
        $path_to_products = './index.php';
        $path_to_cardapio = '../cardapio';
        include_once '../../includes/header.inc.php';
    ?>
    <main>

        <?php
            require_once __DIR__ . '\..\..\classes\product.class.php';
            $products = Product::GetAll();
        ?>

        <h1 class="title">Produtos</h1>

        <div class="container">
            <div class="cards">
                <a href="./create.php" class="card add-products">
                    <div>
                        <h1>
                            <?=count($products)?>
                        </h1>
                        <p>Adicionar Produtos</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-cart-plus"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço ( R$ )</th>
                        <th>Código</th>
                        <th>Qtde</th>
                        <th>Descrição</th>
                        <th>Imagem</th>
                        <th>Unidade</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($products as $product) {
                    ?>
                    <tr>
                        <td><?=$product->id?></td>
                        <td><?=$product->name?></td>
                        <td><?=$product->price?></td>
                        <td><?=$product->code?></td>
                        <td><?=$product->qtde?></td>
                        <td><?=$product->description?></td>
                        <td><img src="../../assets/img/products/<?=$product->image?>" alt="Imagem do <?$product->name?>"
                                width="50" height="50">
                        </td>
                        <td><?=$product->unidade?></td>
                        <td><a href="./delete.php?id=<?=$product->id?>&image=<?=$product->image?>"
                                class="delete">Excluir</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </main>
</body>

</html>