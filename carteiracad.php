<?php
include "include/head.php";
$id = $_POST['id'];
////include "include/error.php";


 ?>


<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->



<link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />
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


            <!-- Modal -->
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalLabel">Escolher Titular - Contrato</h4>
                        </div>
                        <div class="modal-body">

                            <div class="col-lg-12 container-fluid">
                                <div class="form-group col-lg-12">
                                    <label for="pesquisa">Digite o nome do Titular</label>
                                    <input id="pesquisa" class="form-control" onkeyUp="carregar()" autofocus/>
                                </div>
                                <div class="table" style="height: 150px; overflow: auto; font-size: small;">

                                    <table id="tabela" class="table table-hover"></table>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="contrato-modal">Contrato</label>
                                    <input id="contrato-modal" class="form-control col-lg-2" disabled/>
                                </div>
                                <div class="col-lg-10 form-group">
                                    <label for="nome-modal">Titular</label>
                                    <input id="nome-modal" class="form-control col-lg-10" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="modal-footer">
                            <!--<a href="#" type="button"  class="btn btn-primary delete-yes">Sim</a>-->
                            <button type="button" class="btn btn-default btn-ok" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row"></div>
            <br />
            <div style="text-align: center;">
            <h3>Cadastro de Carteira</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="0" type="hidden">
                    <input id="cliente" value="<?php echo $id; ?>" type="hidden">
                    <input id="id-contrato" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <div class="form-group col-lg-12">
                        <label for="carteira">Carteira</label>
                        <input id="carteira" class="form-control" required="" placeholder="AINDA N&Atilde;O POSSUI" disabled/>
                    </div>
                    <div class="row"></div>

                    <div class="checkbox-inline1 col-lg-3"style="margin-top: 15px;"><label><input type="checkbox" value="S" id="ativo" checked> Ativo?</label></div>
                    <div class="checkbox-inline1 col-lg-3"style="margin-top: 15px;"><label><input type="checkbox" value="S" id="tptitular" disabled=""> Titular?</label></div>
                    <div class="row"></div>
                    <div class="form-group col-lg-7">
                        <label for="contrato">Contrato - <a href="#" data-toggle="modal" data-target="#delete-modal" class="delete"><span style="font-size: 12px;">Escolher Contratos</span></a></label>

                    </div>
                    <div class="row"></div>
                        <div class="col-lg-2 form-group">
                            <label for="contrato">Contrato</label>
                            <input id="contrato" class="form-control col-lg-2" disabled/>
                        </div>
                        <div class="col-lg-10 form-group">
                            <label for="nome">Titular</label>
                            <input id="nome" class="form-control col-lg-10" disabled/>
                        </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-3">
                        <label for="validade">Vencimento</label>
                        <input id="validade" class="form-control data-nasc" required="" />
                    </div>



                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="carteira.php" data-id="<?php echo $id; ?>" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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
    <script src="js/jquery.datetimepicker.full.js"></script>



    <script src="js/carteira.js"></script>

 </body>
</html>