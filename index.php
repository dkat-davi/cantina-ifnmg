<?php
    require_once __DIR__ . '/classes/database.class.php';
    require_once __DIR__ . '/classes/util.class.php';
    DB::Seed();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
        $path_to_login = './pages/login';
        $path_to_logout = './pages/users/logout.php';
        $path_to_perfil = './pages/perfil';
        $path_to_admin = './pages/admin';
        $path_to_gerenciar = './pages/admin';
        $path_to_caixa = './pages/caixa';
        $path_to_news = './pages/news';
        $path_to_home = '#';
        $path_to_products = './pages/products';
        $path_to_logo = './assets/logo.png';
        include_once 'includes/header.inc.php';
    ?>
    <main>
        <?php
            require_once __DIR__ . '.\classes\news.class.php';
            $news = News::GetAll();
        ?>
        <h1 id="title">Restaurante IFNMG</h1>
        <div class="background">
                <div class="news">
                    <?php
                        foreach ($news as $new) {
                            $createdAt = new Datetime($new->createdAt);
                            $updatedAt = new Datetime($new->updatedAt);
                    ?>
                    <div class="wrapper">
                        <div class="new">
                            <div>
                                <img src="./assets/img/news/<?=$new->banner?>" alt="Banner da notícia <?=$new->title?>"
                                    width="200" heigth="100">
                            </div>
                            <div style="width: 100%;">
                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        <p id="date">Publicado: <?=$createdAt->format('d/m/Y H:i:s')?> | Última atualização:
                                            <?=$updatedAt->format('d/m/Y H:i:s')?></p>
                                        <p id="date">Autor:<?=$new->author?></p>
                                    </div>
                                </div>
                                <a href="./pages/news/new.php?id=<?=$new->id?>" id="only-new">
                                    <h1><?=$new->title?></h1>
                                    <p><?=$new->description?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                
                        }
                    ?>
                </div>
            </div>
    </main>

</body>

</html>