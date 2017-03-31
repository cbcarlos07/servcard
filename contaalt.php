<?php
include "include/head.php";
$id = $_POST['id'];

//include "include/error.php";

include "beans/Conta.class.php";
include "controller/ContaController.class.php";

$conta = new Conta();
$contaController = new ContaController();

$conta = $contaController->getConta($id);

 ?>


<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.min.js"></script>

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


            <div class="row"></div>
            <br />
            <div style="text-align: center;">
            <h3>Alterar Cadastro de Conta</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $id; ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <div class="form-group col-xs-12 col-sm-1 col-md-3 col-lg-3"><hr /></div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-3">Ag&ecirc;ncia</div>
                    <div class="form-group col-xs-12 col-sm-1 col-md-3 col-lg-3"><hr /></div>
                    <div class="row"></div>
                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="agencia">Ag&ecirc;ncia</label>
                        <input id="agencia" type="number" class="form-control" required=""  min="0" autofocus value="<?php echo $conta->getNrAgencia(); ?>"/>
                    </div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <label for="digagencia">D&iacute;gito</label>
                        <input id="digagencia" type="number" class="form-control"   min="0" value="<?php echo $conta->getNrDigAgencia(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-xs-12 col-sm-1 col-md-3 col-lg-3"><hr /></div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-3 col-lg-3">Conta</div>
                    <div class="form-group col-xs-12 col-sm-1 col-md-3 col-lg-3"><hr /></div>
                    <div class="row"></div>
                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="conta">Conta</label>
                        <input id="conta"  class="form-control" required="" value="<?php echo $conta->getNrConta(); ?>" />
                    </div>
                    <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <label for="digconta">D&iacute;gito</label>
                        <input id="digconta" type="number" class="form-control" required=""  min="0" value="<?php echo $conta->getNrDigConta(); ?>"/>
                    </div>
                    <div class="row"></div>

                    <div class="form-group col-xs-12 col-sm-5 col-md-6 col-lg-6">
                        <label for="banco">Banco</label>
                        <select id="banco" type="number" class="form-control" required="" >
                            <option value="">Selecione</option>
                            <option value='{"sigla" : "bradesco", "bank": "Bradesco"}' <?php $conta->getDsSiglaBanco() == "bradesco" ? $select = "selected" : $select = ""; echo $select; ?>>Bradesco</option>
                            <option value='{"sigla" : "bb", "bank": "Brasil"}' <?php $conta->getDsSiglaBanco() == "bb" ? $select = "selected" : $select = ""; echo $select; ?>>Brasil</option>
                            <option value='{"sigla" : "cef", "bank": "Caixa Economica Federal"}' <?php $conta->getDsSiglaBanco() == "cef" ? $select = "selected" : $select = ""; echo $select; ?>>Caixa Econ&ocirc;mica Federal</option>
                            <option value='{"sigla" : "itau", "bank": "Itau"}'<?php $conta->getDsSiglaBanco() == "itau" ? $select = "selected" : $select = ""; echo $select; ?>>Ita&uacute;</option>
                            <option value='{"sigla" : "santander_banespa", "bank": "Santander"}' <?php $conta->getDsSiglaBanco() == "santander" ? $select = "selected" : $select = ""; echo $select; ?>>Santander</option>
                        </select>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-12">
                      <div class="checkbox-inline"><label><input type="checkbox" id="atual" <?php $conta->getSnAtual() == "S" ? $select = "checked" : $select = ""; echo $select; ?>> Atual?</label></div>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <label for="boleto">Taxa do Boleto (R$)</label>
                        <input id="boleto" class="form-control" placeholder="2.5 = 2,50"  value="<?php echo $conta->getVlTaxaBoleto(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="banco.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
                    </div>

                </form>
            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

	</section>





    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery-3.1.1.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>




    <script src="js/conta.js"></script>

 </body>
</html>