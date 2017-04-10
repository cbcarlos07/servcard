<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa                |
// |                                                                      |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>         |
// | Desenvolvimento Boleto Santander-Banespa : Fabio R. Lenharo                |
// +----------------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//
//DADOS PROCESSADOS DO SISTEMA
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


// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = $conta->getVlTaxaBoleto();
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = $valor; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = "1234567";  // Nosso numero sem o DV - REGRA: Máximo de 7 caracteres!
$dadosboleto["numero_documento"] = $cdcontrato;	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

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
// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- ";//Sr. Caixa, cobrar multa de 2% após o vencimento
$dadosboleto["instrucoes2"] = "-";//- Receber até 10 dias após o vencimento
$dadosboleto["instrucoes3"] = "";//- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br
$dadosboleto["instrucoes4"] = "";//&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "1";
$dadosboleto["valor_unitario"] = $valor;
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - SANTANDER BANESPA
$dadosboleto["codigo_cliente"] = $cliente->getCdCliente(); // Código do Cliente (PSK) (Somente 7 digitos)
$dadosboleto["ponto_venda"] = $conta->getNrAgencia(); // Ponto de Venda = Agencia
$dadosboleto["carteira"] = "102";  // Cobrança Simples - SEM Registro
$dadosboleto["carteira_descricao"] = "COBRAN&Ccedil;A SIMPLES - CSR";  // Descrição da Carteira

// SEUS DADOS
$dadosboleto["identificacao"] = "Boleto Banc&aacute;rio";//BoletoPhp - Código Aberto de Sistema de Boletos
$dadosboleto["cpf_cnpj"] = "";
$dadosboleto["endereco"] = "Coloque o endere&ccedil;o da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Manaus / Amazonas";
$dadosboleto["cedente"] = "Servard -  Servi&ccedil;os de cart&otilde;oes de Desconto";


// NÃO ALTERAR!
include("include/funcoes_santander_banespa.php"); 
include("include/layout_santander_banespa.php");
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
