

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

            <div class="row"></div>
            <br />
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <form method="post" id="form-cad">
                    <div class="form-group">
                        <label>Pa&iacute;s</label>
                        <input id="pais" class="form-control" />
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success">Salvar</button>
                        <button class="btn btn-warning">Cancelar</button>
                    </div>
                </form>
            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->
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
<?php  include "include/enfile.php";?>