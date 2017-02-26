<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$nome      =  "";
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

switch ($acao){
    case 'C':
        add($nome);
        break;
    case 'A':
        change($id, $nome);
        break;
    case 'E':

        delete($id);
        break;

}

function add($nome){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/TpLogradouro.class.php";
    require_once "../controller/TpLogradouroController.class.php";

    $tpLogradouro = new TpLogradouro();
    $tpLogradouro->setDsTpLogradouro($nome);

    $tpLogradouroController = new TpLogradouroController();
    $teste = $tpLogradouroController->insert($tpLogradouro);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome){
    require_once "../beans/TpLogradouro.class.php";
    require_once "../controller/TpLogradouroController.class.php";

    $tpLogradouro = new TpLogradouro();
    $tpLogradouro->setCdTpLogradouro($id);
    $tpLogradouro->setDsTpLogradouro($nome);

    $tpLogradouroController = new TpLogradouroController();
    $teste = $tpLogradouroController->update($tpLogradouro);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/TpLogradouroController.class.php";
    $tpLogradouroController = new TpLogradouroController();
    $teste = $tpLogradouroController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}
