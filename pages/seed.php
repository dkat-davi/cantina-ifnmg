<?php
    require_once '../classes/database.class.php';
    DB::Seed();
    header("Location: ../index.php");
    die();
?>