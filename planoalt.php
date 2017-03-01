

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<?php
require_once "beans/Plano.class.php";
require_once "controller/PlanoController.class.php";

$id = $_POST['id'];

$plano = new Plano();
$planoController = new PlanoController();

$plano = $planoController->getPlano($id);

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
            <h3>Altera&ccedil;&atilde;o de Cadastro de Plano</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $plano->getCdPlano(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <div class="form-group">
                        <label for="plano">Descri&ccedil;&atilde;o</label>
                        <input id="plano" class="form-control" required="" placeholder="Descri&ccedil;&atilde;o breve" value="<?php echo $plano->getDsPlano(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group">
                        <label for="observacao">Observa&ccedil;&atilde;o</label>
                        <textarea id="observacao" class="form-control" rows="5" placeholder="Maiores de detalhes"><?php echo $plano->getObsPlano(); ?></textarea>
                    </div>
                    <div class="row"></div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input id="valor" class="form-control" required="" placeholder="50,00" value="<?php echo $plano->getNrValor(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="plano.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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




    <script src="js/plano.js"></script>

 </body>
</html>