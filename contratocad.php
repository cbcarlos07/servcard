

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$id = $_POST['id'];



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
                    <div class="mensagem alert col-lg-6"></div>

                    <form method="post" id="form" data-toggle="validator">
                        <div class="col-lg-offset-1">
                            <input type="hidden" id="id" value="0">
                            <input type="hidden" id="usuario" value="1">
                            <input type="hidden" id="id-responsavel" value="1">
                            <input type="hidden" id="acao" value="C">
                            <input type="hidden" id="quite" value="N">
                            <input type="hidden" id="id-plano" value="0">
                            <input type="hidden" id="cliente" value="<?php echo $id; ?>">
                            <div class="row"></div>
                                <div class="form-group col-lg-2">
                                    <label for="data-contrato">Data do Contrato</label>
                                    <input id="data-contrato" class="form-control " value="<?php echo date('d/m/Y'); ?>"/>
                                </div>
                                <div class="row"></div>
                                <hr />
                                <div class="row"></div>
                                <div class="form-group col-lg-3">
                                    <label for="plano">Plano</label>
                                    <select class="form-control" id="plano"></select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="valor">Valor</label>
                                    <input id="valor" class="form-control" disabled/>
                                </div>
                            <div class="row"></div>
                                <div class="form-group col-lg-2">
                                    <label for="parcela">N&ordm; de Parcela</label>
                                    <input id="parcela" type="number" class="form-control " min="1" value="1"/>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="juros">Juros atrasos</label>
                                    <input id="juros" type="number" class="form-control " min="0" value="0"/>
                                </div>
                            <div class="row"></div>
                            <div class="form-group col-lg-2">
                                <label for="dias">Dias/Vencimento</label>
                                <input id="dias" type="number" class="form-control " min="1" value="30" title="Apenas sugest&atilde;o"/>
                            </div>
                                <div class="form-group col-lg-2">
                                    <label for="vencimento">Data do Vencimento</label>
                                    <input id="vencimento" class="form-control "/>
                                </div>
                                <div class="col-lg-2" style="margin-top: 25px;">
                                    <a class="btn btn-primary btn-parcela">$ Gerar parcelas </a>
                                </div>
                            <div class="row"></div>
                            <div class="col-lg-6">
                                <table class="table table-responsive table-hover" id="tabela" style="table-layout: fixed; word-break: break-all; height: 30px;" >
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
                            <div class="checkbox-inline1"style="margin-top: 15px;"><label><input type="checkbox" value="S" id="titular" checked> Titular?</label></div>
                            <div class="row"></div>
                            <div class="col-lg-2 form-group">
                                <label for="responsavel">Respons&aacute;vel</label>
                                <select id="responsavel" class="form-control"></select>
                            </div>
                            <hr />
                            <div class="btn-group">
                                <button class="btn btn-success" onclick="salvar()">Salvar</button>
                                <a class="btn btn-warning btn-voltar" data-id="<?php echo $id; ?>" data-url="contrato.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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
