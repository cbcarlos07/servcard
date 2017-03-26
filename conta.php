

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

include_once "controller/ContaController.class.php";
include_once "beans/Conta.class.php";
include_once "services/ContaListIterator.class.php";


$contaController = new ContaController();
$lista = $contaController->getList($descricao);
$pListIterator = new ContaListIterator($lista);



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
                    <div class="modal-body"><span class="msg"></span> <b><span class="nome"></span></b>? </div>
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

            <div class="col-lg-1" ><h2>Conta</h2></div>
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
                <a href="#" data-url="contacad.php" class="btn btn-primary novo-item">Novo Item</a>
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
                                <th>Ag&ecirc;ncia</th>
                                <th>Conta</th>
                                <th>Banco</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conta = new Conta();
                            while ($pListIterator->hasNextConta()){
                                $conta =  $pListIterator->getNextConta();
                                $bgcolor = "";
                                $atual = "N&atilde;o Atual";
                                $opcao = "S";
                                $classbtn = "btn-danger";
                                if($conta->getSnAtual() == 'S'){
                                    $bgcolor = "#A7D7C5";
                                    $atual = "Atual";
                                    $classbtn = "btn-success";
                                    $opcao = 'N';
                                }

                                ?>
                                <tr style="background: <?php echo $bgcolor; ?>">
                                    <th scope="row"><?php echo $conta->getCdConta(); ?></th>
                                    <td><?php echo $conta->getNrAgencia()."-".$conta->getNrDigAgencia(); ?></td>
                                    <td><?php echo $conta->getNrConta()."-".$conta->getNrDigConta(); ?></td>
                                    <td><?php echo $conta->getNmBanco(); ?></td>
                                    <td class="action">
                                        <a href="#" data-url="contaalt.php" data-id="<?php echo $conta->getCdConta();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                        <a href="#" class="delete btn <?php echo $classbtn; ?> btn-xs"
                                           data-toggle="modal"
                                           data-target="#delete-modal"
                                           data-msg="Mudar o status da conta "
                                           data-nome="<?php echo $conta->getNrConta()."-".$conta->getNrDigConta(); ?>"
                                           data-id="<?php echo $conta->getCdConta(); ?>"
                                           data-atual="<?php echo $opcao; ?>"
                                           data-action="T"><?php echo $atual ?></a> <!-- Al[T]erar-->
                                        <a href="#" class="delete btn btn-warning btn-xs"
                                           data-toggle="modal"
                                           data-msg="Deseja realmente excluir "
                                           data-target="#delete-modal"
                                           data-nome="<?php echo $conta->getNrConta()."-".$conta->getNrDigConta(); ?>"
                                           data-id="<?php echo $conta->getCdConta(); ?>"
                                           data-atual="S"
                                           data-action="E">Excluir</a>
                                    </td>
                                </tr>
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
        <script src="js/conta.js"></script>
    </section>

 </body>
</html>
