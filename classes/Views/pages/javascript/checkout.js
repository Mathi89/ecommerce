// const mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
const urlStore = $("#checkout-title").data("url");
 mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
const pageUrls = $("#checkout-title").data("url");
const totalAmount = $("#amount").data("amount");
const valorcompra =  $("#valorcompra").data("preco").toString();





$('body').on('click', '#payNow', function (e) {
    const pagePagto = $(this).data("url");
    const typePagto = document.querySelector('input[name="typepayment"]:checked').value;
    
    

//0 = PIX
//1 = CARTÃO DE CREDITO

// alert(typePagto)

            

if(typePagto == "creditCard"){
    const page = pagePagto+typePagto+".php"
    
    $.ajax({
        method: "get",
        dataType: 'html',
        url: page, //link da pagina que o ajax buscará
        cache: false,
        success: function(data)
        {
            
            $(".content").load(page) //Inserindo o retorno da pagina ajax
            
        },
        error: function(data){
            $(".content").html("<center><p>ERRO ao carregar outra pagina</p></center>").fadeIn(300); //Em caso de erro ele exibe esta mensagem
        }
    });	
   
    
}else if(typePagto == "pix"){

    const page = pagePagto+typePagto+".php"

    $.ajax({
        method: "get",
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





