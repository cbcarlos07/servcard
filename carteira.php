<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

////include "include/error.php";
include_once "controller/CarteiraController.class.php";
include_once "beans/Carteira.class.php";
include_once "controller/ClienteController.class.php";
include_once "beans/Cliente.class.php";
include_once "services/CarteiraListIterator.class.php";




$id = $_POST['id'];

$carteiraController = new CarteiraController();
$lista = $carteiraController->getListByCarteira($id);
$pListIterator = new CarteiraListIterator($lista);
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
                    <div class="modal-body">Deseja realmente inativar esta carteira de n&ordm; <b><span class="nome"></span></b>? </div>
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

        <link rel="stylesheet" type="text/css" href="css/carteira.css">
        <!-- Modal -->
        <div class="modal fade" id="card-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Carteira</h4>
                    </div>
                    <div class="modal-body">Deseja imprimir carteira de  <b><span class="nome"></span></b>? </div>
                         <div class="col-lg-12" style="margin-left: 35px;">
                             <div class="nome-card"><span class="nome"></span></div>
                             <span class="validade"></span>
                             <span class="carteira"></span>
                             <div class="beneficiario">Nome do Benefici&aacute;rio</div>
                             <div class="text-validade">Validade</div>

                                <img src="images/carteira.jpg" width="450" class="img-responsive">
                         </div>
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

            <div class="col-lg-4" ><h4><a href="#" data-url="cliente.php" class="btn-voltar">Carteira</a> -  <?php echo $cliente->getNmCliente(); ?></h4></div>
            <div class="col-lg-4" >


            </div>
            <div class="col-lg-4">
                <a href="#" data-url="carteiracad.php" data-id="<?php echo $id; ?>" class="btn btn-primary novo-item">Novo Item</a>
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
                                <th>Plano</th>
                                <th>Validade</th>
                                <th>Contrato</th>
                                <th>Titular</th>
                                <th>Ativa?</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $carteira = new Carteira();
                            while ($pListIterator->hasNextCarteira()){
                                $carteira =  $pListIterator->getNextCarteira();
                                $corLinha = "";
                                $inativar = "<a href='#' class='btn-inativar  btn btn-warning btn-xs'
                                           data-toggle='modal'
                                           data-target='#delete-modal'
                                           data-id='".$carteira->getCdCarteira()."'
                                           data-action='I'>Inativar</a>";
                                if($carteira->getSnAtivo() == 'N'){
                                    $corLinha = "#F95959";
                                    $inativar = "<a href='#' 
                                                    data-url='carteirades.php' 
                                                    data-id='".$carteira->getCdCarteira()."' 
                                                    class='btn-acao btn btn-warning btn-xs'
                                                     >Inativada</a>";
                                }
                                if($carteira->getContrato()->getSnAtivo() == 'N'){
                                    $corLinha = "#F95959";
                                    $inativar = "<a href='#' 
                                                    class=' btn btn-warning btn-xs'
                                                     >Contrato Desativado</a>";
                                }
                                ?>
                                <tr style="background: <?php echo $corLinha; ?>">

                                    <th scope="row"><?php
                                        $nrCarteira1 = substr($carteira->getCdCarteira(),0,5);
                                        $nrCarteira2 = substr($carteira->getCdCarteira(),5,5);
                                        $nrCarteira3 = substr($carteira->getCdCarteira(),11,5);
                                        $nrCarteira4 = substr($carteira->getCdCarteira(),15,5);
                                        echo "$nrCarteira1 $nrCarteira2 $nrCarteira3 $nrCarteira4"; ?></th>
                                    <td><?php echo $carteira->getContrato()->getPlano()->getDsPlano(); ?></td>
                                    <td><?php
                                        $dataArray = explode('-',$carteira->getDtValidade());
                                        $ano = $dataArray[0];
                                        $mes = $dataArray[1];
                                        $dia = $dataArray[2];
                                        echo "$dia/$mes/$ano"; ?></td>
                                    <td><div style="text-align: center;"></div> <?php echo $carteira->getContrato()->getCdContrato(); ?></div></td>
                                    <td><?php echo $carteira->getContrato()->getCliente()->getNmCliente();  ?></td>
                                    <td><?php echo $carteira->getSnAtivo();  ?></td>
                                    <td class="action">
                                        <a href="#" data-url="carteiraalt.php" data-id="<?php echo $carteira->getCdCarteira();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                        <a href="#" class="btn-mostrar btn btn-warning btn-xs"
                                           data-toggle="modal"
                                           data-target="#card-modal"
                                           data-nome="<?php echo $carteira->getCliente()->getNmCliente().' '.$carteira->getCliente()->getNmSobrenome(); ?>"
                                           data-id="<?php echo "$nrCarteira1 $nrCarteira2 $nrCarteira3 $nrCarteira4"; ?>"
                                           data-validade="<?php echo "$dia/$mes/$ano"; ?>"
                                           data-action="E">Visulizar</a>
                                        <?php echo $inativar; ?>
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
        <script src="js/carteira.js"></script>
    </section>

 </body>
</html>
