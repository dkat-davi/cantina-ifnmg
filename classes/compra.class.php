<?php
    require_once __DIR__ . '\util.class.php';
    require_once __DIR__ . '\product.class.php';
    require_once __DIR__ . '\user.class.php';
    class Compra{
        public static function ComprarAVista($clienteId, $products, $valor_total, $method, $compradoEm) {
            DB::Start();
            $compra = R::dispense('compra');
            $compra->cliente = $clienteId;
            $compra->products = json_encode($products);
            $compra->valor_total = $valor_total;
            $compra->method = $method;
            $compra->compradoEm = $compradoEm;

            R::store($compra);
            R::close();
            self::cancelarVenda();
            header("Refresh:3; URL=../caixa/index.php");
        }

        public static function ComprarAPrazo($clienteId, $products, $valor_total, $method, $compradoEm) {
            if(User::IsActiveCarteira($clienteId)) {
                DB::Start();
                $compra = R::dispense('compra');
                $compra->cliente = $clienteId;
                $compra->products = json_encode($products);
                $compra->valor_total = $valor_total;
                $compra->method = $method;
                $compra->compradoEm = $compradoEm;

                User::adicionarDebito($clienteId, $valor_total);

                R::store($compra);
                R::close();
                self::cancelarVenda();
                header("Refresh:3; URL=../caixa/index.php");
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
                echo "<p style=\"color:red;\">Carteira bloqueada, comunique com a gerência!</p>";
            }
        }

        public static function addProduct($productId, $qtde) {
            $product = Product::GetById($productId);
            Util::SessionStart();
            $_SESSION['products'][] = ['product' => $product, 'qtde' => $qtde];
        }

        public static function getAllProducts() {
            Util::SessionStart();
            
            if(isset($_SESSION['products'])) {
                if($_SESSION['products'] != []) {
                    return $products = $_SESSION['products'];
                } else {
                    return [];
                }
            } else {
                return [];
            }
        }

        public static function cancelarVenda() {
            Util::SessionStart();
            if($_SESSION['products']) {
                unset($_SESSION['products']);
            }
        }

        public static function getComprasFromUser($clienteId) {
            DB::Start();
            $compras = R::find('compra', 'cliente = ?', [$clienteId]);

            if ($compras) {
                foreach ($compras as $compra) {
                    $compra->products = json_decode($compra->products, true);
                }

                return $compras;
            } else {
                return null;
            }

            R::close();
        }
    }