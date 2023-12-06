<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\news.class.php';
    User::AllowAccess(['admin', 'gerente']);
    if(isset($_GET['id'])) {
        News::DeleteById($_GET['id'], $_GET['banner']);
    }

    header("Location: index.php");