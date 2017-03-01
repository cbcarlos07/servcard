

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<?php include "include/head.php"; ?>
<link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
            <h3>Cadastro de Cliente</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <input id="endereco"  type="hidden">
                    <input id="cdestadocivil" value="0" type="hidden">
                    <input id="senhatual" value="N" type="hidden">
                    <div class="form-group col-lg-5">
                        <label for="nome">Primeiro Nome</label>
                        <input id="nome" class="form-control" required=""/>
                    </div>
                    <div class="form-group col-lg-7">
                        <label for="nome">Sobrenome</label>
                        <input id="nome" class="form-control" required=""/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-4">
                        <label for="cpf">CPF</label>
                        <input id="cpf" class="form-control" required="" placeholder="000.000.000.-00"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="rg">RG</label>
                        <input id="rg" class="form-control" required="" placeholder="0000000-0"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="telefone">Telefone  </label>
                        <input id="telefone" type="tel" class="form-control" required="" placeholder="(00)0000-0000"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" required="" placeholder="exemplo@email.com"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="senha">Senha</label>
                        <input id="senha" class="form-control" required="" type="password"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="resenha">Repetir Senha</label>
                        <input id="resenha" class="form-control" required="" type="password"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-3">
                        <label for="nascimento">Data de Nascimento</label>
                        <input id="nascimento" class="form-control data-nasc" required=""/>
                    </div>
                    <div class="form-group col-lg-1">
                        <label for="idade">Idade</label>
                        <input id="idade" class="form-control"  disabled=""/>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="sexo">Sexo</label>
                        <select id="sexo" class="form-control">
                            <option value="">Selecione</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="estadocivil">Estado Civil</label>
                        <select id="estadocivil" class="form-control" ></select>
                    </div>
                    <div class="col-lg-1 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <div style="text-align: center;">
                    <span>Endere&ccedil;o</span>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control" placeholder="00.000-000" />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-6">
                        <label for="logradouro">Logradouro</label>
                        <input id="logradouro" class="form-control" disabled="" />
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" class="form-control" disabled="" />
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="numero">N&uacute;mero</label>
                        <input id="numero" class="form-control"  />
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
    <script src="js/jquery.datetimepicker.full.js"></script>
    <script src="js/calcularIdade.js"></script>

    <script src="js/jquery.mask.js"></script>
    <script src="js/validarcpf.js"></script>
    <script src="js/cliente.js"></script>


 </body>
</html>