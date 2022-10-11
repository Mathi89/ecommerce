
  <form id="form-checkout"  method="post">
    <div>
      <div class="grid-form-card grid-pix-space">
        <label for="payerFirstName">Nome</label>
        <input class="style-inputs-creditcard" id="form-checkout__payerFirstName" name="payerFirstName" type="text">
      </div>

      <div class="grid-form-card grid-pix-space">
        <label for="email">Celular com DDD</label>
        <input class="style-inputs-creditcard tel-input" id="form-checkout__email" name="tel" type="text">
      </div>

      <!-- <div class="grid-form-card grid-pix-space">
        <label for="payerLastName">Sobrenome</label>
        <input class="style-inputs-creditcard" id="form-checkout__payerLastName" name="payerLastName" type="text">
      </div> -->

      <div class="grid-form-card grid-pix-space">
        <label for="email">E-mail</label>
        <input class="style-inputs-creditcard" id="form-checkout__email" name="email" type="text">
      </div>
    
      <!-- <div class="grid-form-card grid-pix-space">
        <label for="identificationNumber">Número do CPF</label>
        <input class="style-inputs-creditcard" id="form-checkout__identificationNumber" name="identificationNumber" type="text">
      </div> -->
    </div>

    <div>
   
    </div>
  </form>
  

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    // const mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
    // const pageUrls = $("#checkout-title").data("url");
    $('body').on('click', '#payofPix', function (e) {
   e.preventDefault();


   const form = $("#form-checkout")[0];
    var formData = new FormData(form);
    

      $.ajax({
        url: pageUrls+'param/paymentPix',
        method: "post",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {

          if(res[0] != "false"){

            $.ajax({
              url: pageUrls+'param/getItemCartForMsg',
              method: "post",
              dataType: "json",
              data: {reference_id : res[2], status:res[3], phone: res[4]},
              success: function (formsg) {

                if(formsg[0] == true){
                $.ajax({
                    url: url_bot+'send-message',
                    method: "post",
                    dataType: "json",
                    data: {number:formsg[1], message:formsg[2]},
                    success: function () {
                      location.reload(true);
                    },
                    error: function () {
                      location.reload(true);
                    },

                });
              }

              },
            }),
              $(".content").hide().html(res[1]).fadeIn('slow');
              $("#payofPix").slideDown(1000, function() {
                $("#payofPix").remove();
              });
              $(".btn-payment-checkout span").html("")
              $("#payNow").attr('id','');
          }else{
            alertErro("Por favor preencha todos os campos corretamente e tente novamente.")
          }
            
           
            
            
        }
    })

    })
    

    // (async function getIdentificationTypes(e) {
    //   e.preventDefault();
    //   try {
    //     const identificationTypes = await mp.getIdentificationTypes();
    //     const identificationTypeElement = document.getElementById('form-checkout__identificationType');

    //     createSelectOptions(identificationTypeElement, identificationTypes);
    //   } catch (e) {
    //     return console.error('Error getting identificationTypes: ', e);
    //   }
    // })();

    // function createSelectOptions(elem, options, labelsAndKeys = { label: "name", value: "id" }) {
    //   const { label, value } = labelsAndKeys;

    //   elem.options.length = 0;

    //   const tempOptions = document.createDocumentFragment();

    //   options.forEach(option => {
    //     const optValue = option[value];
    //     const optLabel = option[label];

    //     const opt = document.createElement('option');
    //     opt.value = optValue;
    //     opt.textContent = optLabel;

    //     tempOptions.appendChild(opt);
    //   });

    //   elem.appendChild(tempOptions);
    // }

   
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

</script>