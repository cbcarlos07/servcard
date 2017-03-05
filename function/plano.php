<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id          = 0;
$nome        =  "";
$observacao  =  "";
$valor       =  0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}
if(isset($_POST['observacao'])){
    $observacao = $_POST['observacao'];
}
if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}

switch ($acao){
    case 'C':
        add($nome, $observacao, $valor);
        break;
    case 'A':
        change($id, $nome, $observacao, $valor);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getPlano($id);
        break;
    case 'V':
        getValor($id);
        break;

}

function add($nome, $observacao, $valor){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Plano.class.php";
    require_once "../controller/PlanoController.class.php";

    $plano = new Plano();
    $plano->setDsPlano($nome);
    $plano->setObsPlano($observacao);
    $value1 = str_replace(",",".",$valor);
    $plano->setNrValor($value1);

    $planoController = new PlanoController();
    $teste = $planoController->insert($plano);

    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $observacao, $valor){
    require_once "../beans/Plano.class.php";
    require_once "../controller/PlanoController.class.php";

    $plano = new Plano();
    $plano->setCdPlano($id);
    $plano->setDsPlano($nome);
    $plano->setObsPlano($observacao);
    $plano->setNrValor($valor);

    $planoController = new PlanoController();
    $teste = $planoController->update($plano);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/PlanoController.class.php";
    $planoController = new PlanoController();
    $teste = $planoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getPlano($id){
    require_once "../beans/Plano.class.php";
    require_once "../controller/PlanoController.class.php";
    require_once "../services/PlanoListIterator.class.php";

    $plano = new Plano();
    $planoController = new PlanoController();
    $lista = $planoController->getLista("");
    $planoList = new PlanoListIterator($lista);
    echo "<option value=''>Selecione</option>";
    if($planoList->hasNextPlano()) {
        while ($planoList->hasNextPlano()) {
            $plano = $planoList->getNextPlano();
            $select = "";
            if ($plano->getCdPlano() == $id) {
                $select = "selected";
            }
            echo "<option ".$select." value='" . $plano->getCdPlano() . "'>" . $plano->getDsPlano() . "</option>";
        }
    }else{
        echo "<option value=''>N&atilde;o possui dados cadastrados</option>";
    }
}

function getValor($id){
    require_once "../beans/Plano.class.php";
    require_once "../controller/PlanoController.class.php";
    $plano = new Plano();
    $planoController = new PlanoController();
    $plano = $planoController->getValorPlano($id);

    if ($plano == null){
        echo "";
    }else{
        echo 'R$ '.number_format($plano->getNrValor(),2,',','.');
    }


}
