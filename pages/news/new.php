<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/news/new.css">
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
        $path_to_logo = '../../assets/logo.png';
        include_once '../../includes/header.inc.php';
        require_once __DIR__ . '\..\..\classes\news.class.php';
        require_once __DIR__ . '\..\..\classes\user.class.php';
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $new = News::GetById($id);
            $createdAt = new Datetime($new->createdAt);
            $updatedAt = new Datetime($new->updatedAt);
        } else {
            header("Location: index.php");
            die();
        }
    ?>
    <main>

        <div class="container">
            <div class="news">
                <div class="new">
                    <?=$new->content?>
                    <p id="date">Publicado: <?=$createdAt->format('d/m/Y H:i:s')?> | Última atualização:
                        <?=$updatedAt->format('d/m/Y H:i:s')?></p>
                    <p id="date">Autor:<?=$new->author?></p>
                </div>
            </div>
        </div>

    </main>
</body>

</html>