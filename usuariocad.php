

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<?php include "include/head.php"; ?>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.min.js"></script>

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
            <div style="text-align: center;">
            <h3>Cadastro de Usu&aacute;rio</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <input id="atual" value="N" type="hidden">
                    <input id="id-cargo" value="0" type="hidden">

                    <div class="form-group col-lg-12">
                        <label for="usuario">Nome</label>
                        <input id="usuario" class="form-control" required="" placeholder="Digite o nome do usu&aacute;rio"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="login">Login</label>
                        <input id="login" type="text" class="form-control">
                    </div>

                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="senha">Digite a Senha</label>
                        <input id="senha" type="password" class="form-control">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="senha">Repita a Senha</label>
                        <input id="senha" type="password" class="form-control">
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="cargo">Cargo</label>
                        <select id="cargo" class="form-control" required="">
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="cpf">CPF</label>
                        <input id="cpf" type="text" class="form-control">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="rg">RG</label>
                        <input id="rg" type="text" class="form-control">
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="foto">Foto</label>
                        <input id="foto" type="file" class="form-control">
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="pais.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
                    </div>

                </form>
            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

	</section>





    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery-3.1.1.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>



    <script src="js/jquery.mask.js"></script>
    <script src="js/usuario.js"></script>

 </body>
</html>