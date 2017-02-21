<?php include "include/htmlParts.php"; ?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php getHeader(); ?>
   
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
    <!-- left side start-->
		<?php getMenu(); ?>
    <!-- left side end-->
    
    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  getSupBar(); ?>
			<!--notification menu end -->
            <link href="css/search.css" rel='stylesheet' type='text/css' />
            <div class="row"></div>
            <br>
            <div class="col-lg-4"><h2>Pa&iacute;s</h2></div>
            <div class="col-lg-4">

                    <form action="javascript:void(0);" method="get">

                        <fieldset>

                            <ul class="toolbar clearfix">
                                <li><input type="search" id="search" placeholder="O que você está buscando?"></li>
                                <li><button type="submit" id="btn-search"><span class="fontawesome-search"></span></button></li>

                            </ul>

                        </fieldset>

                    </form>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-primary">Novo Item</button>
            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php getFooter(); ?>
        <!--footer section end-->
	</section>
    <script>
        $( function() {
            $('#btn-search').on('click', function(e) {
                e.preventDefault();
                $('#search').animate({width: 'toggle'}).focus();

            });
        } () );

    </script>
<?php  getEndFileHtml(); ?>