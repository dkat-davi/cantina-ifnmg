<?php
    require_once __DIR__ . '\..\..\classes\user.class.php';
    require_once __DIR__ . '\..\..\classes\compra.class.php';
    User::AllowAccess(['admin', 'gerente', 'caixa']);

    date_default_timezone_set('America/Fortaleza');
    if(isset($_POST['products']) &&
        isset($_POST['qtde']) &&
        !empty($_POST['products']) &&
        !empty($_POST['qtde'])
    ) {
        $products = $_POST['products'];
        foreach ($products as $productId) {
            $qtde = $_POST['qtde'][$productId];
            Compra::addProduct($productId, $qtde);
        }
    }

    $products = Compra::getAllProducts();
    if(count($products) === 0) {
        header("Location: add-product.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Registradora</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/caixa/finalizar-compra.css">
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
        $path_to_logo = '../../assets/logo.png';
        include_once '../../includes/header.inc.php';
    ?>
    <main>
        <div class="container">
            <h1 class="title">Finalizar Compra</h1>
            <div class="submit-form">
                <!-- <button type="submit">Continuar venda</button> -->
                <a href="./add-product.php" style="background-color: rgb(255, 187, 0); color: rgb(43, 29, 0);">Adicionar Produtos</a>
                <a href="./cancelar.php">Cancelar venda</a>
            </div>
            <div class="wrapper">
                <div class="cliente">
                    <?php 
                        if(isset($_GET['carteira'])) {
                    ?>
                            <a href="?" class="a-vista">Comprar a vista</a>
                            
                            <form method="post" class="form-cliente">
                                <label for="user">Selecione o cliente:</label>
                                <select name="user" id="user" required>
                                    <option value="anonimo" selected disabled style="color: gray;">Selecione o cliente</option>
                                    <?php
                                        $users = User::GetAll();
                                        foreach ($users as $user) {
                                    ?>
                                        <option value="<?=$user->id?>"><?=$user->id . ' ' . $user->email?></option>
                                    <?php          
                                        }
                                    ?>
                                </select>    

                                <label for="method">Selecione o método de pagamento:</label>
                                <select name="method" id="method">
                                    <option value="dinheiro">Dinheiro</option>
                                    <option value="pix">PIX</option>
                                    <option value="debito">Cartão de débito</option>
                                    <option value="credito">Cartão de credito</option>
                                </select>

                                <label for="pin">Solicitar PIN:</label>
                                <input type="password" id="pin" name="pin" required placeholder="Solicite o PIN do cliente" maxlength="4">

                                <button type="submit">Finalizar</button>
                            </form>

                            <?php
                                if(isset($_POST['user']) &&
                                isset($_POST['method'])
                            ) {
                                $clienteId = $_POST['user'];
                                $products = Compra::getAllProducts();

                                $valor_total = 0;
                                foreach ($products as $product) {
                                    $valor_total += $product['qtde'] * $product['product']->price;
                                }
                                $method = $_POST['method'];
                                $compradoEm = new DateTime();

                                if(isset($_POST['pin'])) {
                                    $pin = $_POST['pin'];

                                    if(User::validatePIN($clienteId, $pin)) {
                                        Compra::ComprarAPrazo(
                                            $clienteId,
                                            $products,
                                            $valor_total,
                                            $method,
                                            $compradoEm,
                                        );
                                    } else {
                                        echo "<p style=\"color:red;\">PIN errado, por favor tente</p>";
                                    }
                                }
                            }
                            ?>
                    <?php            
                        } else {
                    ?>
                            <a href="?carteira" class="a-prazo">Comprar a prazo</a>
                            
                            <form method="post" class="form-cliente">
                                <label for="user">Selecione o cliente:</label>
                                <select name="user" id="user">
                                    <option value="anonimo" selected>Anônimo</option>
                                    <?php
                                        $users = User::GetAll();
                                        foreach ($users as $user) {
                                    ?>
                                        <option value="<?=$user->id?>"><?=$user->id . ' ' . $user->email?></option>
                                    <?php          
                                        }
                                    ?>
                                </select>    

                                <label for="method">Selecione o método de pagamento:</label>
                                <select name="method" id="method">
                                    <option value="dinheiro">Dinheiro</option>
                                    <option value="pix">PIX</option>
                                    <option value="debito">Cartão de débito</option>
                                    <option value="credito">Cartão de credito</option>
                                </select>

                                <label for="pin">Solicitar PIN:</label>
                                <input type="password" id="pin" name="pin" placeholder="Solicite o PIN do cliente" maxlength="4">

                                <button type="submit">Finalizar</button>
                            </form>
                            
                            <?php
                                if(isset($_POST['user']) &&
                                    isset($_POST['method'])
                                ) {
                                    $clienteId = $_POST['user'];
                                    $products = Compra::getAllProducts();

                                    $valor_total = 0;
                                    foreach ($products as $product) {
                                        $valor_total += $product['qtde'] * $product['product']->price;
                                    }
                                    $method = $_POST['method'];
                                    $compradoEm = new DateTime();

                                    if($clienteId === 'anonimo') {
                                        Compra::ComprarAVista(
                                            $clienteId,
                                            $products,
                                            $valor_total,
                                            $method,
                                            $compradoEm,
                                        );

                                        echo 
                                        '<p 
                                            style="
                                                color:darkgreen; 
                                                width: 100%; 
                                                text-align:center;
                                                padding: 1rem;
                                                background-color: #70b38688;
                                                border-radius: 5px;
                                            ">
                                            Compra finalizada com sucesso! Aguarde 3 segundos para fazer uma nova operação.
                                        </p>';

                                    } else {
                                        if(isset($_POST['pin'])) {
                                            $pin = $_POST['pin'];
                                            if(User::validatePIN($clienteId, $pin)) {
                                                Compra::ComprarAVista(
                                                    $clienteId,
                                                    $products,
                                                    $valor_total,
                                                    $method,
                                                    $compradoEm,
                                                );
        
                                                echo 
                                                '<p 
                                                    style="
                                                        color:darkgreen; 
                                                        width: 100%; 
                                                        text-align:center;
                                                        padding: 1rem;
                                                        background-color: #70b38688;
                                                        border-radius: 5px;
                                                    ">
                                                    Compra finalizada com sucesso! Aguarde 3 segundos para fazer uma nova operação.
                                                </p>';
                                            } else {
                                                echo "<p style=\"color:red;\">PIN errado, por favor tente</p>";
                                            }
                                        }
                                    }
                                    
                                    
                                }
                            ?>
                    <?php
                        }
                    ?>

                    <div>

                    </div>
                </div>
                <div class="table">
                    <table>
                        <caption>Lista de compra</caption>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
                        $products = Compra::getAllProducts();
                        if(is_array($products)) {
                            $total = 0;
                            foreach ($products as $product) {
                            $total += $product['qtde'] * $product['product']->price;
    ?>
                                <tr>
                                    <td><?=$product['product']->code?></td>
                                    <td><?=$product['product']->description?></td>
                                    <td><?=str_replace('.', ',', ($product['product']->price))?></td>
                                    <td><?=$product['qtde']?></td>
                                    <td><?=$product['qtde'] * $product['product']->price?></td>
                                    <td>
                                        <a href="./remove-product.php?id=<?=$product['product']->id?>" class="delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
    <?php
                            }
                        }
    ?>
                    </tbody>
                    </table>
                    <div class="total">
                        <p>Total da compra</p>
                        <h2>R$<?=str_replace('.', ',', $total)?></h2>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>