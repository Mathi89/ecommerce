<?php
class FeaturesCart
{
    public static function getTotalItenCart()
    {
       if(isset($_SESSION['carrinho'])){

        $amountQTD = 0;
        foreach ($_SESSION['carrinho'] as $key => $value) {
            $amountQTD+=$value;
        }
        if($amountQTD > 99){
            $amountQTD = "+99";
        }
        return $amountQTD;

       }else{
        return 0;
       }
    }

    public static function getPrecosVariacao($produtoID)
    {
        $valormenor = \Painel::select('tb_admin.variacoes_produtos','id = ? ORDER BY preco ASC',array($produtoID));

        $valormaior = \Painel::select('tb_admin.variacoes_produtos','id = ? ORDER BY preco DESC',array($produtoID));

        return json_encode(array($valormenor['preco'],$valormaior['preco']));
    }

    public static function newproduct()
    {
        
        if(isset($_POST['name']) && isset($_POST['objeto']) && isset($_POST['preco']) && isset($_POST['type']) & isset($_POST['categorias']))
        {
            $nomeproduto = $_POST['name'];
            $preco = $_POST['preco'];
            $precopromotion = $_POST['precopromotion'];
            $description = $_POST['description'];
            $type = $_POST['type'];
            $categorias = $_POST['categorias'];
            $estoque = $_POST['estoque'];
            $slug = $_POST['slug'];
            $foto = $_FILES['foto'];
            $objeto = $_POST['objeto'];

            if($objeto == "combo"){


                if($type == "recarga"){

                if(isset($_POST['nomevariacao']) AND isset($_POST['typevariacao']) AND isset($_POST['qtdvariacao']) AND isset($_POST['plataforma'])){
                    $nomevariacao = $_POST['nomevariacao'];
                    $typevariacao = $_POST['typevariacao'];
                    $qtdvariacao = $_POST['qtdvariacao'];
                    $plataformarecarga = $_POST['plataforma'];
                    if($nomevariacao != "" AND $typevariacao != "" AND $qtdvariacao != "" AND $plataformarecarga != ""){
                    $verifynome = (false === array_search(false , $nomevariacao, false));
                    $verifytype = (false === array_search(false , $typevariacao, false));
                    $verifyqtd = (false === array_search(false , $qtdvariacao, false));
                    $verifyplataformarecarga = (false === array_search(false , $plataformarecarga, false));

                    if($verifynome != false && $verifytype != false && $verifyqtd != false && $verifyplataformarecarga != false){

                    
                        $res = \Painel::newproductcombo(
                            $nomeproduto,
                            $preco,
                            $precopromotion,
                            $description,
                            $type,
                            $categorias,
                            $estoque,
                            $slug,
                            $foto,
                            $nomevariacao,
                            $typevariacao,
                            $qtdvariacao,
                            $plataformarecarga,
                            $objeto
                        );

                    }else{
                        $res = 'preench';
                    }


                    }else{
                        $res = 'preench';
                    }
                }else{
                    $res = 'preench';
                }
            }else{

                $res = \Painel::newproduct(
                    $nomeproduto,
                    $preco,
                    $precopromotion,
                    $description,
                    $type,
                    $categorias,
                    $estoque,
                    $slug,
                    $foto,
                    $objeto
                );
            }



            }else{

            if($type == "recarga"){
                if(isset($_POST['nomevariacao']) AND isset($_POST['typevariacao']) AND isset($_POST['qtdvariacao']) AND isset($_POST['precovariacao']) AND isset($_POST['plataforma'])){
                    $nomevariacao = $_POST['nomevariacao'];
                    $typevariacao = $_POST['typevariacao'];
                    $qtdvariacao = $_POST['qtdvariacao'];
                    $precovariacao = $_POST['precovariacao'];
                    $plataformarecarga = $_POST['plataforma'];
                    if($nomevariacao != "" AND $typevariacao != "" AND $qtdvariacao != "" AND $precovariacao != "" AND $plataformarecarga != ""){
                    $verifynome = (false === array_search(false , $nomevariacao, false));
                    $verifytype = (false === array_search(false , $typevariacao, false));
                    $verifyqtd = (false === array_search(false , $qtdvariacao, false));
                    $verifypreco = (false === array_search(false , $precovariacao, false));
                    $verifyplataformarecarga = (false === array_search(false , $plataformarecarga, false));

                    if($verifynome != false && $verifytype != false && $verifyqtd != false && $verifypreco != false && $verifyplataformarecarga != false){

                    
                        $res = \Painel::newproductvariacao(
                            $nomeproduto,
                            $preco,
                            $precopromotion,
                            $description,
                            $type,
                            $categorias,
                            $estoque,
                            $slug,
                            $foto,
                            $nomevariacao,
                            $typevariacao,
                            $qtdvariacao,
                            $precovariacao,
                            $plataformarecarga,
                            $objeto
                        );

                    }else{
                        $res = 'preench';
                    }


                    }else{
                        $res = 'preench';
                    }
                }else{
                    $res = 'preench';
                }
            }else{

                $res = \Painel::newproduct(
                    $nomeproduto,
                    $preco,
                    $precopromotion,
                    $description,
                    $type,
                    $categorias,
                    $estoque,
                    $slug,
                    $foto,
                    $objeto
                );
            }


            }


            

        }else{
            $res = false;
        }

        return $res;
        // echo json_encode($res);
    }



