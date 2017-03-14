<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$validade  = "";
$ativo     = "";
$tptitular   = "";
$cliente   = 0;
$plano     = 0;
$carteira  = "";
$titular   = 0;
$contrato  = 0;

$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['validade'])){
    $validade = $_POST['validade'];
}

if(isset($_POST['ativo'])){
    $ativo = $_POST['ativo'];
}

if(isset($_POST['tptitular'])){
    $titular = $_POST['tptitular'];
}


if(isset($_POST['cliente'])){
    $cliente = $_POST['cliente'];
}

if(isset($_POST['plano'])){
    $plano = $_POST['plano'];
}

if(isset($_POST['carteira'])){
    $carteira = $_POST['carteira'];
}

if(isset($_POST['titular'])){
    $titular = $_POST['titular'];
}

if(isset($_POST['contrato'])){
    $contrato = $_POST['contrato'];
}
switch ($acao){
    case 'C':
        add($validade, $ativo, $tptitular, $cliente, $plano, $carteira,
            $titular, $contrato);
        break;
    case 'A':
        change($id, $nome, $obs);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($validade, $ativo, $tptitular, $cliente, $plano, $nrcarteira,
             $titular, $contrato){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Carteira.class.php";
    require_once "../beans/Plano.class.php";
    require_once "../beans/Cliente.class.php";
    require_once "../controller/CarteiraController.class.php";

    $carteira =  new Carteira();
    $carteira->setDtValidade($validade);
    $carteira->setSnAtivo($ativo);
    $carteira->setTpTitular($tptitular);
    $carteira->setCliente(new Cliente());
    $carteira->getCliente()->setCdCliente($cliente);
    $carteira->setPlano(new Plano());
    $carteira->getPlano()->setCdPlano($plano);
    $carteira->setContrato(new Contrato());
    $carteira->setNrCarteira($nrcarteira); //a carteira será gerada automaticamente
    $carteira->getContrato()->setCdContrato($contrato);


    $carteiraController = new CarteiraController();
    $teste = $carteiraController->insert($carteira);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $obs){
    require_once "../beans/Cargo.class.php";
    require_once "../controller/CargoController.class.php";

    $cargo = new Cargo();
    $cargo->setCdCargo($id);
    $cargo->setDsCargo($nome);
    $cargo->setObsCargo($obs);

    $cargoController = new CargoController();
    $teste = $cargoController->update($cargo);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/CargoController.class.php";
    $cargoController = new CargoController();
    $teste = $cargoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getLista($id){
    require_once "../beans/Cargo.class.php";
    require_once "../controller/CargoController.class.php";
    require_once "../services/CargoListIterator.class.php";

    $cargo =  new Cargo();
    $cargoController = new CargoController();
    $lista  = $cargoController->getListaByCargo("");
    $cargoLista = new CargoListIterator($lista);

    while ($cargoLista->hasNextCargo()){
        $cargo = $cargoLista->getNextCargo();

        $select = "";
        if($id == $cargo->getCdCargo()){
            $select = "selected";
        }
        echo "<option $select value='".$cargo->getCdCargo()."'>".$cargo->getDsCargo()."</option>>";
    }

}
