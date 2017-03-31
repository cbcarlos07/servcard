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


include_once "beans/Cliente.class.php";
include_once "controller/ClienteController.class.php";
include_once "beans/ContratoMensal.class.php";
include_once "controller/ContratoMensalController.class.php";
include_once "services/ContratoMensalListIterator.class.php";
include      "beans/Conta.class.php";
include      "controller/ContaController.class.php";


$contratoMensal = new ContratoMensal();
$contratoMensalController = new ContratoMensalController();

$lista = $contratoMensalController->getListaMensalAtrasada($contrato);

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

                                       <th>Parcela</th>
                                       <th>Vencimento</th>
                                       <th>Valor</th>
                                   </tr>
                                </thead>
                                <tbody>
                                   <?php
                                     while ($contratoMensalIterator->hasNextContratoMensal()) {
                                         $contratoMensal = $contratoMensalIterator->getNextContratoMensal();
                                         $dataMySQL = explode('-', $contratoMensal->getDtVencimento());
                                         $novaData = "$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]";

                                         ?>
                                         <tr >

                                             <td><?php echo $contratoMensal->getNrParcela(); ?></td>
                                             <td><?php echo $novaData; ?></td>
                                             <td><?php echo 'R$ '.number_format($contratoMensal->getNrValor(),2,',','.');?></td>

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
