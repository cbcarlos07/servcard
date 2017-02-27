

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
            <h3>Cadastro de Endere&ccedil;o</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <input id="cdbairro" value="0" type="hidden">
                    <div class="form-group col-lg-4">
                        <label for="cidade">Cidade</label>
                        <select id="cidade" class="form-control" required="">
                            <option value="">Selecione</option>
                            <?php
                                require_once "beans/Cidade.class.php";
                                require_once "controller/CidadeController.class.php";
                                require_once "services/CidadeListIterator.class.php";
                                $cidade = new Cidade();
                                $cc = new CidadeController();
                                $lista = $cc->getList("");
                                $cidadeListIterator = new CidadeListIterator($lista);
                                while ($cidadeListIterator->hasNextCidade()){
                                    $cidade = $cidadeListIterator->getNextCidade();
                            ?>
                                <option value="<?php echo $cidade->getCdCidade(); ?>"><?php echo $cidade->getNmCidade(); ?></option>
                            <?php
                                 }

                            ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control" required=""/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-10">
                        <label for="logradouro">Logradouro</label>
                        <input id="logradouro" class="form-control" required=""/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="tplogradouro">Tipo de Logradouro</label>
                        <select id="tplogradouro" class="form-control" required="">
                            <?php
                              require_once "beans/TpLogradouro.class.php";
                              require_once "controller/TpLogradouroController.class.php";
                              require_once "services/TpLogradouroListIterator.class.php";

                              $tpLogradouro = new TpLogradouro();
                              $tlc = new TpLogradouroController();
                              $lista = $tlc->getList("");
                              $tplList = new TpLogradouroListIterator($lista);
                              while ($tplList->hasNextTpLogradouro()){
                                  $tpLogradouro = $tplList->getNextTpLogradouro();
                               ?>
                                  <option value="<?php echo $tpLogradouro->getCdTpLogradouro(); ?>"><?php echo $tpLogradouro->getDsTpLogradouro(); ?></option>
                            <?php
                              }
                            ?>
                        </select>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="bairro">Bairro</label>
                        <select class="form-control" id="bairro">
                            <option value="">Selecione uma Cidade</option>
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



    <script src="js/jquery.mask.js"></script>
    <script src="js/endereco.js"></script>

 </body>
</html>