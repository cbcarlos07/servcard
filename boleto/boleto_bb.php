<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +--------------------------------------------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>              		             				|
// | Desenvolvimento Boleto Banco do Brasil: Daniel William Schultz / Leandro Maniezo / Rog�rio Dias Pereira|
// +--------------------------------------------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$valor        = $_POST['valor'];
$vencimento   = $_POST['vencimento'];
$cdcliente    = $_POST['cliente'];
$cdcontrato   = $_POST['contrato'];
$nrparcela    = $_POST['parcela'];
include "../include/error.php";
include "../beans/Conta.class.php";
include "../controller/ContaController.class.php";
include "../beans/Cliente.class.php";
include "../controller/ClienteController.class.php";
include "../beans/Contrato.class.php";
include "../controller/ContratoController.class.php";
$cliente = new Cliente();
$clienteController = new ClienteController();
//echo "Codigo: ".$cdcliente;
$cliente = $clienteController->obterCliente($cdcliente);

$conta = new Conta();
$contaController = new ContaController();
$conta = $contaController->obterContaAtual();

$contrato = new Contrato();
$contratoController = new ContratoController();
$contrato = $contratoController->obterContrato($cdcontrato);



$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = $conta->getVlTaxaBoleto();
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $valor; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = "87654";
//$dadosboleto["numero_documento"] = "27.030195.10";	// Num do pedido ou do documento
$dadosboleto["numero_documento"] = $cdcontrato;	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$cep1 = substr($cliente->getNrCep(), 0,2);
$cep2 = substr($cliente->getNrCep(), 2,3);
$cep3 = substr($cliente->getNrCep(), 5,3);
$cep = "$cep1.$cep2-$cep3";
$logradouro = getEndereco($cliente->getNrCep(), 'logradouro');
$cidade = getEndereco($cliente->getNrCep(), 'localidade');
$bairro = getEndereco($cliente->getNrCep(), 'bairro');
$estado = getEndereco($cliente->getNrCep(), 'uf');
$dadosboleto["sacado"] = $cliente->getNmCliente()." ".$cliente->getNmSobrenome();
$dadosboleto["endereco1"] = $logradouro;
$dadosboleto["endereco2"] = $cidade."-".$estado."-".$cep; //"Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de ".$contrato->getPlano()->getDsPlano();
$dadosboleto["demonstrativo2"] = "Mensalidade referente a $nrparcela &ordf parcela<br>Taxa banc&aacute;ria - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "Servcard";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- ";//Sr. Caixa, cobrar multa de 2% ap�s o vencimento
$dadosboleto["instrucoes2"] = "-";//- Receber at� 10 dias ap�s o vencimento
$dadosboleto["instrucoes3"] = "";//- Em caso de d�vidas entre em contato conosco: xxxx@xxxx.com.br
$dadosboleto["instrucoes4"] = "";//&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "1";
$dadosboleto["valor_unitario"] = $valor;
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - BANCO DO BRASIL
$dadosboleto["agencia"] = "9999"; // Num da agencia, sem digito
$dadosboleto["conta"] = "99999"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - BANCO DO BRASIL
$dadosboleto["convenio"] = "7777777";  // Num do conv�nio - REGRA: 6 ou 7 ou 8 d�gitos
$dadosboleto["contrato"] = "$cdcontrato"; // Num do seu contrato
$dadosboleto["carteira"] = "18";
$dadosboleto["variacao_carteira"] = "-019";  // Varia��o da Carteira, com tra�o (opcional)

// TIPO DO BOLETO
$dadosboleto["formatacao_convenio"] = "7"; // REGRA: 8 p/ Conv�nio c/ 8 d�gitos, 7 p/ Conv�nio c/ 7 d�gitos, ou 6 se Conv�nio c/ 6 d�gitos
$dadosboleto["formatacao_nosso_numero"] = "2"; // REGRA: Usado apenas p/ Conv�nio c/ 6 d�gitos: informe 1 se for NossoN�mero de at� 5 d�gitos ou 2 para op��o de at� 17 d�gitos

/*
#################################################
DESENVOLVIDO PARA CARTEIRA 18

- Carteira 18 com Convenio de 8 digitos
  Nosso n�mero: pode ser at� 9 d�gitos

- Carteira 18 com Convenio de 7 digitos
  Nosso n�mero: pode ser at� 10 d�gitos

- Carteira 18 com Convenio de 6 digitos
  Nosso n�mero:
  de 1 a 99999 para op��o de at� 5 d�gitos
  de 1 a 99999999999999999 para op��o de at� 17 d�gitos

#################################################
*/


// SEUS DADOS
$dadosboleto["identificacao"] = "Boleto Banc&aacute;rio";//BoletoPhp - C�digo Aberto de Sistema de Boletos
$dadosboleto["cpf_cnpj"] = "";
$dadosboleto["endereco"] = "Coloque o endere&ccedil;o da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Manaus / Amazonas";
$dadosboleto["cedente"] = "Servard -  Servi&ccedil;os de cart&otilde;oes de Desconto";

// N�O ALTERAR!
include("include/funcoes_bb.php"); 
include("include/layout_bb.php");
//funcao getEndereco via json   nova funcao
function getEndereco($cep, $param){
//                header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents("https://viacep.com.br/ws/$cep/json/");
    $obj = json_decode($json);
    $retorno = "";
    if($param == 'logradouro'){
        $retorno = $obj->logradouro;
    }else if($param == 'localidade'){
        $retorno = $obj->localidade;
    }else if($param == 'uf'){
        $retorno = $obj->uf;
    }else if($param == 'bairro'){
        $retorno = $obj->bairro;
    }

    return $retorno;
}

