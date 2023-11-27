<?php

require_once 'r.class.php';
require_once 'database.class.php';


class News
{
   
public static function Create($titulo , $descricao , $autor , $imagem)
{
   
        DB::Start();

        $news = R::dispense('news');

        $news->titulo = $titulo;
        $news->descricao = $descricao;
        $news->autor = $autor;
        $news->imagem = $imagem;

        R::store($news);
        R::close();

    
   


}




   
   

       
}


?>