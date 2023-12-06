<?php
require_once __DIR__ . '\r.class.php';
require_once __DIR__ . '\database.class.php';
require_once __DIR__ . '\util.class.php';
date_default_timezone_set('America/Fortaleza');

class User
{
    const SALT = 'resturantetrabalhoequipe123';
    public static function Create($name, $email, $password, $birth, $role, $active, $pin)
    {
        DB::Start();

        $user = R::dispense('user');
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password . self::SALT);
        $user->birth = new DateTime($birth);
        $user->role = $role;
        $user->active = $active;
        $user->carteira = FALSE;
        $user->pin = md5($pin . self::SALT);
        $user->debitos = 0.00;

        R::store( $user );

        R::close();
    }

    public static function GetAll() {
        DB::Start();
        Util::SessionStart();
        if($_SESSION['user']['role'] === 'gerente') {
            return R::find('user', 'role != ? AND role != ?', ['admin', 'gerente']);
        } else {
            return R::findAll('user');
        }
        R::close();
    }

    public static function GetById($id) {
        DB::Start();
        return R::load('user', $id);
        R::close();
    }

    public static function GetUserByName($name) {
        DB::Start();
        $users = R::find('user', 'name LIKE ?', ['%' . $name . '%']);
        return $users;
        R::close;
    }

    public static function DeleteById($id) {
        DB::Start();
        R::trash('user', $id);
        R::close();
    }

    public static function Update($id, $name, $email, $password, $birth, $role, $active)
    {
        DB::Start();

        $user = self::GetById($id);

        $user->name = $id;
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password . self::SALT);
        $user->birth = new DateTime($birth);
        $user->role = $role;
        $user->active = $active;

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
            if($user->active) {
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
                header("Location: ?unactive");    
            }
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

    public static function ActiveUser($id) {
        $user = self::GetById($id);
        $user->active = !$user->active;
        DB::Start();
        R::store( $user );
        R::close();
        header("Location: ../../pages/users/index.php");
        exit();
    }

    public static function ActiveCarteira($id) {
        $user = self::GetById($id);
        $user->carteira = !$user->carteira;
        DB::Start();
        R::store( $user );
        R::close();
        header("Location: ../../pages/users/carteira.php");
        exit();
    }

    public static function IsActiveCarteira($id) {
        $user = self::GetById($id);
        return $user->carteira;
    }

    public static function validatePIN($userId, $pin)
    {
        DB::Start();

        $user = R::load('user', $userId);

        if ($user) {
            if ($user->pin === md5($pin . self::SALT)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function adicionarDebito($id, $valor) {
        $user = self::GetById($id);
        $user->debitos = $user->debitos + $valor;
        DB::Start();
        R::store( $user );
        R::close();
    }

    public static function quitarDebito($id, $valor) {
        $user = self::GetById($id);
        
        if($valor > $user->debitos) {
            $user->debitos = 0;
        } else {
            $user->debitos = $user->debitos - $valor;
        }
        DB::Start();
        R::store( $user );
        R::close();
    }
}