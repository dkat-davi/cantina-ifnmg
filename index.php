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
        include_once 'includes/header.inc.php';
    ?>
    <h2>Notícias</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis illo neque, aliquid error non magnam.</p>
    <p>Odit, magnam ea vero recusandae rem error velit dignissimos, perferendis iste sed veritatis earum harum!</p>
    <p>Hic exercitationem vel repudiandae, nam consectetur asperiores vero, explicabo voluptatibus unde quod officiis
        voluptate fugit!</p>
    <p>Repellendus quam qui, similique voluptatem eos ut modi id distinctio quia vel sapiente, delectus recusandae?</p>
    <p>Possimus quam error mollitia nostrum maxime amet in vel suscipit consequatur sequi beatae, eligendi neque!</p>

</body>

</html>