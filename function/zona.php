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
    require_once "../beans/Zona.class.php";
    require_once "../controller/ZonaController.class.php";

    $zona = new Zona();
    $zona->setDsZona($nome);

    $zonaController = new ZonaController();
    $teste = $zonaController->insert($zona);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome){
    require_once "../beans/Zona.class.php";
    require_once "../controller/ZonaController.class.php";

    $zona = new Zona();
    $zona->setCdZona($id);
    $zona->setDsZona($nome);

    $zonaController = new ZonaController();
    $teste = $zonaController->update($zona);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/ZonaController.class.php";
    $zonaController = new ZonaController();
    $teste = $zonaController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}
