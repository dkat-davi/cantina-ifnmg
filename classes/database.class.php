<?php
require_once 'r.class.php';

class DB
{
    public static function Start()
    {
        $isConnected = R::testConnection();
        if (!$isConnected) {
            R::setup('mysql:host=localhost;dbname=cantina_ifnmg', 'root', '');
        }
    }
}
