<?php
    require_once __DIR__ . '\..\classes\user.class.php';

    if (User::isLogado()) {
        $user = $_SESSION['user'];
        $role = $user['role'];
        $name = $user['name'];

        $words = explode(' ', $name);
        $first_letter = mb_substr($words[0], 0, 1, 'UTF-8');
        $last_letter = mb_substr($words[count($words) - 1], 0, 1, 'UTF-8');
        $sigla = $first_letter . $last_letter;
?>

<h2><?= strtoupper($sigla) ?></h2>

<ul style="display: flex; gap: 4rem;">
    <?php

        switch ($role) {
            case 'admin':

                if(isset($path_to_perfil)) {
                    echo "<li><a href=\"$path_to_perfil\">Perfil</a></li>";
                }

                if(isset($path_to_admin)) {
                    echo "<li><a href=\"$path_to_admin\">Administrar</a></li>";  
                }
                if(isset($path_to_gerenciar)) {
                    echo "<li><a href=\"$path_to_gerenciar\">Gerenciar</a></li>";
                }
                if(isset($path_to_caixa)) {
                    echo "<li><a href=\"$path_to_caixa\">Caixa</a></li>";
                }
                break;
                
            case 'gerente':
                
                if(isset($path_to_perfil)) {
                    echo "<li><a href=\"$path_to_perfil\">Perfil</a></li>";
                }
                if(isset($path_to_gerenciar)) {
                    echo "<li><a href=\"$path_to_gerenciar\">Gerenciar</a></li>";
                }
                if(isset($path_to_caixa)) {
                    echo "<li><a href=\"$path_to_caixa\">Caixa</a></li>";
                }
                break;
                
            case 'caixa':
                
                if(isset($path_to_perfil)) {
                    echo "<li><a href=\"$path_to_perfil\">Perfil</a></li>";
                }
                if(isset($path_to_caixa)) {
                    echo "<li><a href=\"$path_to_caixa\">Caixa</a></li>";
                }
                break;
                
            default:
                
                if(isset($path_to_perfil)) {
                    echo "<li><a href=\"$path_to_perfil\">Perfil</a></li>";
                }
                break;
        }
        if(isset($path_to_home)) { 
            echo "<li><a href=\"$path_to_home\">Home</a></li>";
        }
        if(isset($path_to_news)) {
            echo "<li><a href=\"$path_to_news\">Notícias</a></li>";
            
        }
        
        if(isset($path_to_logout)) {
            echo "<li><a href=\"$path_to_logout\">Logout</a></li>";
        }
    ?>
</ul>

<?php
    } else {
        if(isset($path_to_home)) { 
            echo "<li><a href=\"$path_to_home\">Home</a></li>";
        }
        
        if(isset($path_to_login)) {
            echo "<li><a href=\"$path_to_login\">Login</a></li>";
            
        }
        if(isset($path_to_news)) {
            echo "<li><a href=\"$path_to_news\">Notícias</a></li>";
            
        }
?>


<?php
    }