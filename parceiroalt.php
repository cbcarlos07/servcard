

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<?php
$id = $_POST['id'];
include "include/error.php";
include "beans/Parceiro.class.php";
include "controller/ParceiroController.class.php";

$parceiro = new Parceiro();
$parceiroController = new ParceiroController();

$parceiro = $parceiroController->getParceiro($id);

include "include/head.php"; ?>
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
            <h3>Alterar Cadastro de Parceiro</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-7">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $id; ?>" type="hidden">
                    <input id="endereco"  type="hidden" value="<?php echo $parceiro->getEndereco()->getCdEndereco(); ?>">
                    <input id="acao" value="A" type="hidden">
                    <div class="form-group col-lg-12">
                        <label for="razao">Raz&atilde;o Social ou Nome Fantasia</label>
                        <input id="razao" class="form-control" required="" value="<?php echo $parceiro->getNmParceiro(); ?>" />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-12">
                        <label for="responsavel">Respons&aacute;vel</label>
                        <input id="responsavel" class="form-control" value="<?php echo $parceiro->getDsResponsavel(); ?>" required=""/>
                    </div>

                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="cpf">CPF</label>
                        <input id="cpf" class="form-control" value="<?php echo $parceiro->getNrCpfResponsavel(); ?>"/>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="cnpj">CNPJ</label>
                        <input id="cnpj" class="form-control" value="<?php echo $parceiro->getNrCnpj(); ?>"/>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="ramo">Ramo</label>
                        <input id="ramo" class="form-control" value="<?php echo $parceiro->getDsRamo(); ?>" />
                    </div>
                    <div class="row"></div>
                    <div class="col-lg-4"><hr /></div>
                    <div class="col-lg-4" style="text-align: center;">
                        <span>Endere&ccedil;o</span>
                    </div>
                    <div class="col-lg-4"><hr /></div>


                    <div class="form-group col-lg-3">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control" placeholder="00.000-000" />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-6">
                        <label for="logradouro">Logradouro</label>
                        <input id="logradouro" class="form-control" disabled="" />
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" class="form-control" disabled="" />
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="numero">N&uacute;mero</label>
                        <input id="numero" class="form-control" required="" value="<?php echo $parceiro->getNrCasa(); ?>"/>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="complemento">Complemento</label>
                        <input id="complemento" class="form-control" value="<?php echo $parceiro->getDsComplemento(); ?>"/>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="parceiro.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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
    <script src="js/jquery.mask.js"></script>
    <script src="js/validarcpf.js"></script>
    <script src="js/validator.min.js"></script>



    <script src="js/parceiro.js"></script>

 </body>
</html>