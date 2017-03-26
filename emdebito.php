

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include "include/error.php";
$descricao = "";

if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}
$pagina = (isset($_POST['pagina'])) ? $_POST['pagina'] : 1;
include_once "controller/ContratoController.class.php";
include_once "beans/Contrato.class.php";
include_once "services/ContratoListIterator.class.php";


$contratoController = new ContratoController();
$total = $contratoController->getTotalClienteDivida();

//seta a quantidade de itens por página, neste caso, 2 itens
$registros = 10;
//$registros = (isset($_POST['registros'])) ? $_POST['registros'] : 10;

//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total/$registros);


//variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;
$lista = $contratoController->getClienteDivida($descricao, $inicio, $registros);
$pListIterator = new ContratoListIterator($lista);



?>


<?php include "include/head.php"; ?>


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


            <br>

            <div class="col-lg-1" ><h2>Contrato</h2></div>
            <div class="col-lg-7" >

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-pesquisa">
                    <input type="hidden" name="acao" value="P">
                    <div class="input-group h2">
                        <input  name="search"  id="search" class="form-control">
                        <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                          </span>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <a href="#" data-url="debitoficha.php" class="btn btn-success lnr lnr-printer btn-print">Imprimir</a>
            </div>
            <div class="row"></div>
            <hr />
            <div class="mensagem alert "></div>
            <script src="js/tooltip.js"></script>
            <div id="page-wrapper" class="tabela">
            <div class="graphs">
                <div class="xs tabls">
                    <div class="bs-example4" data-example-id="contextual-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Contrato</th>
                                <th>Plano</th>
                                <th>Respons&aacute;vel</th>
                                <th>N&ordm; de Parcelas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contrato = new Contrato();
                            while ($pListIterator->hasNextContrato()){
                                $contrato =  $pListIterator->getNextContrato();

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $contrato->getCliente()->getCdCliente(); ?></th>
                                    <td><?php echo $contrato->getCliente()->getNmCliente()." ".$contrato->getCliente()->getNmSobrenome(); ?></td>
                                    <td><?php echo $contrato->getCdContrato(); ?></td>
                                    <td><?php echo $contrato->getPlano()->getDsPlano(); ?></td>
                                    <td><?php echo $contrato->getResponsavel()->getNmUsuario(); ?></td>
                                    <?php
                                     $total = $contratoController->getTotalAtraso($contrato->getCdContrato());
                                    ?>
                                    <td><a href="#" data-url="detalhe.php" data-contrato="<?php echo $contrato->getCdContrato()?>" class="btn-detalhe"><?php echo $total; ?></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                 <div id="buttom" class="row">
                     <div class="col-md-12">
                         <ul class="pagination">
                             <?php

                             if($pagina == 1){
                                 ?>
                                 <li class="disabled">
                                     <a href="#"
                                        data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                        data-page="">&lt; Anterior</a>
                                 </li>
                                 <?php
                             }else{
                                 ?>
                                 <li class="page-item">  <a href="#"
                                                            data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                                            data-page="<?php echo $pagina-1; ?>"
                                                            class="btn-page">&lt; Anterior</a>
                                 </li>
                                 <?php
                             }

                             for($i = 1; $i < $numPaginas + 1; $i++){
                                 $disabled = "";

                                 if($pagina == $i){
                                     $disabled = "active";
                                 }
                                 ?>

                                 <li class="<?php echo $disabled; ?>">
                                     <a href="#"
                                        data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                        data-page="<?php echo $i; ?>"
                                        class="btn-page"
                                     ><?php echo $i; ?>
                                     </a>
                                 </li>

                                 <?php
                             }
                             ?>
                             <?php
                             if($numPaginas > 1){
                                 ?>
                                 <?php
                                 if($pagina == $numPaginas){
                                     ?>
                                     <li class="disabled"><a href="#"
                                                             data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                                             data-page="<?php echo $pagina + 1; ?>"
                                         >Pr&oacute;ximo &gt; </a>
                                     </li>
                                     <?php
                                 }else {
                                     ?>
                                     <li class="next"><a href="#"
                                                         data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                                         data-page="<?php echo $pagina + 1; ?>"
                                                         class="btn-page">Pr&oacute;ximo &gt; </a>
                                     </li>
                                     <?php
                                 }
                             }
                             ?>

                         </ul>
                     </div>


                 </div>



                </div>
            </div>
        </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script src="js/debito.js"></script>

    </section>

 </body>
</html>
