/**
 * Created by carlos on 19/03/17.
 */
$('.btn-search').on('click',function () {
   var cpf = document.getElementById('cpf').value;
    var tabela = $("#tabela");
   $.post('function/contrato.php',
       {
           'observacao' : cpf,
           'acao'       : 'P'
       },
       function(data){
          // alert('Data:'+data);
           if(data == ''){
               errosend('Dados n&atilde;o localizados');
           }else {
               tabela.find('table').remove();
               tabela.append(data);
           }
           //tabela.innerHTML = data;
       });
      return false;

});

$(document).ready(function(){
    $('#cpf').mask('000.000.000-00');

});

function carregando(){
    var mensagem = $('.mensagem');
    //alert('Carregando: '+mensagem);
    mensagem.empty().html('<p class="alert alert-warning"><img src="images/loading.gif" alt="Carregando..."> Verificando dados!</p>').fadeIn("fast");
    setTimeout(function (){

    },300);

}

function errosend(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>'+msg+'</p>').fadeIn("fast");
}

$('#cpf').on('keyup',function () {
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert "></p>');
});


$(document).keypress(function (e) {
    if(e.which == 13)
        $('.btn-search').click();
});

function mensalidade (contrato, cliente, url) {
   //alert('URL: '+url);
   var form = $('<form method="post" action="'+url+'">'+
               '<input type="hidden" name="contrato" value="'+contrato+'">'+
               '<input type="hidden" name="cliente"  value="'+cliente+'">'+
               '</form>');
   $('body').append(form);
   form.submit();
}

function verificaStatus(nome){
    //alert('Verificastatus: '+nome);
    if(nome.form.tudo.checked == 1)
    {
        console.log('Marcar todos');
        nome.form.tudo.checked = 1;
        marcarTodos(nome);
    }
    else
    {
        console.log('Desmarcar todos');
        nome.form.tudo.checked = 0;
        desmarcarTodos(nome);
    }
}

function marcarTodos(nome){
    for (i=0;i<nome.form.elements.length;i++)
        if(nome.form.elements[i].type == "checkbox")
            nome.form.elements[i].checked=1
}

function desmarcarTodos(nome){
    for (i=0;i<nome.form.elements.length;i++)
        if(nome.form.elements[i].type == "checkbox")
            nome.form.elements[i].checked=0
}

$('.btn-pgto').on('click', function () {


    var valor       = $(this).data('valor');
    var valorEnviar = $(this).data('valor1');
    var contrato    = $(this).data('contrato');
    var parcela     = $(this).data('parcela');
    var vencimento  = $(this).data('vencimento');
    //alert('Click '+valorEnviar);
    $('span.nome').text(valor);
    $('.pay-yes').on('click', function () {
       registrar_pagamento(parcela, vencimento, contrato, valorEnviar);
    });
});

function registrar_pagamento(parcela, vencimento, contrato, valor) {
   var dataAtual = new Date();
   $.ajax({
       dataType: 'json',
       type: "POST",
       url: "function/contratomensal.php",
       beforeSend: carregando,
       data: {
           'parcela'    : parcela,
           'vencimento' : vencimento,
           'contrato'   : contrato,
           'valor'      : valor,
           'data'       : dataAtual,
           'acao'       : 'P'
       },
       success: function( data )
       {
           console.log("Pagamento: "+data.retorno);
           if(data.retorno == 1){
               $('#pagamento-modal').modal('hide');
               sucesso('Pagamento Efetuado com sucesso. Recarregando');
           }else if(data.retorno == 0){
               errosend('N&atilde;o foi poss&iacute;vel executar opera&ccedil;&atildeo');
           }
       }
   });
}

function sucesso(msg){
    //alert("Mensagem: "+msg);
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.reload();
    },2000);
}

$('.btn-boleto').on('click',function () {
   // alert('Boleto');
    var valor = $(this).data('valor');
    var vencimento = $(this).data('vencimento');
    var cliente    = $(this).data('cliente');
    var banco      = $(this).data('banco');
    var contrato    = $(this).data('contrato');
    var parcela    = $(this).data('parcela');
    //alert('Contrato: '+contrato);
    var form = $('<form action="boleto/boleto_'+banco+'.php" method="post">' +
                '<input type="hidden" name="valor" value="'+valor+'"/>'+
                '<input type="hidden" name="vencimento" value="'+vencimento+'"/>'+
                '<input type="hidden" name="cliente" value="'+cliente+'"/>'+
                '<input type="hidden" name="contrato" value="'+contrato+'"/>'+
                '<input type="hidden" name="parcela" value="'+parcela+'"/>'+
                 '</form>>');
    $('body').append(form);
    form.submit();
});

