<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$nome      =  "";
$estado    = 0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['cidade'])){
    $nome = $_POST['cidade'];
}

if(isset($_POST['estado'])){
    $estado = $_POST['estado'];
}

switch ($acao){
    case 'C':
        add($nome, $estado);
        break;
    case 'A':
        change($id, $nome, $estado);
        break;
    case 'E':

        delete($id);
        break;

}

function add($nome, $estado){
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Estado.class.php";
    require_once "../controller/CidadeController.class.php";

    $cidade = new Cidade();
    $cidade->setNmCidade($nome);
    $cidade->setEstado(new Estado());
    $cidade->getEstado()->setCdEstado($estado);


    $cidadeController = new CidadeController();
    $teste = $cidadeController->insert($cidade);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $estado){
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Estado.class.php";
    require_once "../controller/CidadeController.class.php";

    $cidade = new Cidade();
    $cidade->setCdCidade($id);
    $cidade->setNmCidade($nome);
    $cidade->setEstado(new Estado());
    $cidade->getEstado()->setCdEstado($estado);


    $cidadeController = new CidadeController();
    $teste = $cidadeController->update($cidade);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/CidadeController.class.php";
    $cidadeController = new CidadeController();
    $teste = $cidadeController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}
