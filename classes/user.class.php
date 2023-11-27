<?php
require_once __DIR__ . '\r.class.php';
require_once __DIR__ . '\database.class.php';
require_once __DIR__ . '\util.class.php';

class User
{
    const SALT = 'resturantetrabalhoequipe123';
    public static function Create($name, $email, $password, $birth, $role)
    {
        DB::Start();

        $user = R::dispense('user');
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password . self::SALT);
        $user->birth = new DateTime($birth);
        $user->role = $role;

        R::store( $user );

        R::close();
    }

    public static function GetAll() {
        DB::Start();
        return R::findAll('user');
        R::close();
    }

    public static function GetById($id) {
        DB::Start();
        return R::findOne('user', $id);
        R::close();
    }

    public static function DeleteById($id) {
        DB::Start();
        R::trash('user', $id);
        R::close();
    }

    public static function Update($id, $name, $email, $password, $birth, $role)
    {
        DB::Start();

        $user = self::GetById($id);

        $user->name = $id;
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password . self::SALT);
        $user->birth = new DateTime($birth);
        $user->role = $role;

        R::store( $user );

        R::close();
    }

    public static function isLogado() {
        Util::SessionStart();

        return isset($_SESSION['user']);
    }

    public static function Login($email, $password) {
        
        DB::Start();

        $user = R::findOne('user', 'email = ? AND password = ?', [$email, md5($password . self::SALT)]);
    
        if($user) {
            Util::SessionStart();
            
            $userdata = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'birth' => $user->birth,
                'role' => $user->role
            ];

            $_SESSION['user'] = $userdata;

            session_write_close();

            header("Location: ../../index.php");
            exit();
        } else {
            header("Location: ?unauthorized");
        }

        R::close();
    }

    public static function Logout() {
        Util::SessionStart();
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }

    public static function AllowAccess($rolesPermitidas) {
        if(self::isLogado()) {
            Util::SessionStart();
            $role_do_usuario = [$_SESSION['user']['role']];

            $user_permitido = array_intersect($rolesPermitidas, $role_do_usuario);

            if(empty($user_permitido)) {
                echo "<p>Área restrita para usuários com permissão! Você será redirecionado em 5 segundos, caso contrário,<a href=\"../../index.php\">clique aqui.</a></p>";
                header("Refresh: 5; URL= ../../index.php");
                die();
            }
        } else {
            echo "<p>Área restrita para usuários com permissão! Você será redirecionado em 5 segundos, caso contrário,<a href=\"../../index.php\">clique aqui.</a></p>";
                header("Refresh: 5; URL= ../../index.php");
                die();
        }
    }
}