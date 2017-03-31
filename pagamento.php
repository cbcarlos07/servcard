<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
//include "include/error.php";



?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
 <body class="sticky-header left-side-collapsed"  >
    <section>
    <!-- left side start-->
		<?php include "include/menu.html"?>
    <!-- left side end-->


    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  include "include/supbar.php"; ?>
			<!--notification menu end -->


            <br>

            <div class="col-lg-12" style="text-align: center;"><h3 >Informar Pagamentos</h3></div>


            <div class="row"></div>
            <hr />
            <script src="js/tooltip.js"></script>
            <div class="col-lg-5">
               <div class="mensagem alert"></div>
            </div>
            <div class="col-lg-12">

                <div class="form-group col-lg-2 col-md-3 col-sm-3" style="margin-left: 35px;">
                    <label for="cpf">Informe o CPF</label>
                    <input type="text" class="form-control" id="cpf" autofocus/>
                </div>
                <button class="btn btn-primary col-lg-1 col-md-2 col-sm-2 btn-search" style="margin-top: 22px;">Pesquisar</button>
            </div>
            <div class="row"></div>
            <div id="page-wrapper" class="tabela">
            <div class="graphs">
                <div class="xs tabls">

                    <div class="bs-example4" data-example-id="contextual-table">
                        <div id="tabela">
                        <table class="table table-hover" id="tabela">

                        </table>
                    </div>
                    </div>


            </div>
        </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script>
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
        </script>
        <script src="js/jquery.mask.js"></script>
        <script src="js/pagamento.js"></script>
    </section>

 </body>
</html>
