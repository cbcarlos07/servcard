<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include "../include/error.php";
$id             = 0;
$nome           = "";
$responsavel    = "";
$cpf            = "";
$cnpj           = "";
$ramo           = "";
$cep          =  "";
$bairro       =  "";
$cidade       =  "";
$estado       =  "";
$numero         = "";
$complemento    = "";
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['responsavel'])){
    $responsavel = $_POST['responsavel'];
}
if(isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}
if(isset($_POST['cnpj'])){
    $cnpj = $_POST['cnpj'];
}

if(isset($_POST['ramo'])){
    $ramo = $_POST['ramo'];
}

if(isset($_POST['cep'])){
    $cep = $_POST['cep'];
}
if(isset($_POST['bairro'])){
    $bairro = $_POST['bairro'];
}

if(isset($_POST['cidade'])){
    $cidade = $_POST['cidade'];
}
if(isset($_POST['estado'])){
    $estado = $_POST['estado'];
}

if(isset($_POST['numero'])){
    $numero = $_POST['numero'];
}

if(isset($_POST['complemento'])){
    $complemento = $_POST['complemento'];
}







switch ($acao){
    case 'C':
        add($nome, $responsavel, $cpf, $cnpj, $cep, $bairro, $cidade, $estado, $ramo, $numero, $complemento);
        break;
    case 'A':
        change($id, $nome, $responsavel, $cpf, $cnpj, $cep, $bairro, $cidade, $estado, $ramo, $numero, $complemento);
        break;
    case 'E':
        delete($id);
        break;
    case 'B': //parceiro por cidade
        getParceiros($cidade, $parceiro);

}

