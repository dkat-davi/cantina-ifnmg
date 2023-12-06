<?php
    require_once __DIR__ . '\..\..\classes\compra.class.php';
    Compra::cancelarVenda();
    header('Location: index.php');