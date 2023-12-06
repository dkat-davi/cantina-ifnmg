<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);

    require_once __DIR__ . '\..\..\classes\news.class.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $news = News::GetById($id);
    }

    if(isset($_POST['id']) &&
        isset($_POST['title']) &&
        isset($_POST['description']) &&
        isset($_POST['author']) &&
        isset($_POST['content'])
    ) {
        require_once __DIR__ . '\..\..\classes\news.class.php';         
        $id = $_POST['id'];
        $title = $_POST['title'];

        if(isset($_FILES['banner'])) {
            $banner = News::UploadImage();
        } else {
            $banner = '';
        }
        $description = $_POST['description'];
        $author = $_POST['author'];
        $content = $_POST['content'];

        News::Update(
            $id,
            $title,
            $banner,
            $description,
            $author,
            $content
        );

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/news/create.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tiny.cloud/1/ktun1zbdckd13t08reqjjw1403242g69e17musi3s0igdyku/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
    });
    </script>

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

        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <h1 class="title">Atualizar Notícia</h1>
                <div class="info">
                    <div>
                        <label for="title">Título:</label><br>
                        <input type="text" name="title" id="title" required placeholder="Insira o título da notícia"
                            value="<?=$news->title?>">
                    </div>

                    <div>
                        <label for="banner">Selecione a imagem capa da notícia:</label>
                        <input type="file" id="banner" name="banner" accept="image/*" required>
                    </div>
                    <div>
                        <img src="../../assets/img/news/<?=$news->banner?>" alt="Imagem do <?=$news->title?>"
                            width="300" heigth="120">
                    </div>
                </div>
                <div class="info">
                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                    <div>
                        <label for="author">Autor:</label><br>
                        <input type="text" name="author" id="autor" required placeholder="Nome do autor da notícia"
                            value="<?=$news->author?>">
                    </div>

                    <div>
                        <label for="description">Descrição:</label><br>
                        <input type="text" name="description" id="description" required
                            placeholder="Insira um pequeno resumo da notícia" value="<?=$news->description?>">
                    </div>
                </div>

                <textarea id="content" placeholder="Digite a sua notícia" name="content"><?=$news->content?></textarea>

                <div class="submit-form">
                    <button type="submit" class="submit">Atualizar</button>
                    <button class="cancel"><a href="./index.php">Cancelar</a></button>
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
                            Notícia atualizada com sucesso!
                        </p>';
                    }
                ?>
            </form>
        </div>
    </main>

</html>