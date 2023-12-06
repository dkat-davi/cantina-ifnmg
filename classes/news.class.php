<?php

require_once 'r.class.php';
require_once 'database.class.php';
date_default_timezone_set('America/Fortaleza');

class News {  
    public static function Create($title, $banner, $description , $author, $content)
    {
        DB::Start();
        echo "test";
        $news = R::dispense('news');

        $news->title = $title;
        $news->banner = $banner;
        $news->description = $description;
        $news->author = $author;
        $news->content = $content;
        $news->createdAt = new Datetime();
        $news->updateAt = new Datetime();

        R::store($news);
        R::close();
    }  

    public static function Update($id, $title, $banner, $description , $author, $content)
    {
        DB::Start();

        $news = self::GetById($id);

        $news->id = $id;
        $news->title = $title;

        if($banner != '') {
            self::DeleteImage($news->banner);
            $news->banner = $banner;
        }

        $news->description = $description;
        $news->author = $author;
        $news->content = $content;
        $news->updateAt = new Datetime();

        R::store($news);
        R::close();
    }

    public static function GetAll() {
        DB::Start();
        return R::findAll('news', 'ORDER BY created_at DESC');
        R::close();
    }

    public static function GetById($id) {
        DB::Start();
        return R::load('news', $id);
        R::close();
    }

    public static function DeleteById($id, $filename) {
        self::DeleteImage($filename);
        DB::Start();
        R::trash('news', $id);
        R::close();
    }

    public static function UploadImage() {
        $filename = explode(' ', $_POST['title'])[0];
        $extension = pathinfo($_FILES['banner']['name'])['extension'];
        $file =  $filename . uniqid() . '.' . $extension;
        $move_to = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR .'img' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR;

        move_uploaded_file(
            $_FILES['banner']['tmp_name'],
            $move_to . $file
        );

        return $file;
    }

    public static function DeleteImage($filename) {
        $caminho_completo = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR .'img' . DIRECTORY_SEPARATOR . 'news' . DIRECTORY_SEPARATOR . $filename;
    
        if (file_exists($caminho_completo)) {
            unlink($caminho_completo);
        }
    }
}