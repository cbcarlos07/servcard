

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$descricao = "";

if(isset($_POST['search'])){
   $descricao =  $_POST['search'] ;
}

include_once "controller/ClienteController.class.php";
include_once "beans/Cliente.class.php";
include_once "services/ClienteListIterator.class.php";


$clienteController = new ClienteController();
$lista = $clienteController->getList($descricao);
$pListIterator = new ClienteListIterator($lista);



?>


<?php include "include/head.php"; ?>

 <link href="css/btn-style.css" type="text/css" rel="stylesheet">

 <link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />
 <body class="sticky-header left-side-collapsed"  >
    <section>
    <!-- left side start-->
		<?php include "include/menu.html"?>
    <!-- left side end-->

        <!-- Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
                    </div>
                    <div class="modal-body">Deseja realmente excluir o item <b><span class="nome"></span></b>? </div>
                    <div class="modal-footer">
                        <a href="#" type="button"  class="btn btn-primary delete-yes">Sim</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                    </div>
                </div>
            </div>
        </div>


    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  include "include/supbar.php"; ?>
			<!--notification menu end -->
            <div class="col-lg-12">

                    <div style="text-align: center">
                        <br>
                       <h3 >Informa&ccedil;&otilde;es de Contrato</h3>
                    </div>
                    <div class="mensagem alert "></div>
                    <form method="post" id="form">
                        <div class="col-lg-offset-1">
                            <input type="hidden" id="id" value="0">
                               <input type="hidden" id="usuario" value="1">
                                <div class="form-group col-lg-2">
                                    <label for="data-contrato">Data do Contrato</label>
                                    <input id="data-contrato" class="form-control " value="<?php echo date('d/m/Y'); ?>"/>
                                </div>
                                <div class="row"></div>
                                <hr />
                                <div class="row"></div>

                                <div class="form-group col-lg-2">
                                    <label for="parcela">N&ordm; de Parcela</label>
                                    <input id="parcela" type="number" class="form-control " min="1" />
                                </div>
                                <div class="form-group col-lg-1">
                                    <label for="juros">Juros atrasos</label>
                                    <input id="juros" type="number" class="form-control " min="1"/>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="vencimento">Data do Vencimento</label>
                                    <input id="vencimento" class="form-control "/>
                                </div>
                                <div class="col-lg-2" style="margin-top: 25px;">
                                    <a class="btn btn-primary btn-parcela">$ Gerar parcelas </a>
                                </div>
                            <div class="row"></div>
                            <div class="col-lg-5">
                                <table class="table table-responsive table-hover" style="table-layout: fixed; word-break: break-all; height: 30px;" >
                                    <thead>
                                       <th>N&ordm; da Parc</th>
                                       <th>Data do pagamento</th>
                                       <th>valor a pagar</th>
                                       <tbody id="tbody"></tbody>
                                    </thead>
                                </table>
                            </div>
                            <div class="row"></div>
                            <div class="col-lg-2 form-group">
                                <label for="total">Total a Pagar</label>
                                <input id="total" class="form-control"/>
                            </div>
                        </div>
                    </form>

            </div>
            <script src="js/tooltip.js"></script>



        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>

        <script src="js/jquery.datetimepicker.full.js"></script>
        <script src="js/contrato.js"></script>
    </section>

 </body>
</html>
