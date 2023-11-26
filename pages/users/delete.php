<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
    if(isset($_GET['id'])) {
        User::DeleteById($_GET['id']);
    }

    header("Location: index.php");