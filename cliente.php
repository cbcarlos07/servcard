

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$descricao = "";

if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}

include_once "controller/ClienteController.class.php";
include_once "beans/Cliente.class.php";
include_once "services/ClienteListIterator.class.php";


$clienteController = new ClienteController();
$lista = $clienteController->getList($descricao);
$pListIterator = new ClienteListIterator($lista);



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

            <div class="col-lg-1" ><h2>Cliente</h2></div>
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
                <a href="#" data-url="clientecad.php" class="btn btn-primary novo-item">Novo Item</a>
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
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Dependentes</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cliente = new Cliente();
                            while ($pListIterator->hasNextCliente()){
                                $cliente =  $pListIterator->getNextCliente();

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $cliente->getCdCliente(); ?></th>
                                    <td><?php $cliente->getNmCliente(); ?></td>
                                    <td><?php
                                        $cpf1 = substr($endereco->getNrCep(), 0,3);
                                        $cpf2 = substr($endereco->getNrCep(), 3,3);
                                        $cpf3 = substr($endereco->getNrCep(), 6,3);
                                        $cpf4 = substr($endereco->getNrCep(), 10,2);
                                        $cpf = "$cpf1.$cpf2.$cpf3-$cpf4";
                                        ?></td>
                                    <td>
                                        <?php
                                          $telefone = $cliente->getNrTelefone();
                                          $length =  strlen($telefone);
                                          if($length == 11 )
                                              echo "( ".substr($telefone, 0,2).")".substr($telefone,3,5)."-".substr($telefone,8,4);
                                          else
                                              echo "( ".substr($telefone, 0,2).")".substr($telefone,3,4)."-".substr($telefone,7,4);
                                        ?>
                                    </td>
                                    <td>0</td>
                                    <td class="action">
                                        <a href="#" data-url="clientealt.php" data-id="<?php echo $cliente->getCdCliente();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                        <a href="#" class="delete btn btn-warning btn-xs"
                                           data-toggle="modal"
                                           data-target="#delete-modal"
                                           data-nome="<?php echo $cliente->getNmCliente(); ?>"
                                           data-id="<?php echo $cliente->getCdCliente(); ?>"
                                           data-action="E">Excluir</a>
                                    </td>
                                </tr>
                                <?php // echo 'R$ '.number_format($cliente->getNrValor(),2,',','.'); ?>
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
        <script src="js/cliente.js"></script>
    </section>

 </body>
</html>
