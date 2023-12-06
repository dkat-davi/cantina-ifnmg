<?php
    require_once __DIR__ . '\util.class.php';
    require_once __DIR__ . '\product.class.php';
    class Compra{
        public static function addProduct($productId, $qtde) {
            $product = Product::GetById($productId);
            Util::SessionStart();
            $_SESSION['products'][] = ['product' => $product, 'qtde' => $qtde];
        }

        public static function removeProduct($productId) {
            Util::SessionStart();
            foreach ($_SESSION['products'] as $key => $product) {
                if($product['product']['id'] === $productId) {
                    unset($_SESSION['products'][$key]);
                    $_SESSION['products'] = array_values($_SESSION['products']);
                }
            }
        }

        public static function getAllProducts() {
            Util::SessionStart();
            if($_SESSION['products']) {
                return $products = $_SESSION['products'];
            }
        }

        public static function cancelarVenda() {
            Util::SessionStart();
            if($_SESSION['products']) {
                $_SESSION['products'] = [];
            }
        }
    }