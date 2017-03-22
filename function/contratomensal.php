<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include "../include/error.php";
$id         = 0;
$contrato   = 0;
$acao       = $_POST['acao'];
$parcela    = 0;
$vencimento = "";
$valor      = 0;
$atual      = "";

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['contrato'])){
    $contrato = $_POST['contrato'];
}

if(isset($_POST['parcela'])){
    $parcela = $_POST['parcela'];
}

if(isset($_POST['vencimento'])){
    $vencimento = $_POST['vencimento'];
}

if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}

if(isset($_POST['atual'])){
    $atual = $_POST['atual'];
}



switch ($acao){

    case 'B': //bairro por cidade
        getMensalidade($id);
        break;
    case 'V':
        getVencimento($id);
        break;
    case 'P':
        efetuar_pagamento($parcela, $vencimento, $contrato, $valor);
        break;


}

function add($nome, $cidade, $zona){

   /* if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));*/
}


function change($id, $nome, $cidade, $zona){


    /*if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));*/
}

function delete($id){
    require_once "../controller/BairroController.class.php";
    $bairroController = new BairroController();
    $teste = $bairroController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getMensalidade($contrato){
    include "../include/error.php";
    require_once "../beans/ContratoMensal.class.php";
    require_once "../controller/ContratoMensalController.class.php";
    require_once "../services/ContratoMensalListIterator.class.php";
    $contratoMensal = new ContratoMensal();
    $cmc            = new ContratoMensalController();
    $lista          = $cmc->getList($contrato);
    $bList = new ContratoMensalListIterator($lista);
    //'R$ '.number_format($plano->getNrValor(),2,',','.')
    if($bList->hasNextContratoMensal()) {
        while ($bList->hasNextContratoMensal()) {
            $contratoMensal = $bList->getNextContratoMensal();
            $select = "";
            if($contrato > 0){
                if($contrato == $contratoMensal->getContrato()->getCdContrato()){
                    $select = "selected";
                }
            }
            $dataArray = explode('-',$contratoMensal->getDtVencimento());

            echo "<tr class='item'>
                    <td>".$contratoMensal->getNrParcela()."</td>
                    <td>$dataArray[2]/$dataArray[1]/$dataArray[0]</td>
                    <td>R$ ".number_format($contratoMensal->getNrValor(),2,',','.')."</td>
                  </tr>";
        }
    }else {


    }
}

function getVencimento($contrato){
    include "../include/error.php";
    require_once "../beans/ContratoMensal.class.php";
    require_once "../controller/ContratoMensalController.class.php";
    require_once "../services/ContratoMensalListIterator.class.php";
    $contratoMensal = new ContratoMensal();
    $cmc            = new ContratoMensalController();
    $lista          = $cmc->getList($contrato);
    $bList = new ContratoMensalListIterator($lista);
    //'R$ '.number_format($plano->getNrValor(),2,',','.')
    $dataArray = "";
    if($bList->hasNextContratoMensal()) {
        while ($bList->hasNextContratoMensal()) {
            $contratoMensal = $bList->getNextContratoMensal();
            $select = "";
            if($contrato > 0){
                if($contrato == $contratoMensal->getContrato()->getCdContrato()){
                    $select = "selected";
                }
            }
            $dataArray = explode('-',$contratoMensal->getDtVencimento());


        }
    }else {


    }
    //echo $dataArray;
    echo json_encode(array('vencimento' => "$dataArray[2]/$dataArray[1]/$dataArray[0]"));
}

function efetuar_pagamento($parcela, $vencimento, $contrato, $valor){

        // Usa a função criada e pega o timestamp das duas datas:
        include_once "../include/error.php";
        include_once "../beans/ContratoMensal.class.php";
        include_once "../beans/Pagamento.class.php";
        include_once "../beans/Contrato.class.php";
        include_once "../controller/ContratoMensalController.class.php";
        include_once "../controller/PagamentoController.class.php";
        $contratoMensal = new ContratoMensal();
        $contratoMensalController = new ContratoMensalController();
        $pagamento     = new Pagamento();
        $pagamentoController = new PagamentoController();

            $contratoMensal->setContrato(new Contrato());
            $contratoMensal->getContrato()->setCdContrato($contrato);
            $contratoMensal->setNrParcela($parcela);
            $contratoMensal->setSnPago('S');
            $contratoMensalController->efetua_pagamento($contratoMensal);
           /* echo "Parcela: ".$parcela."\n";
            echo "Contrato: ".$contrato."\n";
            echo "Valor: ".$valor."\n";
            echo "Vencimento: ".$vencimento."\n";*/
            $pagamento->setContrato(new Contrato());
            $pagamento->getContrato()->setCdContrato($contrato);
            $pagamento->setVlPagamento($valor);
            $dataApp = explode('/', $vencimento);
            $pagamento->setDtVencimento("$dataApp[2]-$dataApp[1]-$dataApp[0]");
            $teste = $pagamentoController->insert($pagamento);


        if($teste){
            echo json_encode(array("retorno" => 1));
        }else{
            echo json_encode(array("retorno" => 0));
        }

}

// Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA
function geraTimestamp($data) {
    $partes = explode('/', $data);
    return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}

