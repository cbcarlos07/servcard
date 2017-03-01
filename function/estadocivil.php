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
    case 'L':
        getLista($id);
        break;

}

function add($nome){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/EstadoCivil.class.php";
    require_once "../controller/EstadoCivilController.class.php";

    $estadoCivil = new EstadoCivil();
    $estadoCivil->setDsEstadoCivil($nome);

    $estadoCivilController = new EstadoCivilController();
    $teste = $estadoCivilController->insert($estadoCivil);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome){
    require_once "../beans/EstadoCivil.class.php";
    require_once "../controller/EstadoCivilController.class.php";

    $estadoCivil = new EstadoCivil();
    $estadoCivil->setCdEstadoCivil($id);
    $estadoCivil->setDsEstadoCivil($nome);

    $estadoCivilController = new EstadoCivilController();
    $teste = $estadoCivilController->update($estadoCivil);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/EstadoCivilController.class.php";
    $estadoCivilController = new EstadoCivilController();
    $teste = $estadoCivilController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getLista($id){
    require_once "../beans/EstadoCivil.class.php";
    require_once "../controller/EstadoCivilController.class.php";
    require_once "../services/EstadoCivilListIterator.class.php";

    $estadoCivil = new EstadoCivil();
    $estadoCivilController = new EstadoCivilController();
    $lista = $estadoCivilController->getLista("");
    $estadoCivilList = new EstadoCivilListIterator($lista);

    if($estadoCivilList->hasNextEstadoCivil()) {
        while ($estadoCivilList->hasNextEstadoCivil()) {
            $estadoCivil = $estadoCivilList->getNextEstadoCivil();
            $select = "";
            if ($estadoCivil->getCdEstadoCivil() == $id) {
                $select = "selected";
            }
            echo "<option ".$select." value='" . $estadoCivil->getCdEstadoCivil() . "'>" . $estadoCivil->getDsEstadoCivil() . "</option>";
        }
    }else{
        echo "<option value=''>N&atilde;o possui dados cadastrados</option>";
    }
}
