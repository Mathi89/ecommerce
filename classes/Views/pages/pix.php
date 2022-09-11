
  <form id="form-checkout"  method="post">
    <div>
      <div class="grid-form-card grid-pix-space">
        <label for="payerFirstName">Nome</label>
        <input class="style-inputs-creditcard" id="form-checkout__payerFirstName" name="payerFirstName" type="text">
      </div>

      <div class="grid-form-card grid-pix-space">
        <label for="payerLastName">Sobrenome</label>
        <input class="style-inputs-creditcard" id="form-checkout__payerLastName" name="payerLastName" type="text">
      </div>

      <div class="grid-form-card grid-pix-space">
        <label for="email">E-mail</label>
        <input class="style-inputs-creditcard" id="form-checkout__email" name="email" type="text">
      </div>
    
      <div class="grid-form-card grid-pix-space">
        <label for="identificationNumber">Número do CPF</label>
        <input class="style-inputs-creditcard" id="form-checkout__identificationNumber" name="identificationNumber" type="text">
      </div>
    </div>

    <div>
   
    </div>
    <button id="testee" type="submit">Pagar</button>
  </form>
  

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    // const mp = new MercadoPago("TEST-6f2af98e-a0d5-405a-97ca-bddeea4ecfdf");
    // const pageUrls = $("#checkout-title").data("url");

    $("form#form-checkout").submit(function(e){
   e.preventDefault();

   const form = $(this);

      $.ajax({
        url: pageUrls+'param/paymentPix',
        method: "post",
        dataType: "html",
        data: form,
        success: function (res) {
            
            $(".content").html(res)
            
            
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

   

</script>