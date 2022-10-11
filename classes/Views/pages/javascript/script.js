// const list = document.querySelectorAll('.list');
// function activeLink(){
//     list.forEach((item) => 
//         item.classList.remove('active'));
//         this.classList.add('active');
// }
// list.forEach((item) =>
// item.addEventListener('click',activeLink));



//<![CDATA[
    $(window).on('load', function () {
        $('#preloader .inner').fadeOut();
        $('#preloader').delay(10).fadeOut('slow'); 
        $('body').delay(10).css({'overflow': 'visible'});
      })
      //]]>


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
maskTelefone();

function maskTelefone()
{
    $('.tel-input').mask('(00) 0000-00009');
$('.tel-input').blur(function(event) {
   if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
      $('.tel-input').mask('(00) 00000-0009');
   } else {
      $('.tel-input').mask('(00) 0000-00009');
   }
});
}

function moneymask(){
    $('.moneyrs').maskMoney({
        prefix:'R$ ',
        allowNegative: true,
        thousands:'.', decimal:',',
        affixesStay: true
    });
}