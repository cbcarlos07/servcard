

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
    
    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  include "include/supbar.php"; ?>
			<!--notification menu end -->
            <link href="css/search.css" rel='stylesheet' type='text/css' />
            <div class="row"></div>
            <br>
            <div class="col-lg-4"><h2>Pa&iacute;s</h2></div>
            <div class="col-lg-4">

                    <form action="javascript:void(0);" method="get">

                        <fieldset>

                            <ul class="toolbar clearfix">
                                <li><input type="search" id="search" placeholder="O que você est&eacute; buscando?"></li>
                                <li><button type="submit" id="btn-search"><span class="fontawesome-search"></span></button></li>

                            </ul>

                        </fieldset>

                    </form>
            </div>
            <div class="col-lg-4">
                <a href="#" data-url="paiscad.php" class="btn btn-primary novo-item">Novo Item</a>
            </div>
            <div class="row"></div>
            <hr />

            <div class="col-lg-12">
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
                       <td><?php echo $pais->getCdPais();  ?></td>
                       <td><?php echo $pais->getDsPais();  ?></td>
                       <td class="action">
                           <a href="#" class="btn btn-primary btn-xs">Alterar</a>
                           <a href="#" class="btn btn-warning btn-xs">Excluir</a>
                       </td>
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
