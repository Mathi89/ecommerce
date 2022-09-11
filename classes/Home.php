<?php
class Home
{
    public static function listProducts($id_frame)
    {
        if($id_frame == 1){
            // $query = 'WHERE status = ? ORDER BY views_total ASC LIMIT 10';
            // $res = \Painel::selectAllQuery('tb_admin.store_products',$query,array('on'));

            $res=\MySql::conectar()->prepare("SELECT tbc.slug as categoria, tbp.* FROM `tb_admin.store_products` tbp
            INNER JOIN `tb_admin.store_category` tbc ON tbp.category = tbc.id
            WHERE tbp.status = ? ORDER BY tbp.views_total ASC LIMIT 10");
            $res->execute(array('on'));


        }else{
            // $query = 'WHERE frame = ? AND status = ? ORDER BY views_total ASC LIMIT 10';
            // $res = \Painel::selectAllQuery('tb_admin.store_products',$query,array($id_frame,'on'));

            $res=\MySql::conectar()->prepare("SELECT tbc.slug as categoria, tbp.* FROM `tb_admin.store_products` tbp
            INNER JOIN `tb_admin.store_category` tbc ON tbp.category = tbc.id
            WHERE tbp.frame = ? AND  tbp.status = ? ORDER BY tbp.views_total ASC LIMIT 10");
            $res->execute(array($id_frame,'on'));
        }
        
        $res = $res->fetchAll();
        return $res;

    }
}
?>