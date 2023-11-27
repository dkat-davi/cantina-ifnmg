<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
</head>

<body>
    <header>Create News</header>
    <main>
        <form>
            <fieldset>
                <label for='titulo'>Titulo</label>
                <input type='text' id='titulo' name='titulo'><br><br>

                <label for='descricao'>Descricao</label>
                <textarea id='descricao' name='descricao' rows='4' cols='50'></textarea><br><br>

                <label for='autor'>Autor</label>
                <input type='text' id='autor' name='autor'><br><br>

                <label for='imagem'>Imagem</label>
                <input type="file" name="imagem" accept="image/png" required><br><br>

                <input type="submit" value="Enviar">


            </fieldset>
        </form>

        <?php

       require_once '../../classes/r.class.php';
       require_once '../../classes/news.class.php';

        if (isset($_GET['titulo']) && isset($_GET['descricao']) && isset($_GET['autor']) && isset($_GET['imagem'])) {
            $titulo = $_GET['titulo'];
            $descricao = $_GET['descricao'];
            $autor = $_GET['autor'];
            $imagem = $_GET['imagem'];

            News::Create($titulo, $descricao, $autor, $imagem);




        }

        ?>

    </main>

</html>