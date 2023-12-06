<?php
    require_once __DIR__ . '\..\..\classes\compra.class.php';
    User::AllowAccess(['admin', 'gerente']);
    if(isset($_GET['id'])) {
        Compra::removeProduct($_GET['id']);
    }

    header("Location: finalizar-compra.php");