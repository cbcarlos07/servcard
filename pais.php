

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

include_once "controller/PaisController.class.php";
include_once "beans/Pais.class.php";
include_once "services/PaisListIterator.class.php";


$pc = new PaisController();
$lista = $pc->getList($descricao);
$pListIterator = new PaisListIterator($lista);



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
            <link href="css/search.css" rel='stylesheet' type='text/css' />
            <div class="row"></div>
            <br>

            <div class="col-lg-1" ><h2>Pa&iacute;s</h2></div>
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
                <a href="#" data-url="paiscad.php" class="btn btn-primary novo-item">Novo Item</a>
            </div>
            <div class="row"></div>
            <hr />
            <div class="mensagem alert "></div>
            <div class="col-md-12 col-lg-12" style="margin-left: 10%; margin-top: -5%;">
                <table class="table table-responsive table-hover">
                    <thead>
                       <th>C&oacute;digo</th>
                       <th>Pa&iacute;s</th>
                    </thead>
                    <tbody>
                      <?php
                      $pais = new Pais();
                      while ($pListIterator->hasNextPais()){
                          $pais = $pListIterator->getNextPais();
                      ?>
                       <tr>
                           <td><?php echo $pais->getCdPais();  ?></td>
                           <td><?php echo $pais->getDsPais();  ?></td>
                           <td class="action">
                               <a href="#" data-url="paisalt.php" data-id="<?php echo $pais->getCdPais();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                               <a href="#" class="delete btn btn-warning btn-xs"
                                  data-toggle="modal"
                                  data-target="#delete-modal"
                                  data-nome="<?php echo $pais->getDsPais(); ?>"
                                  data-id="<?php echo $pais->getCdPais(); ?>"
                                  data-action="E">Excluir</a>
                           </td>
                       </tr>
                      <?php } ?>
                    </tbody>
                </table>

            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script src="js/pais.js"></script>
    </section>
    <script>
        $( function() {
            $('#btn-search').on('click', function(e) {
                e.preventDefault();
                $('#search').animate({width: 'toggle'}).focus();

            });
        } () );

    </script>
 </body>
</html>
