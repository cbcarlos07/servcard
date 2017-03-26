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
