<?php
    require_once './autoloader.class.php';

    class User{
        public static function Create($name, $email, $password, $birth, $role) {
            DB::Start();

            $user = R::dispense( 'user' );
            $user->name = $name;
            $user->email = $email;
            $user->password = md5($password, "resturantetrabalhoequipe123");
            $user->birth = $birth;
            $user->role = $role;

            R::close();
        }

        public static function Seed() {
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