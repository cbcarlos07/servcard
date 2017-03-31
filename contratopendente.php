<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

//include "include/error.php";
include_once "controller/CarteiraController.class.php";
include_once "beans/Carteira.class.php";
include_once "controller/ClienteController.class.php";
include_once "beans/Cliente.class.php";
include_once "services/CarteiraListIterator.class.php";




$id = $_POST['id'];
$cliente = $_POST['cliente'];

$carteiraController = new CarteiraController();
$lista = $carteiraController->getListaDependente($id);
$pListIterator = new CarteiraListIterator($lista);







?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
 <body class="sticky-header left-side-collapsed"  >
    <section>
    <!-- left side start-->
		<?php include "include/menu.html"  ?>
    <!-- left side end-->



    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  include "include/supbar.php"; ?>
			<!--notification menu end -->


            <br>

            <div class="col-lg-4" ><h4><a href="#" data-url="contrato.php" data-id="<?php echo $cliente; ?>" class="btn-voltar">Dependentes do Contrato </a> -  <?php echo $id; ?></h4></div>
            <div class="col-lg-4" >


            </div>
            <div class="col-lg-4">
                <a href="#" data-url="contrato.php" data-id="<?php echo $cliente; ?>" class="btn btn-primary btn-voltar">Voltar</a>
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
                                <th>Nome</th>
                                <th>C&oacute;digo</th>
                                <th>Validade</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $carteira = new Carteira();
                            while ($pListIterator->hasNextCarteira()){
                                $carteira =  $pListIterator->getNextCarteira();

                                ?>
                                <tr >

                                    <th scope="row"><?php
                                        $nrCarteira1 = substr($carteira->getCdCarteira(),0,5);
                                        $nrCarteira2 = substr($carteira->getCdCarteira(),5,5);
                                        $nrCarteira3 = substr($carteira->getCdCarteira(),11,5);
                                        $nrCarteira4 = substr($carteira->getCdCarteira(),15,5);
                                        echo "$nrCarteira1 $nrCarteira2 $nrCarteira3 $nrCarteira4"; ?></th>
                                    <td><?php echo $carteira->getCliente()->getNmCliente(); ?></td>
                                    <td><?php echo $carteira->getCliente()->getCdCliente(); ?></td>
                                    <td><?php
                                        $dataArray = explode('-',$carteira->getDtValidade());
                                        $ano = $dataArray[0];
                                        $mes = $dataArray[1];
                                        $dia = $dataArray[2];
                                        echo "$dia/$mes/$ano"; ?></td>



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
