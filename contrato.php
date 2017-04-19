<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

//include "include/error.php";
include_once "controller/ContratoController.class.php";
include_once "beans/Contrato.class.php";
include_once "controller/ClienteController.class.php";
include_once "beans/Cliente.class.php";
include_once "controller/CarteiraController.class.php";
include_once "services/ContratoListIterator.class.php";




$id = $_POST['id'];


$contratoController = new ContratoController();
$lista = $contratoController->getList($id);
$pListIterator = new ContratoListIterator($lista);
$cliente = new Cliente();

$clienteController = new ClienteController();

$cliente = $clienteController->getCliente($id);





?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
 <body class="sticky-header left-side-collapsed"  >
    <section>
    <!-- left side start-->
		<?php include "include/menu.html"  ?>
    <!-- left side end-->

        <!-- Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Cancelar contrato</h4>
                    </div>
                    <div class="modal-body">Deseja realmente cancelar contrato n&ordm; <b><span class="nome"></span></b>  e todos seus dependentes (se houver) ? </div>
                    <form>
                        <input type="hidden" id="usuario" value="1">

                    <div class="form-group col-lg-12">
                        <label for="observacao" class="form-control-label">Observa&ccedil&atilde;o:</label>
                        <textarea class="form-control" id="observacao"></textarea>
                    </div>
                    </form>
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

            <div class="col-lg-4" ><h4><a href="#" data-url="cliente.php" class="btn-voltar"><img src="images/back.png" width="30" title="Voltar">Contrato</a> -  <?php echo $cliente->getNmCliente(); ?></h4></div>
            <div class="col-lg-4" >


            </div>
            <div class="col-lg-4">
                <a href="#" data-url="contratocad.php" data-id="<?php echo $id; ?>"class="btn btn-primary novo-item">Novo Item</a>
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
                                <th>Data do Contrato</th>
                                <th>Usu&aacute;rio</th>
                                <th>Status</th>
                                <th>Dependentes</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contrato = new Contrato();
                            while ($pListIterator->hasNextContrato()){
                                $contrato =  $pListIterator->getNextContrato();
                                $carteiraController = new CarteiraController();
                                $total = $carteiraController->getTotalDependente($contrato->getCdContrato());
                                $corLinha = "";
                                $desativado = "<a href='#' class='delete btn btn-warning btn-xs'
                                           data-toggle='modal'
                                           data-target='#delete-modal'
                                           data-nome='".$contrato->getCdContrato()."'
                                           data-id='". $contrato->getCdContrato()."'
                                           data-action='D'>Desativar</a>";
                                if($contrato->getSnAtivo() == 'N'){
                                    $corLinha = "#F95959";
                                    $desativado = "<a href='#' data-url='contratodes.php' data-id='".$contrato->getCdContrato()."' class='btn btn-xs btn-default btn-acao'><span style='color: #00aaf1; font-weight: bold'>Desativado</span></a>";
                                }
                                ?>
                                <tr style="background: <?php echo $corLinha; ?>">
                                    <th scope="row"><?php echo $contrato->getCdContrato(); ?></th>
                                    <td><?php
                                        $dataArray = explode('-',$contrato->getDhContrato());
                                        $ano = $dataArray[0];
                                        $mes = $dataArray[1];
                                        $dia = $dataArray[2];
                                        echo "$dia/$mes/$ano"; ?></td>
                                    <td><?php echo $contrato->getUsuario()->getNmUsuario(); ?></td>
                                    <td><?php echo $contrato->getSnAtivo();  ?></td>
                                    <th>
                                        <?php
                                          $link = "0";

                                          if($total > 0){
                                              $link = "<a href='#' 
                                                       data-url='contratopendente.php' 
                                                       data-id='".$contrato->getCdContrato()."'
                                                       class='btn-acao'
                                                       data-cliente='".$id."'>".$total."</a>";

                                          }
                                          echo $link;
                                        ?>
                                    </th>
                                    <td class="action">
                                        <a href="#" data-url="contratoalt.php" data-id="<?php echo $contrato->getCdContrato();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                        <?php echo $desativado; ?>
                                        <a href="#" data-url="contratoficha.php" data-id="<?php echo $contrato->getCdContrato(); ?>" class="btn btn-success btn-xs btn-acao">Imprimir</a>
                                    </td>

                                </tr>
                                <?php // echo 'R$ '.number_format($contrato->getNrValor(),2,',','.'); ?>
                            <?php } ?>
                            </tbody>
                        </table>
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
        <script src="js/contrato.js"></script>
    </section>

 </body>
</html>
