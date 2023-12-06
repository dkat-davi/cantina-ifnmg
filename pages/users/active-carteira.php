<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        User::ActiveCarteira($id);
    }