<?php
class ConectPainel
{
    public static function deleteimgproduct($idproduct,$img = false,$idimg = false)
    {
       if($img != false AND $idimg != false){

        $listimg = \Painel::select('tb_admin.imgproducts','id_produto = ? AND id = ?',array($idproduct,$idimg));
   
            \Painel::deleteimgproduct($listimg['img_produto']);

            $deleteimgBD = \Painel::delete('tb_admin.imgproducts','WHERE id_produto = ?',array($idimg));
            if($deleteimgBD){
            return true;
            }else{
                return false;
            }
       

        
       }else{

        $listimg = \Painel::selectAllQuery('tb_admin.imgproducts','WHERE id_produto = ?',array($idproduct));
        foreach ($listimg as $key => $value) {
            \Painel::deleteimgproduct($value['img_produto']);
        }

        $deleteimgBD = \Painel::delete('tb_admin.imgproducts','WHERE id_produto = ?',array($idproduct));

        if($deleteimgBD){
            return true;
        }else{
            return false;
        }

       }

    }


}

?>