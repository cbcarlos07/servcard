<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include "../include/error.php";

$id         = 0;
$agencia    = 0;
$digagencia = 0;
$conta      = 0;
$digconta   = 0;
$banco      = 0;
$atual      = "";
$boleto     = 0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['boleto'])){
    $boleto = $_POST['boleto'];
}

if(isset($_POST['agencia'])){
    $agencia = $_POST['agencia'];
}

if(isset($_POST['digagencia'])){
    $digagencia = $_POST['digagencia'];
}

if(isset($_POST['conta'])){
    $conta = $_POST['conta'];
}

if(isset($_POST['digconta'])){
    $digconta = $_POST['digconta'];
}

if(isset($_POST['atual'])){
    $atual = $_POST['atual'];
}

if(isset($_POST['banco'])){
    $banco = $_POST['banco'];
}

switch ($acao){
    case 'C':
        add($agencia, $digagencia, $conta, $digconta, $banco, $atual, $boleto);
        break;
    case 'A':
        change($id, $agencia, $digagencia, $conta, $digconta, $banco, $atual, $boleto);
        break;
    case 'E':
        delete($id);
        break;
    case 'T':
        mudar_status($id, $atual);
        break;

}

function add($agencia, $digagencia, $nrconta, $digconta, $banco, $atual, $boleto){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Conta.class.php";
    require_once "../controller/ContaController.class.php";
    //echo "Agencia: ".$agencia;

    $bank1 = json_decode($banco);
    //var_dump($bank1);



    $conta = new Conta();
    $conta->setNrAgencia($agencia);
    $conta->setNrDigAgencia($digagencia);
    $conta->setNrConta($nrconta);
    $conta->setNrDigConta($digconta);
    $conta->setNmBanco($bank1->{'bank'});
    $conta->setDsSiglaBanco($bank1->{'sigla'});
    $conta->setSnAtual($atual);
    $boleto = str_replace(',','.',$boleto);
    $conta->setVlTaxaBoleto($boleto);

    $contaController = new ContaController();
    $teste = $contaController->insert($conta);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $agencia, $digagencia, $nrconta, $digconta, $banco, $atual, $boleto){
    require_once "../beans/Conta.class.php";
    require_once "../controller/ContaController.class.php";
    $bank1 = json_decode($banco);
    $conta = new Conta();
    $conta->setCdConta($id);
    $conta->setNrAgencia($agencia);
    $conta->setNrDigAgencia($digagencia);
    $conta->setNrConta($nrconta);
    $conta->setNrDigConta($digconta);
    $conta->setNmBanco($bank1->{'bank'});
    $conta->setDsSiglaBanco($bank1->{'sigla'});
    $conta->setSnAtual($atual);
    $conta->setVlTaxaBoleto($boleto);

    $contaController = new ContaController();
    $teste = $contaController->update($conta);
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/ContaController.class.php";
    $contaController = new ContaController();
    $teste = $contaController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function mudar_status($id, $atual){
    require_once "../controller/ContaController.class.php";
    $contaController = new ContaController();
    $teste = $contaController->mudar_atual($id, $atual);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

