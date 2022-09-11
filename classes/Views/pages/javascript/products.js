/* FAZENDO SLIDE DOS PRODUTOS */

$('.space-img-product-page').slick({
    centerMode: false,
    arrows: false,
    dots: true,
    infinite: false,

});

var allRadios = document.getElementsByName('nome');
var booRadio;
var x = 0;
for (x = 0; x < allRadios.length; x++) {

  allRadios[x].onclick = function() {
    if (booRadio == this) {
      this.checked = false;
      booRadio = null;
    } else {
      booRadio = this;
    }
  };
}


$('body').on('click', '#add-product-plus', function () {
  const itemqtd = parseInt($("#qtd-tem").html());
  const plus = itemqtd+1;
  $("#qtd-tem").html(plus);
})

$('body').on('click', '#remove-product-minus', function () {
  const itemqtd = parseInt($("#qtd-tem").html());
  if(itemqtd == 1){
    var plus = 1;
  }else{
    var plus = itemqtd-1;
  }
 
  $("#qtd-tem").html(plus);

})

// ADD ITEM AO CARRINHO
$('body').on('click', '#addItemToCart', function () {
    
    const itemqtd = parseInt($("#qtd-tem").html());
    const itemid = parseInt($("#qtd-tem").data("item"));
    const urlStore = $("#title-page").data("url");
    const titleProduct = urlStore.split('/');

    $.ajax({
      method: "post",
      url: urlStore+'param/addItemToCart',
      data: {itemqtd:itemqtd, itemid:itemid},
      dataType: 'json',
      success: function (res) {
        if(res[0] == true){
          $("#qtd-itens-header-cart").html("<span class='circle-qtd-itens-cart'>"+res[1]+"</span>")
          // $(".circle-qtd-itens-cart").html(res[1]);
          alertSucesso("Item adicionado ao carrinho!")
        }else{
          alertErro("Houe algum erro, tente novamente...")
        }
      },
  });
    
    
})

// ATUANDO NA PAGINA COM JQUERY

$('body').on('click', '#go-back-for-page', function () {
  goBack();
})


function goBack() {
  window.history.back();
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