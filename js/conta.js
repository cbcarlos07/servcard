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
        var agencia     = document.getElementById('agencia').value;
        var digagencia  = document.getElementById('digagencia').value;
        var conta       = document.getElementById('conta').value;
        var digconta    = document.getElementById('digconta').value;
        var banco       = document.getElementById('banco').value;
        var snatual     = document.getElementById('atual');
        var acao        = document.getElementById('acao').value;
        var boleto      = document.getElementById('boleto').value;

        var atual = 'N';
        if(snatual.checked == true){
            atual = 'S';
        }
        //alert("Acao: "+acao);
        $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/conta.php',
                beforeSend : carregando,
                data: {
                    'id'         : codigo,
                    'agencia'    : agencia,
                    'digagencia' : digagencia,
                    'conta'      : conta,
                    'digconta'   : digconta,
                    'banco'      : banco,
                    'atual'      : atual,
                    'boleto'     : boleto,
                    'acao' : acao
                },
                success: function (data) {
                    //alert(data.retorno);
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

function deletar(codigo, acao, atual){

    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/conta.php",
        beforeSend: carregando,
        data: {
            'id'    : codigo,
            'atual' : atual,
            'acao'  : acao
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
        location.href = "conta.php";
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

$('.delete').on('click', function(){
    var nome  = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id    = $(this).data('id'); // vamos buscar o valor do atributo data-id
    var acao  = $(this).data('action');
    var atual = $(this).data('atual');
    var msg   = $(this).data('msg');

    //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
    //console.log("Nome para deletar: "+nome);
    $('span.nome').text(nome);
    $('span.msg').text(msg);
    $('.delete-yes').on('click', function(){
        deletar(id,acao, atual);
    });
    //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

    //$('#myModal').modal('show'); // modal aparece
});

$('.btn-search').on('click', function () {
   alert('Form');
});
