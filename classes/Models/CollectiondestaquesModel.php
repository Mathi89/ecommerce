<?php

namespace Models;

use MySql;


class CollectiondestaquesModel
{

  public static function dadosFrame()
    {
      $slug = explode('/',$_GET['url'])[1];
      if($slug == 'em-alta'){
        $resFrame=\Painel::select('tb_admin.frames','slug = ? AND status = ?',array($slug,'on'));
        // $query = 'WHERE status = ? ORDER BY views_total ASC LIMIT 24';
        // $res=\Painel::selectAllQuery('tb_admin.store_products',$query,array('on'));

        $res=\MySql::conectar()->prepare("SELECT tbc.slug as categoria, tbp.* FROM `tb_admin.store_products` tbp
            INNER JOIN `tb_admin.store_category` tbc ON tbp.category = tbc.id
            WHERE tbp.status = ? ORDER BY tbp.views_total ASC ");
            $res->execute(array('on'));
            $res = $res->fetchAll();

        return array($res,$resFrame);
      }else{

        $resFrame=\Painel::select('tb_admin.frames','slug = ? AND status = ?',array($slug,'on'));
        if($resFrame != null){
          // $query = 'WHERE status = ? AND frame = ? ORDER BY views_total ASC';
          // $res=\Painel::selectAllQuery('tb_admin.store_products',$query,array('on',$resFrame['id']));

          $res=\MySql::conectar()->prepare("SELECT tbc.slug as categoria, tbp.* FROM `tb_admin.store_products` tbp
            INNER JOIN `tb_admin.store_category` tbc ON tbp.category = tbc.id
            WHERE tbp.frame = ? AND  tbp.status = ? ORDER BY tbp.views_total ASC ");
            $res->execute(array($resFrame,'on'));
            $res = $res->fetchAll();

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
