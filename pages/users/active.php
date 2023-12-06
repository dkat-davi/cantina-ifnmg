<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    User::AllowAccess(['admin', 'gerente']);
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        User::ActiveUser($id);
    }