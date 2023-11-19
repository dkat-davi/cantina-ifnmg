<?php
require_once 'r.class.php';
require_once 'database.class.php';

class User
{
    const SALT = 'resturantetrabalhoequipe123';
    public static function Create($name, $email, $password, $birth, $role)
    {
        DB::Start();

        $user = R::dispense('user');
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password, self::SALT);
        $user->birth = $birth;
        $user->role = $role;

        R::store( $user );

        R::close();
    }

    public static function Seed()
    {
        self::Create(
            'João Gabriel De Jesus Braga',
            'jbragas@gmail.com',
            'restaurante123',
            '25-10-2023',
            'admin'
        );

        R::close();
    }
}