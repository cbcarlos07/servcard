/**
 * Created by carlos.brito on 21/02/2017.
 */

$('.novo-item').on('click', function(){

    var url = $(this).data('url');
    var id = $(this).data('id');
    //alert(url);
    var form = $('<form action="' + url + '" method="post">' +
        '<input type="text" name="id" value="' + id + '" />' +
        '</form>');
   // var div = $('<div style="display: none;>"'+form+'</div>');
    $('body').append(form);
    form.submit();

});

function salvar(){
    //alert("Salvar");
    jQuery('#form').submit(function () {
       // alert("Submit");
        var codigo     = document.getElementById('id').value;
        var validade   = document.getElementById('validade').value;
        var snativo    = document.getElementById('ativo');
        var sntitular  = document.getElementById('tptitular');
        var cliente    = document.getElementById('cliente').value;
        var contrato   = document.getElementById('contrato').value;
        var acao       = document.getElementById('acao').value;
        var tptitular = 'N';
        var ativo   = 'N';
        if(sntitular.checked == true) {
            tptitular = 'S';
        }

        if(snativo.checked == true) {
            ativo = 'S';
        }


       // alert("Contrato: "+contrato);
        $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/carteira.php',
                beforeSend : carregando,
                data: {
                    'id'        : codigo,
                    'validade'  : validade,
                    'ativo'     : ativo,
                    'tptitular' : tptitular,
                    'cliente'   : cliente,
                    'contrato'  : contrato,
                    'acao'      : acao

                },
                success: function (data) {
                    //alert(data.retorno);
                    if (data.retorno == 1) {
                        sucesso('Opera&ccedil;&atilde;o realizada com sucesso!', cliente);
                    }
                     else {
                        errosend('N&atilde;o foi poss&iacute;vel realizar opera&ccedil;&atilde;o. Verifique se todos os campos est&atilde;o preenchidos ');
                    }
                }
              });
        return false;
    });

}

function inativar(codigo, acao){
     var usuario    = document.getElementById('usuario').value;
     var observacao = document.getElementById('observacao').value;
     //alert("Obs: "+observacao);
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/carteira.php",
        beforeSend: carregando,
        data: {
            'id'         : codigo,
            'usuario'    : usuario,
            'observacao' : observacao,
            'acao' : acao
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
function sucesso(msg, cliente){
    //alert("Mensagem: "+msg);
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.href = "carteira.php";
        var form = $('<form action="carteira.php" method="post">' +
                   '<input name="id" value="'+cliente+'">'+
                   '</form>');
        $('body').append(form);
        form.submit();
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
        '<input type="hidden" name="id" value="'+id+'">'+
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


    $("tr").on('click',function() {
        //console.log("Click");
        var contrato = document.getElementById('contrato-modal');
        var nome = document.getElementById('nome-modal');
         var tableData = $(this).children("td").map(function() {
         return $(this).text();
         }).get();

         //console.log("Your data is: " + $.trim(tableData[0]) + " , " + $.trim(tableData[1]) + " , " + $.trim(tableData[2]));
         contrato.value =    $.trim(tableData[0]);
         nome.value = $.trim(tableData[1]);
    });
   /* $('.delete-yes').on('click', function(){
        deletar(id,acao);
    });*/
    //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

    //$('#myModal').modal('show'); // modal aparece
});


$('.btn-inativar').on('click', function(){

    var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
    var acao = $(this).data('action');

    //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
    //console.log("Nome para deletar: "+nome);
    $('span.nome').text(id);

    $('.delete-yes').on('click', function(){
        inativar(id,acao);
    });
    //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

    //$('#myModal').modal('show'); // modal aparece
});


$('.btn-mostrar').on('click', function(){

    var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
    var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-id
    var validade = $(this).data('validade'); // vamos buscar o valor do atributo data-id
    var acao = $(this).data('action');

    //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
    //console.log("Nome para deletar: "+nome);
    $('span.nome').text(nome);
    $('span.carteira').text(id);
    $('span.validade').text(validade);

    $('.delete-yes').on('click', function(){
        //alert('Click');
        var form = $('<form action="carteiraficha.php" method="post">' +
            '<input type="hidden" value="'+id+'" name="id">'+
            '<input type="hidden" value="'+nome+'" name="nome">'+
            '<input type="hidden" value="'+validade+'" name="validade">'+
            '</form>');
        $('body').append(form);
        form.submit();
    });
    //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

    //$('#myModal').modal('show'); // modal aparece
});

$('.btn-search').on('click', function () {
   alert('Form');
});

$(document).ready(function(){

    var id = document.getElementById('id-contrato').value;

    $.post("function/contrato.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){
            var contrato = $("#contrato");
            contrato.find("option").remove();
            contrato.append(data);
        });
});

$(document).ready(function(){



    $.post("function/contrato.php",
        {

            'acao': "T"
        },
        function(data){
            var tabela = $("#tabela");
            tabela.find("tr").remove();
            tabela.append(data);
        });
});


function carregar() {
    var pesquisa = document.getElementById('pesquisa').value;

    $.post("function/contrato.php",
        {
            'observacao' : pesquisa,
            'acao': "T"
        },
        function(data){
            var tabela = $("#tabela");
            tabela.find("tr").remove();
            tabela.append(data);

            $("tr").on('click',function() {
                //console.log("Click");
                var contrato = document.getElementById('contrato-modal');
                var nome = document.getElementById('nome-modal');
                var tableData = $(this).children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log("Your data is: " + $.trim(tableData[0]) + " , " + $.trim(tableData[1]) + " , " + $.trim(tableData[2]));
                contrato.value =    $.trim(tableData[0]);
                nome.value = $.trim(tableData[1]);
            });

        });
}

$('.btn-ok').on('click', function () {
    var contrato_modal = document.getElementById('contrato-modal').value;
    var nome_modal     = document.getElementById('nome-modal').value;
    var contrato       = document.getElementById('contrato').value = contrato_modal;
    var nome           = document.getElementById('nome').value = nome_modal;
    var vencimento     = document.getElementById('validade');
    $.ajax({
        type    : 'post',
        dataType: 'json',
        url     : 'function/contratomensal.php',

        data: {
            'id'        : contrato_modal,
            'acao'      : 'V'

        },
        success: function (data) {
            vencimento.value = data.vencimento;
        }
    });


});

$("#vencimento").datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
    mask: true
});









