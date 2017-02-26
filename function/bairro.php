<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$nome      = "";
$cidade    = 0;
$zona      = 0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['cidade'])){
    $cidade = $_POST['cidade'];
}
if(isset($_POST['zona'])){
    $zona = $_POST['zona'];
}

switch ($acao){
    case 'C':
        add($nome, $cidade, $zona);
        break;
    case 'A':
        change($id, $nome, $cidade, $zona);
        break;
    case 'E':

        delete($id);
        break;

}

function add($nome, $cidade, $zona){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Bairro.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Zona.class.php";

    $bairro = new Bairro();
    $bairro->setNmBairro($nome);
    $bairro->setCidade(new Cidade());
    $bairro->getCidade()->setCdCidade($cidade);
    $bairro->setZona(new Zona());
    $bairro->getZona()->setCdZona($zona);

    $bairroController = new BairroController();
    $teste = $bairroController->insert($bairro);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $cidade, $zona){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Bairro.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Zona.class.php";

    $bairro = new Bairro();
    $bairro->setCdBairro($id);
    $bairro->setNmBairro($nome);
    $bairro->setCidade(new Cidade());
    $bairro->getCidade()->setCdCidade($cidade);
    $bairro->setZona(new Zona());
    $bairro->getZona()->setCdZona($zona);
    $bairroController = new BairroController();
    $teste = $bairroController->update($bairro);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
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
