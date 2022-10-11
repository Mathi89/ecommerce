<?php
class Pay
{

    public static function paymentCreditCard($totalCompra, $token, $description, $parcelas, $payment_method_id, $issuer_id, $email, $tipoDocumento, $numeroDocumento, $cellphone)
    {

        $cellphone = \Painel::getCellPhoneNumber($cellphone);
        MercadoPago\SDK::setAccessToken(ACESS_TOKEN);

        $reference_id = uniqid();
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float)$totalCompra;  //VALOR DA COMPRA
        $payment->token = $token;
        $payment->description = NOME_EMPRESA;
        $payment->installments = (int)$parcelas;
        $payment->payment_method_id = $payment_method_id;
        $payment->issuer_id = (int)$issuer_id;
        $payment->notification_url = INCLUDE_PATH . "notification";
        $payment->external_reference = $reference_id;

        $payer = new MercadoPago\Payer();
        $payer->email = $email;
        $payer->identification = array(
            "type" => 'CPF',
            "number" => $numeroDocumento
        );
        $payment->payer = $payer;

        $payment->save();

        $erro = $payment->error;
        // var_dump($payment);
        if ($erro == null) {
            // var_dump($payment);

            $status = $payment->status;
            $status_detail = $payment->status_detail;
            $id_pedido = $payment->id;
            $client = $payment->payer->id;

            $insert = \Pay::insertBDPedido($email, $reference_id, $status, $id_pedido, $cellphone);
            if ($insert) {
                unset($_SESSION['carrinho']);
                // return $insert;
            }
            echo json_encode(array('true', $reference_id, $status, $cellphone));
        } else {
            echo json_encode(array('false', "", "", ""));
        }
    }

    public static function paymentPix($valorCompra, $titulo, $celular, $fname, $email/* , $lname, $cpf */)
    {

        if (!empty($valorCompra) && !empty($titulo) && !empty($celular) && !empty($fname) &&  !empty($email) /*  && !empty($lname) && !empty($cpf) */) {


            $tel = \Painel::getCellPhoneNumber($celular);

            MercadoPago\SDK::setAccessToken(ACESS_TOKEN);

            $reference_id = uniqid();
            $payment = new MercadoPago\Payment();
            $payment->transaction_amount = $valorCompra /* $valorCompra */;
            $payment->description = NOME_EMPRESA;
            $payment->payment_method_id = "pix";
            $payment->notification_url = INCLUDE_PATH . "notification";
            $payment->external_reference = $reference_id;
            // $payment->phone = array(
            //             "area_code" => '11',
            //             "number" => '958553086'
            // );
            $payment->payer = array(
                // "phone" => $celular,
                "email" => $email,
                "first_name" => $fname,

            );




            $payment->save();
            // var_dump($payment);
            $erro = $payment->error;

            if ($erro == null) {

                $status = $payment->status;
                $status_detail = $payment->status_detail;
                $id_pedido = $payment->id;
                $qrcodecopy = $payment->point_of_interaction->transaction_data->qr_code;
                $qrcodeimg = $payment->point_of_interaction->transaction_data->qr_code_base64;

                $insert = \Pay::insertBDPedido($email, $reference_id, $status, $id_pedido, $tel);
                if ($insert) {
                    unset($_SESSION['carrinho']);
                    // return $insert;
                }
                //    echo '<print>'; print_r($payment); echo'</print>';
                $qrcodegerado = \Pay::getQrCodePix($qrcodeimg, $qrcodecopy);

                echo json_encode(array('true', $qrcodegerado, $reference_id, $status, $tel));
            } else {
                echo json_encode(array('false', "", "", ""));
            }
        } else {
            echo json_encode(array('false', "", "", ""));
        }
    }

    public static function insertBDPedido($email = null, $reference_id, $status, $id_pedido, $celular)
    {


        if (isset($_SESSION['carrinho'])) {
            $totalcompra = \FeaturesCart::getTotalAmount();
            $totaldesconto = \FeaturesCart::getTotalAmountPromotion();
            $itensCarrinho = $_SESSION['carrinho'];


            // VALIDANDO SE O STATUS ESTÁ APROVADO PARA ALTERAR O HISTORICO DE ENTREGA PARA ENTREGADO

            // var_dump($itensCarrinho);]
            $codigo = [];
            foreach ($itensCarrinho as $key => $value) {
                $idProduto = explode(':', $key)[0];
                $variacao = explode(':', $key)[1];
                // $idProduto = $key;
                if (isset($_SESSION['id_user'])) {
                    $iduser = $_SESSION['id_user'];
                } else {
                    $iduser = null;
                }
                if ($variacao > 0) {
                    $produto = \Painel::select('tb_admin.store_products', 'id = ?', array($idProduto));
                    $produtoprecos = \Painel::select('tb_admin.variacoes_produtos', 'id = ?', array($variacao));
                    $idvariacao = $produtoprecos['id'];

                    $qtd_iten = $produtoprecos['qtd_itens'];
                    $plataforma = $produtoprecos['plataforma'];
                    $tipo = $produtoprecos['type'];



                    /* INSERINDO NO BD SENDO UM PRODUTO COM VARIAÇÃO */
                    $idproduto = $produto['id'];
                    $idvariacao = $idvariacao;
                    $iduser = $iduser;
                    $email = $email;
                    $reference_id = $reference_id;
                    $produto_type = $produto['type'];
                    $totalcompra = $totalcompra;
                    $totaldesconto = $totaldesconto;
                    $qtd = $value;
                    $datahora = date("Y-m-d H:i:s");
                    $status = $status;


                    $arr = array(
                        'nome_tabela' => 'tb_admin.pedidos',
                        'id_produto' => $idproduto,
                        'produto_type' => $produto_type,
                        'id_variacao' => $idvariacao,
                        'id_itemcombo' => "0",
                        'id_user' => $iduser,
                        'email_user' => $email,
                        'phone' => $celular,
                        'reference_id' => $reference_id,
                        'id_pedido' => $id_pedido,
                        'total_compra' => $totalcompra,
                        'total_desconto' => $totaldesconto,
                        'qtd_item' => $qtd,
                        'data_hora' => $datahora,
                        'status' => $status,
                        'historico_envio' => 'Aguardando'
                    );

                    $res = \Painel::insert($arr);


                    // }
                } else {

                    $produto = \Painel::select('tb_admin.store_products', 'id = ?', array($idProduto));
                    $object = $produto['objeto'];

                    if ($object == "combo") {
                        $getcombo = \Painel::selectAllQuery('tb_admin.combos_itens', ' WHERE id_produto = ?', array($idProduto));

                        foreach ($getcombo as $key => $itemcombof) {


                            // INSERINDO NO BD COM PRODUTO SENDO COMBO
                            $idproduto = $idProduto;
                            $idvariacao = "0";
                            $iditemcombo = $itemcombof['id'];
                            $iduser = $iduser;
                            $email = $email;
                            $reference_id = $reference_id;
                            $produto_type = $produto['type'];
                            $totalcompra = $totalcompra;
                            $totaldesconto = $totaldesconto;
                            $qtd = $value;
                            $datahora = date("Y-m-d H:i:s");
                            $status = $status;


                            $arr = array(
                                'nome_tabela' => 'tb_admin.pedidos',
                                'id_produto' => $idproduto,
                                'produto_type' => $produto_type,
                                'id_variacao' => $idvariacao,
                                'id_itemcombo' => $iditemcombo,
                                'id_user' => $iduser,
                                'email_user' => $email,
                                'phone' => $celular,
                                'reference_id' => $reference_id,
                                'id_pedido' => $id_pedido,
                                'total_compra' => $totalcompra,
                                'total_desconto' => $totaldesconto,
                                'qtd_item' => $qtd,
                                'data_hora' => $datahora,
                                'status' => $status,
                                'historico_envio' => 'Aguardando'
                            );

                            $res = \Painel::insert($arr);
                        }
                    } else {
                        $idvariacao = 0;

                        $idproduto = $produto['id'];
                        $idvariacao = "0";
                        $iditemcombo = "0";
                        $iduser = $iduser;
                        $email = $email;
                        $reference_id = $reference_id;
                        $produto_type = $produto['type'];
                        $totalcompra = $totalcompra;
                        $totaldesconto = $totaldesconto;
                        $qtd = $value;
                        $datahora = date("Y-m-d H:i:s");
                        $status = $status;


                        $arr = array(
                            'nome_tabela' => 'tb_admin.pedidos',
                            'id_produto' => $idproduto,
                            'produto_type' => $produto_type,
                            'id_variacao' => $idvariacao,
                            'id_itemcombo' => $iditemcombo,
                            'id_user' => $iduser,
                            'email_user' => $email,
                            'phone' => $celular,
                            'reference_id' => $reference_id,
                            'id_pedido' => $id_pedido,
                            'total_compra' => $totalcompra,
                            'total_desconto' => $totaldesconto,
                            'qtd_item' => $qtd,
                            'data_hora' => $datahora,
                            'status' => $status,
                            'historico_envio' => 'Aguardando'
                        );

                        $res = \Painel::insert($arr);
                    }
                }

                // $produto = \Painel::select('tb_admin.store_products','id = ?',array($idProduto));







            }

            return $res;
        }
    }

    public static function getItemCartForMsg($reference_id, $status, $phone, $atualiza = false)
    {
        $selhistoric = \Painel::select('tb_admin.pedidos', 'reference_id = ?', array($reference_id));
        $hitoricAtual = $selhistoric['historico_envio'];
        if ($status == "approved" && $hitoricAtual != "Entregado") {
            $phone = \Painel::getCellPhoneNumber($phone);

            $itenspedido = \Painel::selectAllQuery('tb_admin.pedidos', 'WHERE reference_id = ?', array($reference_id));

            $codigo = array();
            foreach ($itenspedido as $key => $value) {


                $id_pedido = $value['reference_id'];
                // $idProduto = $key;
                if ($value['id_variacao'] > 0 && $value['id_itemcombo']  < 1) {

                    $variacao = $value['id_variacao'];
                    $produtoprecos = \Painel::select('tb_admin.variacoes_produtos', 'id = ?', array($variacao));

                    $qtd_iten = $produtoprecos['qtd_itens'] * $value['qtd_item'];
                    $plataforma = $produtoprecos['plataforma'];
                    $tipo = $produtoprecos['type'];

                    for ($i = 0; $i < $qtd_iten; $i++) {

                        $getcodigo = \Painel::select('tb_admin.estoque_recarga', 'type = ? AND status = ? AND plataforma = ?', array($tipo, 'on', $plataforma));
                        $codigo[] = $getcodigo['codigo'] . ":::" . $getcodigo['plataforma'] . ":::" . $tipo;

                        $arrup = array(
                            'nome_tabela' => 'tb_admin.estoque_recarga',
                            'id' => $getcodigo['id'],
                            'status' => 'off'
                        );
                        $update = \Painel::update($arrup);
                    }
                } else if ($value['id_itemcombo'] > 0 && $value['id_variacao'] < 1) {


                    $id_combo = $value['id_itemcombo'];
                    $produto = \Painel::select('tb_admin.combos_itens', 'id = ?', array($id_combo));

                    $qtd_iten = $produto['qtd_itens'] * $value['qtd_item'];
                    $plataforma = $produto['plataforma'];
                    $tipo = $produto['type'];
                    for ($i = 0; $i < $qtd_iten; $i++) {

                        $getcodigo = \Painel::select('tb_admin.estoque_recarga', 'type = ? AND status = ? AND plataforma = ?', array($tipo, 'on', $plataforma));
                        $codigo[] = $getcodigo['codigo'] . ":::" . $getcodigo['plataforma'] . ":::" . $tipo;

                        $arrup = array(
                            'nome_tabela' => 'tb_admin.estoque_recarga',
                            'id' => $getcodigo['id'],
                            'status' => 'off'
                        );
                        $update = \Painel::update($arrup);
                    }
                }
            }  /* FINAL DO FOREACH */
            // var_dump($codigo);

            $codigotext = '';
            $pularline = 0;
            foreach ($codigo as $key => $value) {
                $extract = explode(':::', $value);

                $codigoo = $extract[0];
                $abreplatafor = $extract[1];
                $tempo = $extract[2];

                $plata = /* \Painel::$plataforma[$abreplatafor]; */ \Painel::getNameRecarga($abreplatafor);


                $pularline++;

                if ($pularline > 1) {
                    $codigotext .= "\n" . $plata . " 👉 " . $codigoo . " - " . $tempo;
                } else {
                    $codigotext = $plata . " 👉 " . $codigoo . " - " . $tempo;
                }
            }

            $msg = 'Opaa parabens, voce acabou de fazer sua compra! *Pedido: ' . $id_pedido . '*. Segue abaixo a lista dos seus códigos!.' . "\n\n" . $codigotext . "\n" . 'Muito obrigado, conte conosco sempre que precisar!.';

            // unset($_SESSION['carrinho']);
            \Pay::updateEnvioPedido($reference_id, "Entregado");

            $res = array(true, $phone, $msg);
        } else {

            $res = array(false, "", "");
        }

        if ($atualiza == false) {
            echo json_encode($res);
        } else {
            return $res;
        }
    }

    public static function updateEnvioPedido($reference, $status)
    {

        $up = \MySql::conectar()->prepare("UPDATE `tb_admin.pedidos` SET historico_envio = ? WHERE reference_id = ?");
        if ($up->execute(array($status, $reference))) {
            return true;
        } else {
            return false;
        }
    }

    public static function getQrCodePix($qrcodeimg, $qrcodecopy)
    {

        $htmlQrCode = '
        
            
            <img class="img-qrcode-pix" src="data:image/jpeg;base64,' . $qrcodeimg . '"/>

            <div class="input-copia">
            
            <label class="label-copia" for="copiar">Copia e Cola:</label>
            <div class="space-input-copia">
            <label id="copiar-qrcode" class="label-copia-click">Copiar</label>
            <input class="input-copia" type="text" id="qrcode-text"  value="' . $qrcodecopy . '"/>
            </div>
            
            </div>
            


        
        ';

        return $htmlQrCode;
    }

    public static function getFormcard()
    {

        $formCard = '

        <form id="form-checkout-card">
            <div id="form-checkout__cardNumber" class="container"></div>
            <div id="form-checkout__expirationDate" class="container"></div>
            <div id="form-checkout__securityCode" class="container"></div>
            <input type="text" id="form-checkout__cardholderName" />
            <select id="form-checkout__issuer"></select>
            <select id="form-checkout__installments"></select>
            <select id="form-checkout__identificationType"></select>
            <input type="text" id="form-checkout__identificationNumber" />
            <input type="email" id="form-checkout__cardholderEmail" />

            <button type="submit" id="form-checkout__submit">Pagar</button>
            <progress value="0" class="progress-bar">Carregando...</progress>
        </form>
        
        ';
        return $formCard;
    }
}
