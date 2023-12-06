<?php
    require_once __DIR__ . '\..\..\classes\util.class.php';
    Util::SessionStart();
    if($_SESSION['products']) {
        $_SESSION['products'] = [];
    }