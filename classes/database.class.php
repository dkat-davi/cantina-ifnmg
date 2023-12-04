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
                'Administrador Teste',
                'admin@gmail.com',
                'admin',
                '25-10-2023',
                'admin',
                TRUE
            );
            User::Create(
                'Gerente Teste',
                'gerente@gmail.com',
                'gerente',
                '25-10-2023',
                'gerente',
                TRUE
            );
            User::Create(
                'Caixa Teste',
                'caixa@gmail.com',
                'caixa',
                '25-10-2023',
                'caixa',
                TRUE
            );
            User::Create(
                'Cliente Teste',
                'cliente@gmail.com',
                'cliente',
                '25-10-2023',
                'cliente',
                TRUE
            );
        } 

        R::close();
    }
}