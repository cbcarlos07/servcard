

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<?php
require_once "beans/Bairro.class.php";
require_once "controller/BairroController.class.php";

$id = $_POST['id'];

$bairroController = new BairroController();
$bairro = new Bairro();
$bairro = $bairroController->getBairro($id);



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
            <h3>Altera&ccedil;&atilde;o de Cadastro de Bairro</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $bairro->getCdBairro(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <div class="form-group col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" class="form-control" required="" value="<?php echo $bairro->getNmBairro(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <label for="cidade">Cidade</label>
                        <select id="cidade" class="form-control" required="">
                            <option value="">Selecione</option>
                            <?php
                              require_once "beans/Cidade.class.php";
                              require_once "controller/CidadeController.class.php";
                              require_once "services/CidadeListIterator.class.php";
                              $cidade = new Cidade();
                              $cidadeController = new CidadeController();
                              $lista = $cidadeController->getList("");
                              $cidadeListIterator = new CidadeListIterator($lista);
                              while ($cidadeListIterator->hasNextCidade()){
                                  $cidade = $cidadeListIterator->getNextCidade();
                                  $selected = "";
                                  if($bairro->getCidade()->getCdCidade() == $cidade->getCdCidade()){
                                      $selected = "selected";
                                  }
                            ?>
                                  <option <?php echo $selected; ?> value="<?php echo $cidade->getCdCidade(); ?>"><?php echo $cidade->getNmCidade(); ?></option>
                            <?php

                              }
                            ?>
                        </select>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <label for="zona">Zona</label>
                        <select id="zona" class="form-control" required="">
                            <option value="">Selecione</option>
                            <?php
                            require_once "beans/Zona.class.php";
                            require_once "controller/ZonaController.class.php";
                            require_once "services/ZonaListIterator.class.php";
                            $zona = new Zona();
                            $zonaController = new ZonaController();
                            $lista = $zonaController->getList("");
                            $zonaListIterator = new ZonaListIterator($lista);
                            while ($zonaListIterator->hasNextZona()){
                                $zona = $zonaListIterator->getNextZona();
                                $selected = "";
                                if($bairro->getZona()->getCdZona() == $zona->getCdZona()){
                                    $selected = "selected";
                                }
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $zona->getCdZona(); ?>"><?php echo $zona->getDsZona(); ?></option>
                                <?php

                            }
                            ?>
                        </select>
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="pais.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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




    <script src="js/bairro.js"></script>

 </body>
</html>