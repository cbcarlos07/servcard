<?php include "include/head.php"; ?>

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

 // paginacao
$pagina = (isset($_POST['pagina'])) ? $_POST['pagina'] : 1;



include_once "controller/ClienteController.class.php";
include_once "beans/Cliente.class.php";
include_once "services/ClienteListIterator.class.php";


$clienteController = new ClienteController();
$total = $clienteController->getTotalCliente();

//seta a quantidade de itens por página, neste caso, 2 itens
$registros = 10;
//$registros = (isset($_POST['registros'])) ? $_POST['registros'] : 10;

//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total/$registros);


//variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;

$lista = $clienteController->getList($descricao, $inicio, $registros);
$pListIterator = new ClienteListIterator($lista);



?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
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
            <!--
            <div class="col-lg-5 form-group">

              <label for="registro">Registros</label>
                <select class="form-control registros" id="registro">
                    <option value="10" <?php $registros == 10 ? $select = "selected" : $select = ''; echo $select; ?> >10</option>
                    <option value="15" <?php $registros == 15 ? $select = "selected" : $select = ''; echo $select; ?>>15</option>
                    <option value="20" <?php $registros == 20 ? $select = "selected" : $select = ''; echo $select; ?>>20</option>
                    <option value="25" <?php $registros == 25 ? $select = "selected" : $select = ''; echo $select; ?>>25</option>
                    <option value="30" <?php $registros == 30 ? $select = "selected" : $select = ''; echo $select; ?>>30</option>
                </select>
            </div>
            -->
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
                                    <td><?php echo $cliente->getNmCliente()." ".$cliente->getNmSobrenome(); ?></td>
                                    <td><?php
                                        $cpf1 = substr($cliente->getNrCpf(), 0,3);
                                        $cpf2 = substr($cliente->getNrCpf(), 3,3);
                                        $cpf3 = substr($cliente->getNrCpf(), 6,3);
                                        $cpf4 = substr($cliente->getNrCpf(), 9,2);
                                        echo $cpf = "$cpf1.$cpf2.$cpf3-$cpf4";
                                        ?></td>
                                    <td>
                                        <?php
                                          $telefone = $cliente->getNrTelefone();
                                          $length =  strlen($telefone);
                                          if($length == 11 )
                                              echo "( ".substr($telefone, 0,2).")".substr($telefone,2,5)."-".substr($telefone,7,4);
                                          else
                                              echo "( ".substr($telefone, 0,2).")".substr($telefone,2,4)."-".substr($telefone,6,4);
                                        ?>
                                    </td>

                                    <td class="action">
                                        <a href="#" data-url="clientealt.php" data-id="<?php echo $cliente->getCdCliente();  ?>"  class="btn btn-danger btn-xs btn-alterar btn-acao">Alterar</a>
                                        <a href="#" data-url="contrato.php"   data-id="<?php echo $cliente->getCdCliente(); ?>"   class="btn-acao btn btn-danger btn-xs btn-acao">Contrato</a>
                                        <a href="#" data-url="clienteficha.php" data-id="<?php echo $cliente->getCdCliente();  ?>" class="btn btn-danger btn-xs btn-imprimir btn-acao">Imprimir</a>
                                        <a href="#" data-url="carteira.php" data-id="<?php echo $cliente->getCdCliente();  ?>" class="btn btn-danger btn-xs btn-carteira btn-acao">Carteira</a>
                                    </td>

                                </tr>
                                <?php // echo 'R$ '.number_format($cliente->getNrValor(),2,',','.'); ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
<!-- INICIO DA PAGINAÇÃO -->
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
                    <!-- FIM DA PAGINAÇÃO -->
            </div>
        </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script>
            $('.btn-page').on('click', function(){
                //alert('Pagina');
                var url      = $(this).data('url');
                var pagina   = $(this).data('page');
                var form     = $('<form action="'+url+'" method="post">'+
                                '<input type="hidden" name="pagina" value="'+pagina+'">'+
                                '</form>');
                $('body').append(form);
                form.submit();

            });

            $('.registros').on('change', function () {
                var registro = document.getElementById('registro').value;
                var form     = $('<form method="post" action="cliente.php">'+
                    '<input type="hidden" name="registros" value="'+registro+'">'+
                    '</form>');
                $('body').append(form);
                form.submit();
            });
        </script>
        <script src="js/cliente.js"></script>
    </section>

 </body>
</html>
