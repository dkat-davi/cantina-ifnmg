<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="../../styles/global.css">
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
        $path_to_products = './index.php';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <h2>Cadastro de produtos</h2><br>

        <form method="post" enctype="multipart/form-data">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" required>

            <label for="price">Preço:</label>
            <input type="number" name="price" id="price" step="0.01" required>

            <label for="qtde">Quantidade:</label>
            <input type="number" name="qtde" id="qtde" required>

            <label for="image">Selecione a imagem</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Salvar</button>
        </form>

        <?php
            if(isset($_POST['name']) && 
                isset($_POST['price']) && 
                isset($_POST['qtde']) && 
                isset($_FILES['image'])) {
                require_once __DIR__ . '\..\..\classes\product.class.php';

                $name = $_POST['name'];
                $price = $_POST['price'];
                $qtde = $_POST['qtde'];
                $image = Product::UploadImage();
                
                Product::Create(
                    $name,
                    $price,
                    $qtde,
                    $image
                );
            }
        ?>
    </main>
</body>

</html>