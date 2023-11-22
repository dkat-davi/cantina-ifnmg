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

    public static function isLogado() {
        if(isset($_SESSION)) {
            session_start();
            return isset($_SESSION['user']);
        }
    }

    // TODO
    public static function Login($email, $password) {
        DB::Start();
        R::find('user');
    }
}
