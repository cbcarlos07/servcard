<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include ("../include/error.php");
$id           = 0;
$nome         =  "";
$sobrenome    =  "";
$cpf          =  "";
$rg           =  "";
$telefone     =  "";
$email        =  "";
$nascimento   =  "";
$sexo         =  "";
$estadoCivil  =  "";
$cep          =  "";
$bairro       =  "";
$cidade       =  "";
$estado       =  "";
$numero       =  "";
$complemento  =  "";
$senha        =  "";
$senhaatual   =  "";
$acao         = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['sobrenome'])){
    $sobrenome = $_POST['sobrenome'];
}

if(isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}
if(isset($_POST['rg'])){
    $rg = $_POST['rg'];
}
if(isset($_POST['telefone'])){
    $telefone = $_POST['telefone'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['nascimento'])){
    $nascimento = $_POST['nascimento'];
}
if(isset($_POST['sexo'])){
    $sexo = $_POST['sexo'];
}
if(isset($_POST['estadocivil'])){
    $estadoCivil = $_POST['estadocivil'];
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
if(isset($_POST['complemento'])){
    $complemento = $_POST['complemento'];
}

if(isset($_POST['numero'])){
    $numero = $_POST['numero'];
}

if(isset($_POST['senha'])){
    $senha = $_POST['senha'];
}

if(isset($_POST['senhaatual'])){
    $senhaatual = $_POST['senhaatual'];
}
switch ($acao){
    case 'C':
        add($nome, $sobrenome, $cpf, $rg, $telefone, $email, $nascimento,
            $sexo, $estadoCivil, $cep, $bairro, $cidade, $estado, $numero,
            $complemento, $senha, $senhaatual);
        break;
    case 'A':
        change($id, $nome, $sobrenome, $cpf, $rg, $telefone, $email, $nascimento,
            $sexo, $estadoCivil, $cep, $bairro, $cidade, $estado, $numero,
            $complemento, $senha, $senhaatual);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($nome, $sobrenome, $cpf, $rg, $telefone, $email, $nascimento,
             $sexo, $estadoCivil,  $cep, $nmbairro, $nmcidade, $nmestado, $numero,
             $complemento, $senha, $senhaatual){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Cliente.class.php";
    require_once "../beans/EstadoCivil.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Estado.class.php";
    require_once "../beans/Pais.class.php";
    require_once "../controller/ClienteController.class.php";
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







    $cliente = new Cliente();
    $cliente->setNmCliente($nome);
    $cliente->setNmSobrenome($sobrenome);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $cliente->setNrCpf($novocpf);
    $cliente->setNrRg(str_replace("-",'',$rg));
    $cliente->setNrTelefone($telefone);
    $cliente->setDsEmail($email);
    $datas = explode("/", $nascimento);
    $dia =  $datas[0];
    $mes =  $datas[1];
    $ano =  $datas[2];
    $cliente->setDtNascimento("$ano-$mes-$dia");
    $cliente->setTpSexo($sexo);
    $cliente->setEstadoCivil(new EstadoCivil());
    $cliente->getEstadoCivil()->setCdEstadoCivil($estadoCivil);
    $vowels = array(".", "-");
    $novocep = str_replace($vowels, '', $cep);
    $cliente->setNrCep($novocep);
    $cliente->setBairro(new Bairro());
    $cliente->getBairro()->setCdBairro($cdbairro);
    $cliente->setNrCasa($numero);
    $cliente->setDsComplemento($complemento);
    $cliente->setDsSenha($senha);
    $cliente->setSnSenhaAtual($senhaatual);

    $clienteController = new ClienteController();
    $teste = $clienteController->insert($cliente);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $sobrenome, $cpf, $rg, $telefone, $email, $nascimento,
                $sexo, $estadoCivil,  $cep, $nmbairro, $nmcidade, $nmestado, $numero,
                $complemento, $senha, $senhaatual){
    require_once "../beans/Cliente.class.php";
    require_once "../beans/EstadoCivil.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Estado.class.php";
    require_once "../beans/Pais.class.php";
    require_once "../controller/ClienteController.class.php";
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







    $cliente = new Cliente();
    $cliente->setCdCliente($id);
    $cliente->setNmCliente($nome);
    $cliente->setNmSobrenome($sobrenome);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $cliente->setNrCpf($novocpf);
    $cliente->setNrRg(str_replace("-",'',$rg));
    $cliente->setNrTelefone($telefone);
    $cliente->setDsEmail($email);
    $datas = explode("/", $nascimento);
    $dia =  $datas[0];
    $mes =  $datas[1];
    $ano =  $datas[2];
    $cliente->setDtNascimento("$ano-$mes-$dia");
    $cliente->setTpSexo($sexo);
    $cliente->setEstadoCivil(new EstadoCivil());
    $cliente->getEstadoCivil()->setCdEstadoCivil($estadoCivil);
    $vowels = array(".", "-");
    $novocep = str_replace($vowels, '', $cep);
    $cliente->setNrCep($novocep);
    $cliente->setBairro(new Bairro());
    $cliente->getBairro()->setCdBairro($cdbairro);
    $cliente->setNrCasa($numero);
    $cliente->setDsComplemento($complemento);
    $cliente->setDsSenha($senha);
    $cliente->setSnSenhaAtual($senhaatual);

    $clienteController = new ClienteController();
    $teste = $clienteController->update($cliente);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/ClienteController.class.php";
    $clienteController = new ClienteController();
    $teste = $clienteController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getLista($id){
    require_once "../beans/Cliente.class.php";

    require_once "../controller/ClienteController.class.php";
    require_once "../services/ClienteListIterator.class.php";

    $cliente = new Cliente();
    $clienteController = new ClienteController();
    $lista = $clienteController->getLista("");
    $clienteList = new ClienteListIterator($lista);

    if($clienteList->hasNextCliente()) {
        while ($clienteList->hasNextCliente()) {
            $cliente = $clienteList->getNextCliente();
            $select = "";
            if ($cliente->getCdCliente() == $id) {
                $select = "selected";
            }
            echo "<option ".$select." value='" . $cliente->getCdCliente() . "'>" . $cliente->getNmCliente() . "</option>";
        }
    }else{
        echo "<option value=''>N&atilde;o possui dados cadastrados</option>";
    }
}
