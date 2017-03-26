$('.btn-detalhe').on('click',function () {
    // alert('Detalhe');
    var url      = $(this).data('url');
    var contrato = $(this).data('contrato');
    var form = $('<form action="'+url+'" method="post">'+
        '<input type="hidden" name="contrato" value="'+contrato+'">'+
        '</form>'   );
    $('body').append(form);
    form.submit();
});

$('.btn-print').on('click',function () {
    // alert('Detalhe');
    var url      = $(this).data('url');
    var contrato = $(this).data('contrato');
    var form = $('<form action="'+url+'" method="post">'+
        '<input type="hidden" name="contrato" value="'+contrato+'">'+
        '</form>'   );
    $('body').append(form);
    form.submit();
});

$('.btn-page').on('click', function(){
    //alert('Pagina');
    var url      = $(this).data('url');
    var pagina   = $(this).data('page');
    var form     = $('<form action="'+url+'" method="post">'+
        '<input type="hidden" name="pagina" value="'+pagina+'">'+
        '</form>');
    $('body').append(form);
    form.submit();

});

$('.registros').on('change', function () {
    var registro = document.getElementById('registro').value;
    var form     = $('<form method="post" action="cliente.php">'+
        '<input type="hidden" name="registros" value="'+registro+'">'+
        '</form>');
    $('body').append(form);
    form.submit();
});
