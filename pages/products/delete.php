<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\product.class.php';
    User::AllowAccess(['admin', 'gerente']);
    if(isset($_GET['id']) && isset($_GET['image'])) {
        Product::DeleteById($_GET['id'], $_GET['image']);
    }

    header("Location: admin.php");