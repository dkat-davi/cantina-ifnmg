<?php
    require_once __DIR__ . '\r.class.php';
    require_once __DIR__ . '\database.class.php';
    require_once __DIR__ . '\util.class.php';

    class Product {
        public static function Create($name, $description, $price, $unidade, $qtde, $image) {
            DB::Start();

            $product = R::dispense('product');
            $product->name = $name;
            $product->description = $description;
            $product->price = $price;
            $product->code = uniqid('pd');
            $product->qtde = $qtde;
            $product->unidade = $unidade;
            $product->image = $image;
    
            R::store( $product );
    
            R::close();
        }

        public static function UploadImage() {
            $filename = $_POST['name'];
            $extension = pathinfo($_FILES['image']['name'])['extension'];
            $file =  $filename . uniqid() . '.' . $extension;
            $move_to = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR .'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $move_to . $file
            );

            return $file;
        }

        public static function DeleteImage($filename) {
            $caminho_completo = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR .'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $filename;
        
            if (file_exists($caminho_completo)) {
                unlink($caminho_completo);
            }
        }

        public static function DeleteById($id, $filename) {
            self::DeleteImage($filename);
            DB::Start();
            R::trash('product', $id);
            R::close();
        }

        public static function GetAll() {
            DB::Start();
            return R::findAll( 'product' );
            R::close();
        }

        public static function GetById($id) {
            DB::Start();
            return R::load('product', $id);
            R::close();
        }
    }