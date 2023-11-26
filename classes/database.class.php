<?php
require_once 'r.class.php';
require_once 'user.class.php';

class DB
{
    public static function Start()
    {
        $isConnected = R::testConnection();
        if (!$isConnected) {
            R::setup('mysql:host=localhost;dbname=cantina_ifnmg', 'root', '');
        }
    }

    public static function Seed()
    {
        DB::Start();
        $users = R::findAll('user');
        
        if(!$users) {
            User::Create(
                'João Gabriel De Jesus Braga',
                'jbragas@gmail.com',
                'restaurante123',
                '25-10-2023',
                'admin'
            );
        } 
        
        R::close();
    }
}