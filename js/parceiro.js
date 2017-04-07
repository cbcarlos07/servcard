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
  //  alert("Salvar");
    jQuery('#form').submit(function () {
      // alert("Submit");
        var codigo        = document.getElementById('id').value;
        var nome          = document.getElementById('razao').value;
        var responsavel   = document.getElementById('responsavel').value;
        var cpf           = document.getElementById('cpf').value;
        var cnpj          = document.getElementById('cnpj').value;
        var cep         = document.getElementById('cep').value;
        var bairro      = document.getElementById('bairro').value;
        var cidade      = document.getElementById('cidade').value;
        var estado      = document.getElementById('estado').value;
        var ramo          = document.getElementById('ramo').value;
        var numero        = document.getElementById('numero').value;
        var complemento   = document.getElementById('complemento').value;
        var acao          = document.getElementById('acao').value;
       // alert("Nome: "+nome);
        $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/parceiro.php',
                beforeSend : carregando,
                data: {
                    'id'          : codigo,
                    'nome'        : nome,
                    'responsavel' : responsavel,
                    'cpf'         : cpf,
                    'cnpj'        : cnpj,
                    'cep'         : cep,
                    'bairro'      : bairro,
                    'cidade'      : cidade,
                    'estado'      : estado,
                    'ramo'        : ramo,
                    'numero'      : numero,
                    'complemento' : complemento,
                    'acao'        : acao
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

function deletar(codigo, acao){

    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/parceiro.php",
        beforeSend: carregando,
        data: {
            'id' : codigo,
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
        location.href = "parceiro.php";
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


$('#cep').focusout(function () {
    //Nova variável "cep" somente com dígitos.
    var valcep = document.getElementById("cep").value;
    var cep = valcep.replace(".","").replace("-","");

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#logradouro").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");

            //Consulta o webservice viacep.com.br/
            $.ajax({
                url: 'https://viacep.com.br/ws/'+cep+'/json/',
                dataType: 'jsonp',
                crossDomain: true,
                contentType: "application/json",
                statusCode: {
                    200: function(data) {
                        console.log(data);
                        $("#logradouro").val(data.logradouro);
                        if(data.logradouro == ""){
                            document.getElementById('logradouro').disabled = false;
                            document.getElementById('logradouro').focus();

                        }else{
                            document.getElementById('logradouro').disabled = true;
                        }
                        $("#bairro").val(data.bairro);
                        if(data.bairro == ""){
                            document.getElementById('bairro').disabled = false;

                        }else{
                            document.getElementById('bairro').disabled = true;
                            document.getElementById('numero').focus();
                        }


                        $("#cidade").val(data.localidade);
                        $("#estado").val(data.uf);

                    } // Ok
                    ,400: function(msg) { console.log(msg);  } // Bad Request
                    ,404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
                }
            })
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});


$(document).ready(function () {
    var id = document.getElementById("cep").value;
    if(id !=  ""){
        var cep = id.replace(".","").replace("-","");
        //Preenche os campos com "..." enquanto consulta webservice.
        $("#logradouro").val("...");
        $("#bairro").val("...");
        $("#cidade").val("...");
        $("#estado").val("...");

        //Consulta o webservice viacep.com.br/
        $.ajax({
            url: 'https://viacep.com.br/ws/'+cep+'/json/',
            dataType: 'jsonp',
            crossDomain: true,
            contentType: "application/json",
            statusCode: {
                200: function(data) {
                    console.log(data);
                    $("#logradouro").val(data.logradouro);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.localidade);
                    $("#estado").val(data.uf);

                } // Ok
                ,400: function(msg) { console.log(msg);  } // Bad Request
                ,404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
            }
        })
    } //fim do se
});

function limpa_formulario_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#ibge").val("");
}


$(document).ready(function () {
    var id = document.getElementById("cep").value;
    if(id != ""){
        //  alert('Buscar '+id);
        //Preenche os campos com "..." enquanto consulta webservice.
        $("#logradouro").val("...");
        $("#bairro").val("...");
        $("#cidade").val("...");
        $("#estado").val("...");

        //Consulta o webservice viacep.com.br/
        var cep = id.replace(".","").replace("-","");
        $.ajax({
            url: 'http://correiosapi.apphb.com/cep/'+cep,
            dataType: 'jsonp',
            crossDomain: true,
            contentType: "application/json",
            statusCode: {
                200: function(data) {
                    console.log(data);
                    $("#logradouro").val(data.tipoDeLogradouro+" "+data.logradouro);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                    $("#estado").val(data.estado);

                } // Ok
                ,400: function(msg) { console.log(msg);  } // Bad Request
                ,404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
            }
        })
    } //fim do se
});

$(document).ready(function(){
    $('#cep').mask('00.000-000');

});

$(document).ready(function(){
    $('#cpf').mask('000.000.000-00');

});

$(document).ready(function(){
    $('#cnpj').mask('00.000.000/0000-00');

});
