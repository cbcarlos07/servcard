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

    jQuery('#form-card').submit(function () {
        var codigo = document.getElementsByName('codigo').value;
        var pais   = document.getElementsByName('pais').value;
        var acao   = document.getElementsByName('#acao').value;

        $.ajax({
                dataType: 'json',
                type    : 'post',
                url     : 'funcoes/pais.php',
                beforeSend : carregando,

              });
    });

}