function add($nome, $responsavel, $cpf, $cnpj,$cep, $nmbairro, $nmcidade, $nmestado, $ramo, $numero, $complemento){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Parceiro.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Estado.class.php";
    require_once "../beans/Pais.class.php";
    require_once "../controller/ParceiroController.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../controller/EstadoController.class.php";
    require_once "../controller/CidadeController.class.php";

    $estado = new Estado();
    $estadoController = new EstadoController();
    $cdestado = $estadoController->getEstadoByName($nmestado);

    if($cdestado  == 0){
        $estado->setDsUF($nmestado);
        $estado->setNmEstado("");
        $estado->setPais(new Pais());
        $estado->getPais()->setCdPais(1);
        $cdestado = $estadoController->insert($estado);
    }

    //echo "Estado: ".$cdestado;

    $cidade = new Cidade();
    $cidadeController = new CidadeController();
    $cdcidade = $cidadeController->getCidadebyName($nmcidade);
    if($cdcidade == 0){
        $cidade->setNmCidade($nmcidade);
        $cidade->setEstado(new Estado());
        $cidade->getEstado()->setCdEstado($cdestado);
        $cdcidade = $cidadeController->insert($cidade);
    }

    $bairro =  new Bairro();
    $bairroController = new BairroController();
    $cdbairro = $bairroController->getBairroByName($nmbairro);
    if($cdbairro == 0){
        $bairro->setNmBairro($nmbairro);
        $bairro->setCidade(new Cidade());
        $bairro->getCidade()->setCdCidade($cdcidade);
        $cdbairro = $bairroController->insert($bairro);
    }



    $parceiro = new Parceiro();
    $parceiro->setNmParceiro($nome);
    $parceiro->setDsResponsavel($responsavel);
    $vowels = array(".", "-", "/");
    $novocnpj = str_replace($vowels,'',$cnpj);
    $parceiro->setNrCnpj($novocnpj);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $parceiro->setNrCpfResponsavel($novocpf);
    $parceiro->setNrCnpj($cnpj);
    $vowels = array(".", "-");
    $novocep = str_replace($vowels, '', $cep);
    $parceiro->setNrCep($novocep);
    $parceiro->setBairro(new Bairro());
    $parceiro->getBairro()->setCdBairro($cdbairro);
    $parceiro->setDsRamo($ramo);
    $parceiro->setNrCasa($numero);
    $parceiro->setDsComplemento($complemento);

    $parceiroController = new ParceiroController();
    $teste = $parceiroController->insert($parceiro);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $responsavel, $cpf, $cnpj,$cep, $nmbairro, $nmcidade, $nmestado, $ramo, $numero, $complemento){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Parceiro.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Estado.class.php";
    require_once "../beans/Pais.class.php";
    require_once "../controller/ParceiroController.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../controller/EstadoController.class.php";
    require_once "../controller/CidadeController.class.php";


    $estado = new Estado();
    $estadoController = new EstadoController();
    $cdestado = $estadoController->getEstadoByName($nmestado);

    if($cdestado  == 0){
        $estado->setDsUF($nmestado);
        $estado->setNmEstado("");
        $estado->setPais(new Pais());
        $estado->getPais()->setCdPais(1);
        $cdestado = $estadoController->insert($estado);
    }

    //echo "Estado: ".$cdestado;

    $cidade = new Cidade();
    $cidadeController = new CidadeController();
    $cdcidade = $cidadeController->getCidadebyName($nmcidade);
    if($cdcidade == 0){
        $cidade->setNmCidade($nmcidade);
        $cidade->setEstado(new Estado());
        $cidade->getEstado()->setCdEstado($cdestado);
        $cdcidade = $cidadeController->insert($cidade);
    }

    $bairro =  new Bairro();
    $bairroController = new BairroController();
    $cdbairro = $bairroController->getBairroByName($nmbairro);
    if($cdbairro == 0){
        $bairro->setNmBairro($nmbairro);
        $bairro->setCidade(new Cidade());
        $bairro->getCidade()->setCdCidade($cdcidade);
        $cdbairro = $bairroController->insert($bairro);
    }

    $parceiro = new Parceiro();
    $parceiro->setCdParceiro($id);
    $parceiro->setNmParceiro($nome);
    $parceiro->setDsResponsavel($responsavel);
    $vowels = array(".", "-", "/");
    $novocnpj = str_replace($vowels,'',$cnpj);
    $parceiro->setNrCnpj($novocnpj);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $parceiro->setNrCpfResponsavel($novocpf);
    $parceiro->setNrCnpj($cnpj);
    $vowels = array(".", "-");
    $novocep = str_replace($vowels, '', $cep);
    $parceiro->setNrCep($novocep);
    $parceiro->setBairro(new Bairro());
    $parceiro->getBairro()->setCdBairro($cdbairro);
    $parceiro->setDsRamo($ramo);
    $parceiro->setNrCasa($numero);
    $parceiro->setDsComplemento($complemento);
    $parceiroController = new ParceiroController();
    $teste = $parceiroController->update($parceiro);
    //echo "Teste: ".$teste."\n";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/ParceiroController.class.php";
    $parceiroController = new ParceiroController();
    $teste = $parceiroController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getParceiros($cidade, $cdParceiro){
    require_once "../beans/Parceiro.class.php";
    require_once "../controller/ParceiroController.class.php";
    require_once "../services/ParceiroListIterator.class.php";
    $parceiro = new Parceiro();
    $bc = new ParceiroController();
    $lista = $bc->getList("");
    $bList = new ParceiroListIterator($lista);
    if($bList->hasNextParceiro()) {
        while ($bList->hasNextParceiro()) {
            $parceiro = $bList->getNextParceiro();
            $select = "";
            if($cdParceiro > 0){
                if($cdParceiro == $parceiro->getCdParceiro()){
                    $select = "selected";
                }
            }
            echo "<option ".$select." value='" . $parceiro->getCdParceiro() . "'>" . $parceiro->getNmParceiro() . "</option>";
        }
    }else {
        if ($cidade > 0) {

            echo "<option value=''>N&atilde;o possui parceiros cadastrados</option>";
        }else{
            echo "<option value=''>Selecione uma cidade </option>";
        }

    }
}
