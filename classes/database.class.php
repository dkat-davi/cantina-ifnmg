<?php
    require_once './autoloader.class.php';

    class DB {
        public static function Start() {
            $isConnected = R::testConnection();
            if(!$isConnected) {
                R::setup( 'mysql:host=localhost;dbname=aeroporto','root', '' );
            }
        }
    }