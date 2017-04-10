<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers&atilde;o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est&aacute; dispon&iacute;vel sob a Licen&ccedil;a GPL dispon&iacute;vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc&ecirc; deve ter recebido uma c&oacute;pia da GNU Public License junto com     |
// | esse pacote; se n&atilde;o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora&ccedil;&otilde;es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo&atilde;o Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena&ccedil;&atilde;o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Ita&uacute;: Glauber Portella                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul&aacute;rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

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
//$data_venc = $vencimento;
//$valor_cobrado = "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = $valor;
//$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = '12345678';  // Nosso numero - REGRA: M&aacute;ximo de 8 caracteres!
$dadosboleto["numero_documento"] = '0123';	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss&atilde;o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v&iacute;rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE]
$cep1 = substr($cliente->getNrCep(), 0,2);
$cep2 = substr($cliente->getNrCep(), 2,3);
$cep3 = substr($cliente->getNrCep(), 5,3);
$cep = "$cep1.$cep2-$cep3";
$logradouro = getEndereco($cliente->getNrCep(), 'logradouro');
$cidade = getEndereco($cliente->getNrCep(), 'localidade');
$bairro = getEndereco($cliente->getNrCep(), 'bairro');
$estado = getEndereco($cliente->getNrCep(), 'uf');
//$dadosboleto["sacado"] = "Nome do seu Cliente";
$dadosboleto["sacado"] = $cliente->getNmCliente()." ".$cliente->getNmSobrenome();
$dadosboleto["endereco1"] = $logradouro;
$dadosboleto["endereco2"] = $cidade."-".$estado."-".$cep; //"Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de ".$contrato->getPlano()->getDsPlano();
$dadosboleto["demonstrativo2"] = "Mensalidade referente a $nrparcela &ordf parcela<br>Taxa banc&aacute;ria - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "Servcard";
// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- ";//Sr. Caixa, cobrar multa de 2% após o vencimento
$dadosboleto["instrucoes2"] = "-";//- Receber até 10 dias após o vencimento
$dadosboleto["instrucoes3"] = "";//- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br
$dadosboleto["instrucoes4"] = "";//&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "1";
$dadosboleto["valor_unitario"] = "$valor";
$dadosboleto["aceite"] = "N";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = "1565"; // Num da agencia, sem digito
$dadosboleto["conta"] = "13877";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "175";  // C&oacute;digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "Boleto Banc&aacute;rio";
$dadosboleto["cpf_cnpj"] = "";
$dadosboleto["endereco"] = "Coloque o endere&ccedil;o da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Manaus / Amazonas";
$dadosboleto["cedente"] = "Coloque a Raz&atilde;o Social da sua empresa aqui";

// NÃO ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");
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