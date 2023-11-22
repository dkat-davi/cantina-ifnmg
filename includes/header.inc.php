<?php
    require_once './classes/user.class.php';
    require_once './classes/util.class.php';

    if (User::isLogado()) {
        Util::SessionStart();
        $user = $_SESSION['user'];
    ?>  

        <p>Nome:<?="{$user->nome}"?></p>

    <?php
    } else {
    ?>
        <a href="./pages/login">Login</a>
    <?php
    }
