<?php

namespace Models;

use MySql;


class CategoryModel
{

  public static function verifyPage()
  {
    $url = explode('/',$_GET['url']);
    if(!isset($url[1]) or $url[1] == ""){
      $url = explode('/',$_GET['url'])[0];
      $qtd = 1;
    }else{

      if($url[1] != ""){
        $qtd = 0;
        foreach ($url as $key => $value) {
          $qtd++;
        }
      }else{
        $qtd = 1;
      }
      
    }
    if($qtd == 1){
      
      //corresponde apenas a categoria na url
        $resFrame=\Painel::select('tb_admin.store_category','slug = ? AND status = ?',array($url,'on'));
        if($resFrame != null){

          return $resFrame;
        }else{
          return false;
        }
        
      

    }else{
      // 2 = Voltar para o inicio pois nao condiz com url correta
      header('Location: '.INCLUDE_PATH);
    }
  }

  public static function getProductsOfCategory($categoryId)
  {
   
      //corresponde apenas a categoria na url
        $resProducts = \Painel::selectAllQuery('tb_admin.store_products','WHERE category = ? AND status = ?',array($categoryId,'on'));
        if($resProducts != null){

          return $resProducts;
        }else{
          return false;
        }
        
      

   
  }

  public static function dadosFrame()
  {
      $slug = explode('/',$_GET['url'])[1];
      if($slug == 'em-alta'){
        $resFrame=\Painel::select('tb_admin.frames','slug = ? AND status = ?',array($slug,'on'));
        $query = 'WHERE status = ? ORDER BY views_total ASC LIMIT 24';
        $res=\Painel::selectAllQuery('tb_admin.store_products',$query,array('on'));
        return array($res,$resFrame);
      }else{

        $resFrame=\Painel::select('tb_admin.frames','slug = ? AND status = ?',array($slug,'on'));
        if($resFrame != null){
          $query = 'WHERE status = ? AND frame = ? ORDER BY views_total ASC';
          $res=\Painel::selectAllQuery('tb_admin.store_products',$query,array('on',$resFrame['id']));

          return array($res,$resFrame);
        }else{
          return false;
        }
        
      }
  }



    public static function url()
    {
      // /collection/em-alta

      if(explode('/',$_GET['url'])[0] == 'collection'){

        // SE COLLECTION/ ESTIVER VAZIO SERA DIRECIONADO PARA O INICIO
        if(!isset(explode('/',$_GET['url'])[1]) || explode('/',$_GET['url'])[1] == ''){
          Header('Location: '.INCLUDE_PATH);
        }else{
          $slug = explode('/',$_GET['url'])[1];
          $res=\Painel::checkSlugFrame($slug);
          if($res == true){
            return true;
          }else{
            return false;
          }
          
        }
      }else{
        return false;
      }

    }
    
}
