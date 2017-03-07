<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id         = 0;
$data       = "";
$quite      = "";
$valor      = 0;
$parcela    = 0;
$cliente    = 0;
$vencimento = 0;
$usuario    = 0;
$plano      = 0;
$juros      = 0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['juros'])){
    $juros = $_POST['juros'];
}

if(isset($_POST['data'])){
    $data = $_POST['data'];
}

if(isset($_POST['quite'])){
    $quite = $_POST['quite'];
}
if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}

if(isset($_POST['parcela'])){
    $parcela = $_POST['parcela'];
}

if(isset($_POST['cliente'])){
    $cliente = $_POST['cliente'];
}

if(isset($_POST['vencimento'])){
    $vencimento = $_POST['vencimento'];
}

if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];
}

if(isset($_POST['plano'])){
    $plano = $_POST['plano'];
}




switch ($acao){
    case 'C':

        add($data, $quite, $valor, $parcela, $cliente, $usuario, $plano, $juros, $vencimento);
        break;
    case 'A':
        change($id, $data, $quite, $valor, $parcela, $cliente, $usuario, $plano, $juros);
        break;

    case 'E':
        delete($id);
        break;
    case 'L': //bairro por cidade
        getBairros($cidade, $bairro);

}

function add($data, $quite, $valor, $parcela, $cliente, $usuario, $plano, $juros, $vencimento){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Contrato.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../beans/Cliente.class.php";
    require_once "../beans/Plano.class.php";
    require_once "../beans/Usuario.class.php";


/*
    $contrato = new Contrato();
    $contrato->setDhContrato($data);
    $contrato->setSnQuite($quite);
    $contrato->setNrValor($valor);
    $contrato->setNrParcela($parcela);
    $contrato->setCliente(new Cliente());
    $contrato->getCliente()->setCdCliente($cliente);
    $contrato->setUsuario(new Usuario());
    $contrato->getUsuario()->setCdUsuario($usuario);
    $contrato->setPlano(new Plano());
    $contrato->getPlano()->setCdPlano($plano);
    $contrato->setNrJuros($juros);


    $contratoController = new ContratoController();
    $teste = $contratoController->insert($contrato);
   */
//echo "Teste: $teste";
    $arr = json_decode($vencimento);
    foreach ($arr as $item => $value) {
        echo '  ' . $value->{'Nº da Parc'} . "<br>";
        echo '  ' . $value->{'Data do pagamento'} . "<br>";
        echo '  ' . $value->{'valor a pagar'} . "<br>";
    }
   //var_dump(json_decode($vencimento, true));


    $teste = true;
    echo $teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $data, $quite, $valor, $parcela, $cliente, $usuario, $plano, $juros){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Contrato.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../beans/Cliente.class.php";
    require_once "../beans/Plano.class.php";
    require_once "../beans/Usuario.class.php";

    $contrato = new Contrato();
    $contrato->setCdContrato($id);
    $contrato->setDhContrato($data);
    $contrato->setSnQuite($quite);
    $contrato->setNrValor($valor);
    $contrato->setNrParcela($parcela);
    $contrato->setCliente(new Cliente());
    $contrato->getCliente()->setCdCliente($cliente);
    $contrato->setUsuario(new Usuario());
    $contrato->getUsuario()->setCdUsuario($usuario);
    $contrato->setPlano(new Plano());
    $contrato->getPlano()->setCdPlano($plano);
    $contrato->setNrJuros($juros);

    $contratoController = new ContratoController();
    $teste = $contratoController->update($contrato);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/ContratoController.class.php";
    $contratoController = new ContratoController();
    $teste = $contratoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getListaContratos($id){
    require_once "../beans/Contrato.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../services/ContratoListIterator.class.php";
    $contrato = new Contrato();
    $contratoController = new ContratoController();
    $lista = $contratoController->getLista($id);
    $bList = new ContratoListIterator($lista);

        while ($bList->hasNextContrato()) {
            $bairro = $bList->getNextContrato();
            $select = "";

            echo "<option ".$select." value='" . $bairro->getCdBairro() . "'>" . $bairro->getNmBairro() . "</option>";
        }

}
