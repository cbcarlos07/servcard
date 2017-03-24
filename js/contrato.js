/**
 * Created by carlos.brito on 21/02/2017.
 */

$('.novo-item').on('click', function(){

    var url    = $(this).data('url');
    var codigo = $(this).data('id');
    //alert(url);
    var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="id" value="' + codigo + '" />' +
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
        var usuario     = document.getElementById('usuario').value;
        var total       = document.getElementById('total').value;
        var plano       = document.getElementById('plano').value;
        var venc  = $('.table').tableToJSON();
        var cliente     = document.getElementById('cliente').value;
        var quite       = document.getElementById('quite').value;
        var acao        = document.getElementById('acao').value;
        var vencimento  = JSON.stringify(venc)
        var dias        = document.getElementById('dias').value;
        var sntitular   = document.getElementById('titular');
        var responsavel = document.getElementById('responsavel').value;
        //alert('Acao: '+acao);
        var titular = "N";
        if(sntitular.checked == true){
            titular = "S";
        }
        $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/contrato.php',
                beforeSend : carregando,
                data: {
                    'id'          : codigo,
                    'data'        : data,
                    'parcela'     : parcelas,
                    'juros'       : juros,
                    'vencimento'  : vencimento,
                    'valor'       : total.replace("R$ ","").replace(",","."),
                    'cliente'     : cliente,
                    'usuario'     : usuario,
                    'plano'       : plano,
                    'quite'       : quite,
                    'dias'        : dias,
                    'titular'     : titular,
                    'responsavel' : responsavel,
                    'acao'        : acao
                },
                success: function (data) {
                    //alert(data.retorno);
                    if (data.retorno == 1) {
                        sucesso('Opera&ccedil;&atilde;o realizada com sucesso!', data.id);
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
    var usuario    = document.getElementById('usuario').value;
    //alert('usuario: '+usuario);
    var observacao = document.getElementById('observacao').value;
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/contrato.php",
        beforeSend: carregando,
        data: {
            'id'         : codigo,
            'usuario'    : usuario,
            'observacao' : observacao,
            'acao'     : acao
        },
        success: function( data )
        {
            console.log("Excluir: "+data.retorno);
            if(data.retorno == 1){
                $('#delete-modal').modal('hide');
                sucesso_delete('Item desativado com sucesso. Aguarde atualiza&ccedil;&atilde;o');
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
function sucesso(msg, id){
    //alert("Mensagem: "+msg);
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        var form = $('<form action="contrato.php" method="post">' +
                     '<input name="id" value="'+id+'"/>'+
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
    var id = $(this).data('id');
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
    var cliente = $(this).data('cliente');
    var form = $('<form action="'+url+'" method="post">' +
        '<input type="hidden" value="'+id+'" name="id">'+
        '<input type="hidden" value="'+cliente+'" name="cliente">'+
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
    var mensagem = $('.mensagem');
    var parcelas = document.getElementById('parcela').value;
    var juros    = document.getElementById('juros');
    var plano    = document.getElementById('plano');
    var corpo = "" ;
    var valorJuros = 0;
    if(juros.value == ""){

        juros.value = 0;
        valorJuros = 0;
    }else{
        valorJuros = juros.value;
    }
  //  alert(parcelas);
    if(parcelas == "" || parcelas == 0){

        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>O n&uacute;mero de parcelas est&aacute; vazio</p>').fadeIn("fast");
        $('input[id="parcela"]').css("border-color","red").focus();
    }
    else if(plano.selectedIndex == 0){
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Selecione um plano</p>').fadeIn("fast");
        $('select[id="plano"]').css("border-color","red").focus();
    }
    else{

        mensagem.empty().html('<p class="alert "></p>');
        $('input[id="parcela"]').css("border-color","#ccc");
        $('select[id="plano"]').css("border-color","#ccc");
        var valor    = document.getElementById('valor').value;
        var dias     = parseInt(document.getElementById('dias').value);
        var new_valor = parseFloat(valor.replace("R$ ","").replace(",","."));
        var dataVencimento = new Date();
        dataVencimento.setDate(dataVencimento.getDate() + dias);
        var total   =  document.getElementById('total');
        var tbody   =  document.getElementById('tbody');

        var auxiliar = 0;

        var totalAPagar = 0;


     //   alert("Novo valor: '"+new_valor+"'");
        while (auxiliar <  parcelas)
        {
            auxiliar++;
            totalAPagar += new_valor;

        }

        var new_valor = ((valorJuros * totalAPagar)/100) + totalAPagar;
        var valorParcela = new_valor/parcelas;

        auxiliar = 0;
        totalAPagar = 0;
        //console.log('Mes: '+dataVencimento.getMonth());
        var soma = 0;
        var mes = dataVencimento.getMonth();
        var new_data;
        var novo_mes;
        var anovenc;
        while (auxiliar < parcelas){
            auxiliar++;
            soma++;
            new_data = new Date(dataVencimento.getFullYear(), eval(soma + mes), dataVencimento.getDate());
            novo_mes = new_data.getMonth();
            anovenc  = new_data.getFullYear() ;
            if(novo_mes == 0){

                new_data = new Date(dataVencimento.getFullYear(), eval(soma + mes), dataVencimento.getDate());
                novo_mes = 12;
                anovenc  = new_data.getFullYear() - 1;
            }
            console.log('Mes inc: '+novo_mes);

            var diavenc      = dataVencimento .getDate() < 10 ? '0' + dataVencimento.getDate() : dataVencimento.getDate();
            var mesvenc      = novo_mes < 10 ? '0' +novo_mes : novo_mes;

           // console.log('Auxiliar ['+auxiliar+']');
            console.log('Mes: '+new_data.getMonth());
            corpo = corpo + '<tr class="item">' +
                                '<td>'+auxiliar+'</td>'+
                                '<td>'+diavenc+'/'+mesvenc+'/'+anovenc+'</td>'+
                                '<td>R$ '+valorParcela.toFixed(2)+'</td>'+
                             '</tr>';
            totalAPagar += valorParcela;
           // dataVencimento.setDate(dataVencimento.getDate() + dias);
        }
        tbody.innerHTML = corpo;
        total.value = 'R$ '+totalAPagar.toFixed(2);
    }



});

$('#parcela').focusout(function () {
    var mensagem = $('.mensagem');
    var parcelas = document.getElementById('parcela').value;
    //alert("Parcela focus out "+parcelas);
    if(parcelas == "" || parcelas == 0){

        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>O n&uacute;mero de parcelas est&aacute; vazio</p>').fadeIn("fast");
        $('input[id="parcela"]').css("border-color","red");
    }else{
       // alert("Parcelas nao esta vazio");
        mensagem.empty().html('<p class="alert"></p>');
        $('input[id="parcela"]').css("border-color","#ccc");
    }
});

$(document).ready(function(){
    var data = new Date();
    var dias = parseInt(document.getElementById('dias').value);
    data.setDate(data.getDate() + dias);
    //alert('Dia: '+data.getDate());
    var mes = data.getMonth();
    var new_data = new Date(data.getFullYear(), eval(1+ mes), data.getDate());
    var dia      = data.getDate() < 10 ? '0' + data.getDate() : data.getDate();
    var new_mes  = new_data.getMonth() < 10 ? '0' + new_data.getMonth() : new_data.getMonth();
    var ano      = new_data.getFullYear() ;
    //alert('Data '+dia+'/'+new_mes+'/'+ano);
    document.getElementById('vencimento').value = dia+'/'+new_mes+'/'+ano;

});

$('#dias').bind('keyup mouseup',function () {
    var mensagem = $('.mensagem');
    //var dias = parseInt(document.getElementById('dias').value);
    //alert("Parcela focus out "+dias);
    var data = new Date();
    var dias = parseInt(document.getElementById('dias').value);
    if(dias > 0){
        data.setDate(data.getDate() + dias);
        //alert('Dia: '+data.getDate());
        var mes = data.getMonth();
        var new_data = new Date(data.getFullYear(), eval(1 + mes), data.getDate());
        var dia      = data.getDate() < 10 ? '0' + data.getDate() : data.getDate();
        var new_mes  = new_data.getMonth() < 10 ? '0' + new_data.getMonth() : new_data.getMonth();
        var ano      = new_data.getFullYear() ;
        //alert('Data '+dia+'/'+new_mes+'/'+ano);
        document.getElementById('vencimento').value = dia+'/'+new_mes+'/'+ano;
    }
    else{
        document.getElementById('vencimento').value = '';
    }

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
    var mensagem = $('.mensagem');
    //alert("Plano: '"+id_plano+"'");
    if(id_plano == ""){
     // alert("Igual ao vazio");
    }else{
        //alert("Obter valor");

        mensagem.empty().html('<p class="alert "></p>');
        $('select[id="plano"]').css("border-color","#ccc");
        //alert('Codigo do plano: '+id_plano);
        $.post("function/plano.php",
            {
                'id'  : id_plano,
                'acao': "V"
            },
            function(data){
                valor.value =  data;
            });
    }


});

$(document).ready(function () {

    var id_plano = document.getElementById('id-plano').value;
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

$(document).ready(function () {
    var tbody = document.getElementById('tbody');
    var id    = document.getElementById('id').value;
   // alert("Contrato nr: "+id);
    $.post("function/contratomensal.php",
        {
            'id': id,
            'acao': 'B'
        },
        function (data) {
            tbody.innerHTML = data;
        }
    )

});

var responsavel = $('#responsavel');
$(document).ready(function(){
    var id = document.getElementById('id-responsavel').value;
    //alert('Codigo da cidade: '+cidade);
    $.post("function/usuario.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){
            responsavel.find("option").remove();
            responsavel.append(data);
        });

});

