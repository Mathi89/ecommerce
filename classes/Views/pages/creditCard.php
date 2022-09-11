<html>
    <body>
                <form id="form-checkout">
            <div class="grid-form-card grid-card-f">
                <input id="form-checkout__cardNumber" class="container inputs-form-creditcard style-inputs-creditcard"></input>
                <input id="form-checkout__expirationDate" class="container inputs-form-creditcard style-inputs-creditcard"></input>
            </div>

            <div class="grid-form-card grid-card-scd">
                <input id="form-checkout__securityCode" class="container inputs-form-creditcard style-inputs-creditcard"></input>
                <select class="style-inputs-creditcard" id="form-checkout__issuer"></select>
            </div>

            <div class="grid-form-card grid-card-thr">
                <input class="style-inputs-creditcard" type="text" id="form-checkout__cardholderName" />
                <input type="text" id="form-checkout__identificationNumber" class="inputs-form-creditcard style-inputs-creditcard" />
            </div>

            <div class="grid-form-card">
                <input type="email" id="form-checkout__cardholderEmail" class="inputs-form-creditcard email-card style-inputs-creditcard" />
            </div>

            <div class="grid-form-card">
                <select class="select-card-parcelas style-inputs-creditcard" id="form-checkout__installments"></select>   
            </div>
            

            <button type="submit" id="form-checkout__submit">Pagar</button>
            <progress value="0" class="progress-bar">Carregando...</progress>
        </form>
    </body>

    

<script>
    
    // const mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
    // const pageUrls = $("#checkout-title").data("url");
    // const totalAmount = $("#amount").data("amount");
    
  
    mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
    formPayment()
    function formPayment(){
   
    const cardForm = mp.cardForm({
        amount: valorcompra,
        iframe: false,
        identificationType : "CPF",
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
            identificationType
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
</script>
</html>
