<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/news/index.css">
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
        $path_to_cardapio = '../cardapio';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <?php
            require_once __DIR__ . '\..\..\classes\news.class.php';
            require_once __DIR__ . '\..\..\classes\user.class.php';
            $news = News::GetAll();
            if(User::IsLogado() && 
                (in_array($_SESSION['user']['role'], ['admin', 'gerente']))
            ) {
                $allowed = TRUE;
            }
        ?>


        <div class="container">
            <h1 class="title">Notícias</h1>
            <?php
        if(isset($allowed)) {
        ?>
            <div class="cards">
                <a href="./create.php" class="card add-news">
                    <div>
                        <h1>
                            <?=count($news)?>
                        </h1>
                        <p>Adicionar Notícias</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                </a>
            </div>
            <?php  
        }
        ?>
        </div>


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
                            <img src="../../assets/img/news/<?=$new->banner?>" alt="Banner da notícia <?=$new->title?>"
                                width="200" heigth="100">
                        </div>
                        <div style="width: 100%;">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <p id="date">Publicado: <?=$createdAt->format('d/m/Y H:i:s')?> | Última atualização:
                                        <?=$updatedAt->format('d/m/Y H:i:s')?></p>
                                    <p id="date">Autor:<?=$new->author?></p>
                                </div>
                                <?php
                                    if(isset($allowed)) {
                                    ?>
                                <div class="options">
                                    <a href="./update.php?id=<?=$new->id?>" class="edit">Atualizar</a>
                                    <a href="./delete.php?id=<?=$new->id?>&banner=<?=$new->banner?>"
                                        class="delete">Excluir</a>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <a href="./new.php?id=<?=$new->id?>" id="only-new">
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