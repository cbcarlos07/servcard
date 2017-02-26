

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<?php include "include/head.php"; ?>
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
                <h3>Cadastro de Cidade</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <div class="form-group col-lg-10">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" class="form-control" required="" autofocus/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-6">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" required="">
                            <option value="">Selecione</option>
                            <?php
                              require_once "beans/Estado.class.php";
                              require_once "controller/EstadoController.class.php";
                              require_once "services/EstadoListIterator.class.php";

                              $ec = new EstadoController();
                              $lista = $ec->getList("");
                              $eListIterator = new EstadoListIterator($lista);
                              $estado = new Estado();
                              while($eListIterator->hasNextEstado()){
                                  $estado = $eListIterator->getNextEstado();
                              ?>
                                <option value="<?php echo $estado->getCdEstado();  ?>"><?php echo $estado->getNmEstado();  ?></option>
                                <?php
                                  }

                                ?>
                        </select>
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="cidade.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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




    <script src="js/cidade.js"></script>

 </body>
</html>