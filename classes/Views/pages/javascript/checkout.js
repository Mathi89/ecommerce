// const mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
const urlStore = $("#checkout-title").data("url");
const publickey = $("#checkout-title").data("publickey");
 mp = new MercadoPago(publickey);
const pageUrls = $("#checkout-title").data("url");
const totalAmount = $("#amount").data("amount");
const valorcompra =  $("#valorcompra").data("preco").toString();

$('body').on('click', '#copiar-qrcode', function (e) {

    $('#qrcode-text').val();
    $('#qrcode-text').select();
    document.execCommand('copy');
    alertSucesso("Qr code copiado!");

    
})

$('body').on('click', '#go-back-for-page', function () {
    goBack();
  })
  
  
  function goBack() {
    window.history.back();
  }
  

$('body').on('click', '#payNow', function (e) {
    const pagePagto = $(this).data("url");
    const typePagto = document.querySelector('input[name="typepayment"]:checked').value;
    const cardpix = ".select-type-payment-pix";
    const cardcredtcard = ".select-type-payment-credtcard";
    
    

//0 = PIX
//1 = CARTÃO DE CREDITO

// alert(typePagto)

            

if(typePagto == "creditCard"){

    $(".btn-payment-checkout span").html("Pagar Agora")
    $("#payNow").attr('id','payofcardcredit');

    const page = pagePagto+typePagto+".php"
    $(cardpix).slideUp(1000, function() {
        $(cardpix).remove();
    });
    
    $.ajax({
        method: "POST",
        dataType: 'html',
        url: page, //link da pagina que o ajax buscará
        cache: false,
        success: function(data)
        {
            
            $(".content").html(data).fadeIn(340); //Inserindo o retorno da pagina ajax
            
        },
        error: function(data){
            $(".content").html("<center><p>ERRO ao carregar outra pagina</p></center>").fadeIn(300); //Em caso de erro ele exibe esta mensagem
        }
    });	
   
    
}else if(typePagto == "pix"){

    $(cardcredtcard).slideUp(1000, function() {
        $(cardcredtcard).remove();
    });

    $(".btn-payment-checkout span").html("Pagar Agora")
    $("#payNow").attr('id','payofPix');

    const page = pagePagto+typePagto+".php"

    $.ajax({
        method: "POST",
        dataType: 'html',
        url: page, //link da pagina que o ajax buscará
        cache: false,
        success: function(data)
        {
            
            $(".content").html(data).fadeIn(340)
            maskTelefone() //Inserindo o retorno da pagina ajax
        },
        error: function(data){
            $(".content").html("<center><p>ERRO ao carregar outra pagina</p></center>").fadeIn(300); //Em caso de erro ele exibe esta mensagem
        }
    });	
}

})
// else{
    
//     $(".space-form-card").css("display","block");
//     $(".space-form-pix").css("display","none");
    

//     $.ajax({
//         method: "post",
//         url: urlStore+'param/getFormcard',
//         data: {pix:"pix"},
//         dataType: 'html',
//         success: function (res) {
            
//         //   $(".space-form").html(res)
          
          
          
//         },
//     });
    

  
// }

function teste(){
    cardForm = mp.cardForm({
        amount: "100.50",
        iframe: true,
        form: {
        id: "form-checkout",
        cardNumber: {
            id: "form-checkout__cardNumber",
            placeholder: "Número do cartão",
        },
        expirationDate: {
            id: "form-checkout__expirationDate",
            placeholder: "MM/YY",
        },
        securityCode: {
            id: "form-checkout__securityCode",
            placeholder: "Código de segurança",
        },
        cardholderName: {
            id: "form-checkout__cardholderName",
            placeholder: "Titular do cartão",
        },
        issuer: {
            id: "form-checkout__issuer",
            placeholder: "Banco emissor",
        },
        installments: {
            id: "form-checkout__installments",
            placeholder: "Parcelas",
        },        
        identificationNumber: {
            id: "form-checkout__identificationNumber",
            placeholder: "Número do cpf",
        },
        cardholderEmail: {
            id: "form-checkout__cardholderEmail",
            placeholder: "E-mail",
        },
        },
        callbacks: {
        onFormMounted: error => {
            if (error) return console.warn("Form Mounted handling error: ", error);
            console.log("Form mounted");
        },
    
        onSubmit: event => {
            event.preventDefault();
    
            const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
            } = cardForm.getCardFormData();
    
                
    
            $.ajax({
            url: pageUrls+'param/payment',
            method: "post",
            dataType: "json",
            data: {issuer:issuer_id, docNumber:identificationNumber, docType:identificationType, email:email, token:token, paymentMethodId:payment_method_id, transactionAmount: Number(amount), installments: Number(installments)},
            success: function (res) {
                if(res['status'] == 'approved'){
                $(".return").html("Pagamento Aprovado!")
                }else{
                $(".return").html("Algo ocorreu")
                }
                $("#MPHiddenInputToken").val("")
                
            }
        })
        
        },
        onFetching: (resource) => {
            console.log("Fetching resource: ", resource);
    
            // Animate progress bar
            const progressBar = document.querySelector(".progress-bar");
            progressBar.removeAttribute("value");
    
            return () => {
            progressBar.setAttribute("value", "0");
            };
        }
        },
        });
}




 
// FUNÕES PARA USAR GERALMENTE

function alertErro(msg,temp = 3200,rl = false){

    $('.erroJ').html(msg);
    $('.erroJ').slideDown();
    
    setTimeout(function () {
        $('.erroJ').slideUp();
        if(rl != false){location.reload();}
    }, temp)
    }
    
    function alertSucesso(msg,temp = 3200,rl = false){
    
    $('.sucessoJ').html(msg);
    $('.sucessoJ').slideDown();
    
    setTimeout(function () {
        $('.sucessoJ').slideUp();
        if(rl != false){location.reload();}
    }, temp)
    }
    function alertAtencao(msg,temp = 3200,rl = false){
    
    $('.atencaoJ').html(msg);
    $('.atencaoJ').slideDown();
    
    setTimeout(function () {
        $('.atencaoJ').slideUp();
        if(rl != false){location.reload();}
    }, temp)
    }
    
    // FIM DAS FUNÕES PARA USAR GERALMENTE
