<?php
include "include/htmlParts.php";
?>


<?php echo getHeader(); ?>
<body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
    <!-- left side start-->
        <?php getMenu(); ?>
    <!-- left side end-->

        <!-- Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
                    </div>
                    <div class="modal-body"><span class="msg"></span> <b><span class="nome"></span>?</b> </div>
                    <div class="modal-footer">
                        <a href="#" type="button"  class="btn btn-primary delete-yes">Sim</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                    </div>
                </div>
            </div>
        </div>


    <!-- main content start-->
		<div class="main-content main-content1">
			<!-- header-starts -->
			<?php getSupBar();  ?>
	<!-- //header-ends -->
			  <?php include "pais.php";
			       getTableCountry("%");
			   ?>
		</div>
		<!--footer section start-->
            <?php getFooter() ?>
        <!--footer section end-->
	</section>
