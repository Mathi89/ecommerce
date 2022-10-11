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

        <div class="grid-form-card">
            <input class="style-inputs-creditcard email-card" type="text" id="form-checkout__cardholderName" />
        </div>

        <div class="grid-form-card grid-card-thr">
            <input id="pgonenumber" class="style-inputs-creditcard tel-input" type="tel" placeholder="(00) 00000-0000" />
            <input type="text" id="form-checkout__identificationNumber" class="inputs-form-creditcard style-inputs-creditcard" />
        </div>

        <div class="grid-form-card">
            <input type="email" id="form-checkout__cardholderEmail" class="inputs-form-creditcard email-card style-inputs-creditcard" />
        </div>

        <div class="grid-form-card">
            <select class="select-card-parcelas style-inputs-creditcard" id="form-checkout__installments"></select>
        </div>
        <input type="hidden" value="CPF" id="form-checkout__identificationType">


        <button type="submit" id="form-checkout__submit">Pagar</button>
        <!-- <progress value="0" class="progress-bar">Carregando...</progress> -->
    </form>
</body>



<script>
    // const mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
    // const pageUrls = $("#checkout-title").data("url");
    // const totalAmount = $("#amount").data("amount");

    maskTelefone()
    mp = new MercadoPago(publickey);

    const cardForm = mp.cardForm({
        amount: valorcompra,
        iframe: false,
        identificationType: "CPF",
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
            identificationType: {
                id: "form-checkout__identificationType",
                placeholder: "Tipo de documento",
                value: "CPF",
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


                const cellphone = $("#pgonenumber").val();
                $.ajax({
                    url: pageUrls + 'param/payment',
                    method: "post",
                    dataType: "json",
                    data: {
                        issuer: issuer_id,
                        docNumber: identificationNumber,
                        docType: identificationType,
                        email: email,
                        token: token,
                        paymentMethodId: payment_method_id,
                        transactionAmount: Number(amount),
                        installments: Number(installments),
                        cellphone: cellphone
                    },
                    beforeSend: function() {
                        $(".content").fadeOut("slow").hide();
                    },
                    success: function(res) {
                        if (res[0] != "false") {

                            $.ajax({
                                    url: pageUrls + 'param/getItemCartForMsg',
                                    method: "post",
                                    dataType: "json",
                                    data: {
                                        reference_id: res[1],
                                        status: res[2],
                                        phone: res[3]
                                    },
                                    success: function(formsg) {

                                        if (formsg[0] == true) {
                                            $.ajax({
                                                url: url_bot + 'send-message',
                                                method: "post",
                                                dataType: "json",
                                                data: {
                                                    number: formsg[1],
                                                    message: formsg[2]
                                                },
                                                success: function() {
                                                    location.reload(true);
                                                },
                                                error: function() {
                                                    location.reload(true);
                                                },

                                            });
                                        }

                                    },
                                }),

                                $("#payofcardcredit").slideDown(1000, function() {
                                    $("#payofcardcredit").remove();
                                });

                        } else {
                            alertErro('Houve algum erro. Por favor tente novamente.');
                            $(".content").fadeIn("slow").show();

                        }



                        $("#MPHiddenInputToken").val("")

                    }
                })

            },
            onFetching: (resource) => {
                // console.log("Fetching resource: ", resource);

                // Animate progress bar
                // const progressBar = document.querySelector(".progress-bar");
                // progressBar.removeAttribute("value");

                // return () => {
                // progressBar.setAttribute("value", "0");
                // };
            }
        },
    });

    $('body').on('click', '#payofcardcredit', function(e) {

        $("#form-checkout__submit").trigger('click');
    })





    // FUNÕES PARA USAR GERALMENTE

    function alertErro(msg, temp = 3200, rl = false) {

        $('.erroJ').html(msg);
        $('.erroJ').slideDown();

        setTimeout(function() {
            $('.erroJ').slideUp();
            if (rl != false) {
                location.reload();
            }
        }, temp)
    }

    function alertSucesso(msg, temp = 3200, rl = false) {

        $('.sucessoJ').html(msg);
        $('.sucessoJ').slideDown();

        setTimeout(function() {
            $('.sucessoJ').slideUp();
            if (rl != false) {
                location.reload();
            }
        }, temp)
    }

    function alertAtencao(msg, temp = 3200, rl = false) {

        $('.atencaoJ').html(msg);
        $('.atencaoJ').slideDown();

        setTimeout(function() {
            $('.atencaoJ').slideUp();
            if (rl != false) {
                location.reload();
            }
        }, temp)
    }

    // FIM DAS FUNÕES PARA USAR GERALMENTE
</script>

</html>