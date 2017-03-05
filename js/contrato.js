/**
 * Created by carlos.brito on 21/02/2017.
 */

$('.novo-item').on('click', function(){

    var url = $(this).data('url');
    //alert(url);
    var form = $('<form action="' + url + '" method="post">' +
        //'<input type="text" name="codigo" value="' + codigo + '" />' +
        '</form>');
   // var div = $('<div style="display: none;>"'+form+'</div>');
    $('body').append(form);
    form.submit();

});

function salvar(){
    //alert("Salvar");
    jQuery('#form').submit(function () {
       // alert("Submit");
        var codigo      = document.getElementById('id').value;
        var data        = document.getElementById('data-contrato').value;
        var parcelas    = document.getElementById('parcela').value;
        var juros       = document.getElementById('juros').value;
        var vencimento  = document.getElementById('vencimento').value;
        var total       = document.getElementById('total').value;
        var acao        = document.getElementById('acao').value;
        //alert("Numero: "+numero);
        $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/cliente.php',
                beforeSend : carregando,
                data: {
                    'id'          : codigo,
                    'data'        : data,
                    'sobrenome'   : sobrenome,
                    'parcelas'    : parcelas,
                    'juros'       : juros,
                    'vencimento'  : vencimento,
                    'total'       : total,
                    'acao'        : acao
                },
                success: function (data) {
                   // alert(data.retorno);
                    if (data.retorno == 1) {
                        sucesso('Opera&ccedil;&atilde;o realizada com sucesso!');
                    }
                     else {
                        errosend('N&atilde;o foi poss&iacute;vel realizar opera&ccedil;&atilde;o. Verifique se todos os campos est&atilde;o preenchidos ');
                    }
                }
              });
        return false;
    });

}

function deletar(codigo, acao){

    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/cliente.php",
        beforeSend: carregando,
        data: {
            'id'       : codigo,
            'acao'     : acao
        },
        success: function( data )
        {
            console.log("Excluir: "+data.retorno);
            if(data.retorno == 1){
                $('#delete-modal').modal('hide');
                sucesso_delete('Item excluido com sucesso. Aguarde atualiza&ccedil;&atilde;o');
            }else if(data.retorno == 0){
                errosend('N&atilde;o foi poss&iacute;vel excluir');
            }
        }
    });
    return false;
}


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
function sucesso(msg){
    //alert("Mensagem: "+msg);
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.href = "cliente.php";
    },2000);
}
function sucesso_delete(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.reload();
    },2000);

}

function verifica(Msg)
{
    return confirm(Msg) ;
}

$('.btn-voltar').on('click', function(){
    var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    //alert('Url: '+url);
    var form = $('<form action="'+url+'" method="post">' +

        '</form>');
    $('body').append(form);
    form.submit();
});

$('.btn-alterar').on('click', function(){
    var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id = $(this).data('id');
    var form = $('<form action="'+url+'" method="post">' +
               '<input type="hidden" value="'+id+'" name="id">'+
               '</form>');
    $('body').append(form);
    form.submit();
});

$('.btn-acao').on('click', function(){
    var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id = $(this).data('id');
    var form = $('<form action="'+url+'" method="post">' +
        '<input type="hidden" value="'+id+'" name="id">'+
        '</form>');
    $('body').append(form);
    form.submit();
});

$('.delete').on('click', function(){
    var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
    var acao = $(this).data('action');

    //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
    //console.log("Nome para deletar: "+nome);
    $('span.nome').text(nome);

    $('.delete-yes').on('click', function(){
        deletar(id,acao);
    });
    //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

    //$('#myModal').modal('show'); // modal aparece
});

$('.btn-search').on('click', function () {
   alert('Form');
});


$("#data-contrato").datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
    mask: true
});

$("#vencimento").datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
    mask: true
});

$('.btn-parcela').on('click',function () {
    var parcelas = document.getElementById('parcela').value;
    var valor    = document.getElementById('valor').value;
    var new_valor = parseFloat(valor.replace("R$ ","").replace(",","."));
    var total   =  document.getElementById('total');
    var tbody   =  document.getElementById('tbody');
    var data = new Date();
    var mesVencimento = data.getMonth() + 1;
    var diaVencimento = data.getDate();
    var auxiliar = 0;
    var corpo = "" ;
    var totalAPagar = 0;
    alert("Novo valor: '"+new_valor+"'");
    while (auxiliar < parcelas){
        auxiliar++;
        var nova_data = new Date(data.getFullYear(), eval(auxiliar + mesVencimento), diaVencimento);
        var diavenc   = data.getDate() < 10 ? '0' + data.getDate() : data.getDate();
        var mesvenc   = nova_data.getMonth() < 10 ? '0' + nova_data.getMonth() : nova_data.getMonth() ;
        var anovenc   = data.getFullYear();
        corpo = corpo + '<tr>' +
                            '<td>'+auxiliar+'</td>'+
                            '<td>'+diavenc+'/'+mesvenc+'/'+anovenc+'</td>'+
                            '<td>'+valor+'</td>'+
                        '</tr>';
        totalAPagar += new_valor;

    }
    tbody.innerHTML = corpo;
    total.value = 'R$ '+totalAPagar.toFixed(2);
});


$(document).ready(function(){
    var data = new Date();
    var mes = data.getMonth();
    var new_data = new Date(data.getFullYear(), eval(2 + mes), data.getDate());
    var dia      = data.getDate() < 10 ? '0' + data.getDate() : data.getDate();
    var new_mes  = new_data.getMonth() < 10 ? '0' + new_data.getMonth() : new_data.getMonth();
    var ano      = new_data.getFullYear() ;
    //alert('Data '+dia+'/'+new_mes+'/'+ano);
    document.getElementById('vencimento').value = dia+'/'+new_mes+'/'+ano;

});

var plano = $('#plano');
$(document).ready(function(){
    var id = document.getElementById('id-plano').value;
    //alert('Codigo da cidade: '+cidade);
    $.post("function/plano.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){
            plano.find("option").remove();
            plano.append(data);
        });

});

plano.on('change', function () {
    var id_plano = document.getElementById('plano').value;
    var valor    = document.getElementById('valor');

      //alert('Codigo do plano: '+id_plano);
    $.post("function/plano.php",
        {
            'id'  : id_plano,
            'acao': "V"
        },
        function(data){
            valor.value =  data;
        });
});