    public static function getImgProduct($idproduct,$type = "all")
    {

        if($type == "all"){

            $res =  \Painel::selectAllQuery('tb_admin.imgproducts',' WHERE id_produto = ?',array($idproduct));

                if(empty($res)){
                    $res = false;
                }
        }else{

            $res =  \Painel::select('tb_admin.imgproducts','id_produto = ?',array($idproduct));
            if(empty($res)){
                $res = array("img_produto"=>"");
            }

        }
        

        return $res;

    }


    public static function editItenCart($post, $itemid, $itemqtd,$type)
    {

        if($post == false){
            $res = false;

        }else if($post == true){
           
            if($type == 'plus'){

                $idProduto = explode(':', $itemid)[0];
                $variacao = explode(':', $itemid)[1];


                if(isset($_SESSION['carrinho']) == false){
                    $_SESSION['carrinho'] == array();
                }
     
    
                if(isset($_SESSION['carrinho'][$itemid]) == false){
                    $_SESSION['carrinho'][$itemid] = 1;
                }else{
                    $_SESSION['carrinho'][$itemid]+=1;
                }
                $totalItemCart = \FeaturesCart::getTotalItenCart();
                $totalAmount = \Painel::convertMoney(\FeaturesCart::getTotalAmount());
                $totalAmountPromotion = \Painel::convertMoney(\FeaturesCart::getTotalAmountPromotion());
                $totalPrecoItem = \Painel::convertMoney(\FeaturesCart::getTotalAmountItemOnCart($itemid));

                $res = array(true, $totalItemCart, $totalAmount, $totalAmountPromotion,$totalPrecoItem);

            }else{

           
                $idProduto = explode(':', $itemid)[0];
                $variacao = explode(':', $itemid)[1];


                if(isset($_SESSION['carrinho']) == false){
                    $_SESSION['carrinho'] == array();
                }
     
    
                if(isset($_SESSION['carrinho'][$itemid]) == false){
                    
                }else{
                    if($_SESSION['carrinho'][$itemid] == 1){
                        $_SESSION['carrinho'][$itemid] = 1;

                    }else{
                        $_SESSION['carrinho'][$itemid]-=1;
                    }
                    
                }
                $totalItemCart = \FeaturesCart::getTotalItenCart();
                $totalAmount = \Painel::convertMoney(\FeaturesCart::getTotalAmount());
                $totalAmountPromotion = \Painel::convertMoney(\FeaturesCart::getTotalAmountPromotion());
                $totalPrecoItem = \Painel::convertMoney(\FeaturesCart::getTotalAmountItemOnCart($itemid));

                $res = array(true, $totalItemCart, $totalAmount, $totalAmountPromotion,$totalPrecoItem);
            }
           

        }else{
            $res = false;
        }
        return $res;

    }

    public static function addItemToCart($post = false, $itemid = false, $itemqtd = false,$variacao = null)
    {
        if($post == false){
            if(isset($_GET['addCart'])){
                $idProduto = (int)$_GET['addCart'];
                if(isset($_SESSION['carrinho']) == false){
                    $_SESSION['carrinho'] = array();
                }


                if(isset($_GET['variacaoprod']))
                {
                    $variacao = (int)$_GET['variacaoprod'];
                }else{
                    $variacao = $variacao;
                }
                    

                    if(is_null($variacao)){

                        $indice = sprintf('%s:%s', (int)$idProduto, 0);
                    }else{

                        $indice = sprintf('%s:%s', (int)$idProduto, (int)$variacao);

                    }

                if(isset($_SESSION['carrinho'][$indice]) == false){
                    $_SESSION['carrinho'][$indice] = 1;
                }else{
                    $_SESSION['carrinho'][$indice]++;
                }
                $res = true;

                
            }else{
                $res = true;
            }
            return $res;
        }else if($post == true){


                
           
                $idProduto = (int)$itemid;
                if(!isset($_SESSION['carrinho'])){
                    $_SESSION['carrinho'] = array();
                }
     

                if(isset($_POST['variacaoprod']))
                {
                    $variacao = $_POST['variacaoprod'];
                }else{
                    $variacao = $variacao;
                }
                    

                    if(is_null($variacao)){

                        $indice = sprintf('%s:%s', (int)$idProduto, 0);
                    }else{

                        $indice = sprintf('%s:%s', (int)$idProduto, (int)$variacao);

                    }

                
                    if(isset($_SESSION['carrinho'][$indice])){
                        $_SESSION['carrinho'][$indice] += $itemqtd;
                    }else{
                        $_SESSION['carrinho'][$indice] = $itemqtd;
                    }
                // }else{

                //     if(isset($_SESSION['carrinho'][$idProduto])){
                //         $_SESSION['carrinho'][$idProduto]['quantidade'] += $itemqtd;
                //     }else{
                //         $_SESSION['carrinho'][$idProduto] = array('quantidade'=>$itemqtd);
                //     }

                // }

                $totalItemCart = \FeaturesCart::getTotalItenCart();
                $res = array(true, $totalItemCart);

                // $res = array(true,"");

        }else{
            $res = false;
        }
        return $res;

    }

