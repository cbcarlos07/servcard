<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
//include "include/error.php";

$contrato = $_POST['contrato'];
$cdcliente  = $_POST['cliente'];

include_once "beans/Cliente.class.php";
include_once "controller/ClienteController.class.php";
include_once "beans/ContratoMensal.class.php";
include_once "controller/ContratoMensalController.class.php";
include_once "services/ContratoMensalListIterator.class.php";
include      "beans/Conta.class.php";
include      "controller/ContaController.class.php";
$cliente = new Cliente();
$clienteController = new ClienteController();

$cliente = $clienteController->getCliente($cdcliente);

$contratoMensal = new ContratoMensal();
$contratoMensalController = new ContratoMensalController();

$lista = $contratoMensalController->getLista($contrato);

$contratoMensalIterator = new ContratoMensalListIterator($lista);

$conta = new Conta();
$contaController = new ContaController();

?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
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


            <br>

            <div class="col-lg-12" style="text-align: center;"><h3 >Mensalidades</h3></div>

            <div class="row"></div>
            <div class="col-lg-12">
                <table>
                    <tr>
                        <td><span>Contrato N&ordm;:</span></td>
                        <td>&nbsp;<b><?php echo $contrato; ?></b></td>
                    </tr>
                    <tr>
                        <td align="right"><span>Nome:</span></td>
                        <td>&nbsp;<b><?php echo $cliente->getNmCliente()?></b></td>
                    </tr>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="pagamento-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalLabel">Registrar Pagamento</h4>
                        </div>
                        <div class="modal-body">Deseja realmente registrar o pagamento no valor de  <b><span class="nome"></span></b>? </div>
                        <div class="modal-footer">
                            <a href="#" type="button"  class="btn btn-primary pay-yes">Sim</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                        </div>
                    </div>
                </div>
            </div>


            <hr />
            <script src="js/tooltip.js"></script>
            <div class="col-lg-5">
               <div class="mensagem alert"></div>
            </div>

            <div class="row"></div>
            <div id="page-wrapper" class="tabela">
            <div class="graphs">
                <div class="xs tabls">

                    <div class="bs-example4" data-example-id="contextual-table">
                        <div id="tabela">
                          <form name="form1">
                            <table class="table table-hover" id="tabela">
                                <thead>
                                   <tr>
                                       <th><input type='checkbox' name='tudo' onclick='verificaStatus(this)' /></th>
                                       <th>Parcela</th>
                                       <th>Vencimento</th>
                                       <th>Valor</th>
                                       <th></th>
                                       <th></th>
                                   </tr>
                                </thead>
                                <tbody>
                                   <?php
                                     while ($contratoMensalIterator->hasNextContratoMensal()) {
                                         $contratoMensal = $contratoMensalIterator->getNextContratoMensal();
                                         $dataMySQL = explode('-', $contratoMensal->getDtVencimento());
                                         $novaData = "$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]";
                                         $linhapg = "";
                                         $registrar = "Registrar Pagamento";
                                         $registrar_btn = "btn-primary";
                                         $registrar_modal = "#pagamento-modal";
                                         $intTotal = $contaController->getContaTotal();
                                         $boleto = "<a href='conta.php' class='btn btn-default' title='Cadastre uma conta primeiro' >Cadastrar Conta</a>";

                                         if($intTotal > 0){
                                             $boleto = "<a href='#' data-banco='".$conta->getDsSiglaBanco()."' data-cliente='".$cdcliente."' data-vencimento='".$novaData."' data-valor='".$contratoMensal->getNrValor()."' data-contrato='".$contrato."' data-parcela='".$contratoMensal->getNrParcela()."' class='btn btn-xs btn-success btn-boleto'>Gerar boleto</a>";;
                                             $conta = $contaController->getContaAtual();
                                             $btnAlt = "";
                                             $btnAtivo = "";
                                         }

                                         if(getDias($contratoMensal->getDtVencimento()) <0 ){
                                             $linhapg = "#ff8000";
                                             $registrar = "Pagamento (em atraso)";
                                             $registrar_btn = "btn-warning";
                                         }

                                         if ($contratoMensal->getSnPago() == 'S') {

                                             $linhapg = "#28CC9E";
                                             $registrar = "Pago";
                                             $boleto = "";
                                             $registrar_btn = "btn-danger";
                                             $registrar_modal = "";
                                         }
                                         ?>
                                         <tr style="background: <?php echo $linhapg; ?>">
                                             <td><input type="checkbox" name="ckb[]" value="<?php echo $contratoMensal->getNrParcela(); ?>" /></td>
                                             <td><?php echo $contratoMensal->getNrParcela(); ?></td>
                                             <td><?php

                                                 echo $novaData; ?></td>
                                             <td><?php echo 'R$ '.number_format($contratoMensal->getNrValor(),2,',','.');?></td>

                                             <td class="action" align="center">
                                                 <a href="#"
                                                    data-toggle="modal"
                                                    data-target="<?php echo $registrar_modal; ?>"
                                                    data-contrato="<?php echo $contrato; ?>"
                                                    data-parcela="<?php echo $contratoMensal->getNrParcela(); ?>"
                                                    data-valor="<?php echo 'R$ '.number_format($contratoMensal->getNrValor(),2,',','.'); ?>"
                                                    data-valor1="<?php echo $contratoMensal->getNrValor(); ?>"
                                                    data-vencimento="<?php echo "$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]"; ?>"
                                                    class="btn <?php echo $registrar_btn; ?> btn-xs btn-pgto"><?php echo $registrar; ?></a>
                                                    <?php echo $boleto; ?>
                                             </td>
                                         </tr>
                                         <?php
                                     }
                                   ?>
                                </tbody>
                            </table>
                          </form>
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

        <script src="js/jquery.mask.js"></script>
        <script src="js/pagamento.js"></script>
    </section>

 </body>
</html>

<?php
function getDias($vencimento){
    $time_inicial = geraTimestamp(date('d/m/Y'));
    $dataMySQL = explode('-', $vencimento);
    $time_final   = geraTimestamp("$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]");

    // Calcula a diferença de segundos entre as duas datas:
    $diferenca = $time_final - $time_inicial; // 19522800 segundos
    // Calcula a diferença de dias
    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    return $dias;
}



function geraTimestamp($data) {
    $partes = explode('/', $data);
    return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}
?>
