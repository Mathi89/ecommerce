<?php
class Pay
{

    public static function paymentCreditCard($totalCompra,$token,$description,$parcelas,$payment_method_id,$issuer_id,$email,$tipoDocumento,$numeroDocumento)
    {

        MercadoPago\SDK::setAccessToken(ACESS_TOKEN);
        

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float)$totalCompra;  //VALOR DA COMPRA
        $payment->token = $token;
        $payment->description = "teste aqui";
        $payment->installments = (int)$parcelas;
        $payment->payment_method_id = $payment_method_id;
        $payment->issuer_id = (int)$issuer_id;

        $payer = new MercadoPago\Payer();
        $payer->email = $email;
        $payer->identification = array(
            "type" => 'CPF',
            "number" => $numeroDocumento
        );
        $payment->payer = $payer;

        $payment->save();
        // var_dump($payment);
            $response = array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id,
                'client' => $payment->payer->id
            );
            echo json_encode($response);
    }

    // public static function paymentPix($valorCompra, $titulo, $email, $fname, $lname, $cpf)
    public static function paymentPix()
    {
        MercadoPago\SDK::setAccessToken(ACESS_TOKEN);

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = 100 /* $valorCompra */;
        $payment->description = '$titulo';
        $payment->payment_method_id = "pix";
        $payment->payer = array(
            "email" => 'mateusponto1003@gmail.com',
            "first_name" => 'Mateus',
            "last_name" => 'Santos',
            "identification" => array(
                "type" => "CPF",
                "number" => '23935032854'
             )/* ,
            "address"=>  array(
                "zip_code" => "06233200",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "3003",
                "neighborhood" => "Bonfim",
                "city" => "Osasco",
                "federal_unit" => "SP"
             ) */
          );
       
        $payment->save();

            $status = $payment->status;
            $status_detail = $payment->status_detail;
            $id = $payment->id;
            $qrcodecopy = $payment->point_of_interaction->transaction_data->qr_code;
            $qrcodeimg = $payment->point_of_interaction->transaction_data->qr_code_base64;
 

        
        echo \Pay::getQrCodePix($qrcodeimg, $qrcodecopy);

    }

    public static function getQrCodePix($qrcodeimg,$qrcodecopy)
    {

        $htmlQrCode = '
        
            
            <img class="img-qrcode-pix" src="data:image/jpeg;base64,'.$qrcodeimg.'"/>

            <label for="copiar">Copiar Hash:</label>
            <input type="text" id="copiar"  value="'.$qrcodecopy.'"/>


        
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

?>