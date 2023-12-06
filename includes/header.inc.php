<header>
    <h1><a href="<?=$path_to_home?>">LOGO</a></h1>



    <?php
        require_once __DIR__ . '\..\classes\user.class.php';

        if(isset($path_to_home)) {
            echo "<ul><li><a href=\"$path_to_home\">Home</a></li>";   
        }
        
        if(isset($path_to_products)) {
            echo "<li><a href=\"$path_to_products\">Produtos</a></li>";
        }

        if(isset($path_to_news)) {
            echo "<li><a href=\"$path_to_news\">Notícias</a></li>";
            
        }

        if (User::isLogado()) {
            $user = $_SESSION['user'];
            $role = $user['role'];
            $name = $user['name'];

            $words = explode(' ', $name);
            $first_letter = mb_substr($words[0], 0, 1, 'UTF-8');
            $last_letter = mb_substr($words[count($words) - 1], 0, 1, 'UTF-8');
            $sigla = $first_letter . $last_letter;

        switch ($role) {
            case 'admin':

                if(isset($path_to_admin)) {
                    echo "<li><a href=\"$path_to_admin\">Administrar</a></li>";  
                }

                if(isset($path_to_caixa)) {
                    echo "<li><a href=\"$path_to_caixa\">Caixa</a></li></ul>";
                }
                break;
                
            case 'gerente':
                
                if(isset($path_to_gerenciar)) {
                    echo "<li><a href=\"$path_to_gerenciar\">Gerenciar</a></li>";
                }
                if(isset($path_to_caixa)) {
                    echo "<li><a href=\"$path_to_caixa\">Caixa</a></li></ul>";
                }
                break;
                
            case 'caixa':
                
                if(isset($path_to_caixa)) {
                    echo "<li><a href=\"$path_to_caixa\">Caixa</a></li></ul>";
                }
                break;
                
            default:
                echo '</ul>';
                break;
                
        }

        if(isset($path_to_perfil)) {
            echo "<a href=\"$path_to_perfil\"><p id=\"login\">". strtoupper($sigla) ."</p></a>";
        }

    } else {
        echo '</ul>';
        if(isset($path_to_login)) {
            ?>
    <a href="<?=$path_to_login?>">
        <p id="login">
            <span>Login</span><i class="fa-solid fa-user"></i>
            <p>
    </a>

    <?php
            
        }
?>


    <?php
    }
?>
</header>