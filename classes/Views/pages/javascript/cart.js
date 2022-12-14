$('body').on('click', '#add-product-plus', function () {
  const type = 'plus';
  const itemid = $(this).data("item");

  const ids = itemid.split(":");
  const classe = ".qtd-item"+ids[0]+"-"+ids[1];
  const itemqtd = Number($(classe).html());

  const urlStore = $("#urlDomain").data("url");
  const result = editItenCart(itemid,itemqtd,urlStore,type,ids[0],ids[1]);
  // if(result == true){
    const plus = itemqtd+1;
    $(classe).html(plus);
  // }
  
})

$('body').on('click', '#remove-product-minus', function () {
  const type = 'minus';
  const itemid = $(this).data("item");
 
  const ids = itemid.split(":");
  const classe = ".qtd-item"+ids[0]+"-"+ids[1];
  const itemqtd = $(classe).html();

  const urlStore = $("#urlDomain").data("url");
  const result = editItenCart(itemid,itemqtd,urlStore,type,ids[0],ids[1]);
  // if(result == true){
    if(itemqtd == 1){
      var plus = 1;
    }else{
      var plus = itemqtd-1;
    }
   
    $(classe).html(plus);

  // }


})



//DELETANDO ITEM DA PAGINA DE CARRINHO
$('body').on('click', '#delete-item-cart', function () {

  const itemid = $(this).data("item");
  const urlStore = $("#urlDomain").data("url");
  const ids = itemid.split(":");
  const classe = "#id-banner"+ids[0]+"-"+ids[1];

  $.ajax({
    method: "post",
    url: urlStore+'param/removeItemCart',
    data: {itemid:itemid},
    dataType: 'json',
    success: function (res) {
      if(res[0] == true){
        alertAtencao("Item deletado do carrinho.");


        if(res[1] > 0){
          $("#qtd-itens-header-cart").html("<span class='circle-qtd-itens-cart'>"+res[1]+"</span>");
        }else{
          $("#qtd-itens-header-cart").html("");
        }

        $("#total-amount").html(res[2]);
        $("#total-amount-promotion").html(res[3]);

      }else{
        alertErro("Houe algum erro, tente novamente...");

      }
    },
});
$(classe).remove();
  

})

// ADD ITEM AO CARRINHO
function editItenCart(itemid,itemqtd,urlStore,type,iditem,idvariacao) {

  $.ajax({
    method: "post",
    url: urlStore+'param/editItenCart',
    data: {itemqtd:itemqtd, itemid:itemid, type:type},
    dataType: 'json',
    success: function (res) {
      if(res[0] == true){
        if(res[1] > 0){
          $("#qtd-itens-header-cart").html("<span class='circle-qtd-itens-cart'>"+res[1]+"</span>");
        }else{
          $("#qtd-itens-header-cart").html("");
        }

        $("#total-amount").html(res[2]);
        $("#total-amount-promotion").html(res[3]);
        $("#total-amount-item"+iditem+"-"+idvariacao).html(res[4]);
        // alertSucesso("Item adicionado ao carrinho!")
        // var returno = true;
      }else{
        alertErro("Houe algum erro, tente novamente...")
        // retorno = false;
        
      }
      var retorno = res[0];
      // return retorno;
    },
});
  

}

$('body').on('click', '#go-back-for-page', function () {
  goBack();
})


function goBack() {
  window.history.back();
}



// FUN??ES PARA USAR GERALMENTE

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

// FIM DAS FUN??ES PARA USAR GERALMENTE