<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/products/create.css">
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
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <form method="post" enctype="multipart/form-data">
            <h2>Cadastro de produtos</h2>
            <div class="inputs">
                <div style="flex:40%;">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" required placeholder="Nome do produto">

                    <label for="description">Descrição:</label><br>
                    <textarea name="description" id="description" cols="30" rows="10" required maxlength="100"
                        placeholder="Produto do tipo x marca y do tamanha z"></textarea>
                </div>
                <div style="flex:60%;">
                    <label for="price">Preço:</label>
                    <input type="number" name="price" id="price" step="0.01" required placeholder="Preço do produto">

                    <label for="qtde">Unidade:</label>
                    <input type="text" name="unidade" id="qtde" required
                        placeholder="Unidade de venda do produto (Kg, L, unidade)">

                    <label for="qtde">Quantidade:</label>
                    <input type="number" name="qtde" id="qtde" required placeholder="Quantidade em estoque">

                    <label for="image">Selecione a imagem:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
            </div>

            <div class="submit-form">
                <button type="submit" class="submit">Salvar</button>
                <button class="cancel"><a href="./admin.php">Cancelar</a></button>
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
                        Produto registrado com sucesso!
                    </p>';
                }
            ?>
        </form>

        <?php
            if(isset($_POST['name']) && 
                isset($_POST['description']) && 
                isset($_POST['price']) && 
                isset($_POST['unidade']) && 
                isset($_POST['qtde']) && 
                isset($_FILES['image'])) {
                require_once __DIR__ . '\..\..\classes\product.class.php';

                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $unidade = $_POST['unidade'];
                $qtde = $_POST['qtde'];
                $image = Product::UploadImage();
                
                Product::Create(
                    $name,
                    $description,
                    $price,
                    $unidade,
                    $qtde,
                    $image
                );

                header("Location: ?success");
            }
        ?>
    </main>
</body>

</html>