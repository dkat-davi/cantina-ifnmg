<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\compra.class.php';
    User::AllowAccess(['admin', 'gerente', 'caixa']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/caixa/historico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
        $path_to_logout = '../users/logout.php';
        $path_to_admin = '../admin';
        $path_to_gerenciar = '../admin';
        $path_to_home = '../../index.php';
        $path_to_perfil = '../perfil';
        $path_to_news = '../news';
        $path_to_caixa = './';
        $path_to_products = '../products';
        include_once '../../includes/header.inc.php';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $compras = Compra::getComprasFromUser($id);
            $user = User::GetById($id);
        }
    
        if (isset($_POST['quitar-valor'])) {
            $id = $user->id;
            $valor = $_POST['quitar-valor'];
    
            User::quitarDebito($id, $valor);
            header("Location: ?id=$id");
        }
    ?>
    <main>
        <div class="container">
            <h1 class="title">Histórico de clientes<h1>
            <div class="quitar">
                <h1>Débito Total: R$<?=number_format($user->debitos, 2, ',', '.')?></h1>
                <form method="post">
                    <label for="quitar-valor">Quitar Valor:</label><br>
                    <input type="number" name="quitar-valor" step="0.01" required>
                    <button type="submit">Quitar</button>
                </form>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data de compra</th>
                            <th>Método de pagamento</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if($compras) {
                                foreach ($compras as $compra) {
                                    $comprado_em = new DateTime($compra->comprado_em);
                                    $comprado_em = $comprado_em->format('d/m/Y');
                            ?>
                        <tr>
                            <td><?=$compra->id?></td>
                            <td><?=$comprado_em?></td>
                            <td><?=$compra->method?></td>
                            <td><?=$compra->valor_total?></td>
                        </tr>
                        <?php
                                }
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>