    public static function getVariation($idvariation)
    {
        $res = \Painel::select('tb_admin.variacoes_produtos','id = ?',array($idvariation));
        return $res;
    }

    public static function getTotalAmount()
    {
        if(isset($_SESSION['carrinho'])){
            $itensCarrinho = $_SESSION['carrinho'];
            $totalCompra = 0;
            $descontoCompra = 0;
            foreach ($itensCarrinho as $key => $value) { 
                $idProduto = explode(':', $key)[0];
                $variacao = explode(':', $key)[1];
                // $idProduto = $key;

                if($variacao > 0){
                    $itemvariacao = \Painel::select('tb_admin.variacoes_produtos','id = ?',array($variacao));
                    $valor = $value * \Painel::getAmountReal('off','0',$itemvariacao['preco']);
                    $valorDesconto = $value * \Painel::getCalculateDesconto('off','0',$itemvariacao['preco'])[1];
                }else{

                    $item = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));
                    $valor = $value * \Painel::getAmountReal($item['status_promotion'],$item['value_promotion'],$item['value']);
                    $valorDesconto = $value * \Painel::getCalculateDesconto($item['status_promotion'],$item['value_promotion'],$item['value'])[1];
                
                }


                $descontoCompra+=$valorDesconto;
                $totalCompra+=$valor;
            }
            return $totalCompra;

        }else{
            return $totalCompra = 0;
        }
    }

    public static function getTotalAmountPromotion()
    {
        if(isset($_SESSION['carrinho'])){
            $itensCarrinho = $_SESSION['carrinho'];
            $totalCompra = 0;
            $descontoCompra = 0;
            foreach ($itensCarrinho as $key => $value) { 
                $idProduto = explode(':', $key)[0];
                $variacao = explode(':', $key)[1];

                if($variacao > 0){
                    $itemvariacao = \Painel::select('tb_admin.variacoes_produtos','id = ?',array($variacao));
                    $valor = $value * \Painel::getAmountReal('off','0',$itemvariacao['preco']);
                    $valorDesconto = $value * \Painel::getCalculateDesconto('off','0',$itemvariacao['preco'])[1];
                }else{

                    $item = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));
                    $valor = $value * \Painel::getAmountReal($item['status_promotion'],$item['value_promotion'],$item['value']);
                    $valorDesconto = $value * \Painel::getCalculateDesconto($item['status_promotion'],$item['value_promotion'],$item['value'])[1];
                
                }
                $descontoCompra+=$valorDesconto;
                $totalCompra+=$valor;
            }
            return $descontoCompra;

        }else{
            return $descontoCompra = 0;
        }
    }

    public static function getTotalAmountItemOnCart($itemid)
    {
        if(isset($_SESSION['carrinho'])){
            $itensCarrinho = $_SESSION['carrinho'];
            if(isset($itensCarrinho[$itemid]) != false){
                $qtdOfItem = (int)$itensCarrinho[$itemid];

                $idProduto = explode(':', $itemid)[0];
                $variacao = explode(':', $itemid)[1];

                if($variacao > 0){
                    $itemvariacao = \Painel::select('tb_admin.variacoes_produtos','id = ?',array($variacao));
                    $precoItem = \Painel::getAmountReal('off','0',$itemvariacao['preco']);
                }else{

                    $item = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));
                    $precoItem = \Painel::getAmountReal($item['status_promotion'],$item['value_promotion'],$item['value']);

                }

                
                $totalIten = $precoItem*$qtdOfItem;
            }

            
  
            return $totalIten;


        }else{
            return  0;
        }
    }

    public static function removeItemCart($itemid)
    {
        if(isset($_SESSION['carrinho'])){
            unset($_SESSION['carrinho'][$itemid]);
            $totalItenCart = \FeaturesCart::getTotalItenCart();
            $totalAmount = \Painel::convertMoney(\FeaturesCart::getTotalAmount());
            $totalAmountPromotion = \Painel::convertMoney(\FeaturesCart::getTotalAmountPromotion());

            $res = array(true,$totalItenCart,$totalAmount,$totalAmountPromotion);
        }else{
            $tes = array(false,"","","");
        }

        return $res;
        
    }

}

?>