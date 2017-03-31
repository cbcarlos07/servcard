<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$id = $_POST['id'];

include "beans/Contrato.class.php";
include "controller/ContratoController.class.php";

$contrato = new Contrato();
$contratoController = new ContratoController();

$contrato = $contratoController->getContratoCancelado($id);

?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">

 <link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
            <div class="col-lg-12">

                    <div style="text-align: center">
                        <br>
                       <h3 >Informa&ccedil;&otilde;es de Cancelamento Contrato</h3>
                    </div>
                    <div class="mensagem alert col-lg-6"></div>

                    <form method="post" id="form" data-toggle="validator">
                        <div class="col-lg-offset-1">

                            <div class="row"></div>
                                <div class="form-group col-lg-2">
                                    <label for="data-contrato">Data do Cancelamento</label>
                                    <input id="data-contrato" class="form-control "
                                           value="<?php
                                           $dataMySQL = explode('-', $contrato->getDtCancelamento());
                                           echo $dataMySQL[2].'/'.$dataMySQL[1].'/'.$dataMySQL[0]; ?>"
                                    disabled=""/>
                                </div>
                                <div class="row"></div>
                                <div class="form-group col-lg-3">
                                    <label for="usuario">Usu&aacute;rio que cancelou</label>
                                    <input id="usuario" class="form-control" disabled=""
                                           value="<?php echo $contrato->getUsuario()->getDsLogin(); ?>"/>
                                </div>
                            <div class="row"></div>
                                <div class="form-group col-lg-2">
                                    <label for="observacao">Observacao</label>
                                    <textarea id="observacao" class="form-control " disabled rows="5">
                                    <?php echo $contrato->getDsObervacao(); ?>
                                    </textarea>
                                </div>

                            <div class="row"></div>
                            <hr />
                            <div class="btn-group">
                               <!-- <button class="btn btn-success" onclick="salvar()">Salvar</button> -->
                                <a href="#" class="btn btn-warning btn-acao" data-url="contrato.php" data-id="<?php echo $contrato->getCliente()->getCdCliente(); ?>">Cancelar</a>
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
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.tabletojson.min.js"></script>

        <script src="js/jquery.datetimepicker.full.js"></script>
        <script src="js/contrato.js"></script>
    </section>

 </body>
</html>
