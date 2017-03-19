<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}



switch ($acao){

    case 'B': //bairro por cidade
        getMensalidade($id);
        break;
    case 'V':
        getVencimento($id);
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
                if($contrato == $contratoMensal->getCdContrato()){
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
                if($contrato == $contratoMensal->getCdContrato()){
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

