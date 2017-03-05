<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id      = 0;
$nome    =  "";
$login   =  "";
$senha   = "";
$acao   = $_POST['acao'];
$ativo   = "";
$cargo   = 0;
$cpf     = "";
$rg      = "";
$foto    = "";
$senhaatual   = "";


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['login'])){
    $login = $_POST['login'];
}

if(isset($_POST['senha'])){
    $senha = $_POST['senha'];
}

if(isset($_POST['ativo'])){
    $ativo = $_POST['ativo'];
}
if(isset($_POST['cargo'])){
    $cargo = $_POST['cargo'];
}

if(isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}
if(isset($_POST['rg'])){
    $rg = $_POST['rg'];
}
if(isset($_POST['foto'])){
    $foto = $_POST['foto'];
}
if(isset($_POST['atual'])){
    $senhaatual = $_POST['atual'];
}

switch ($acao){
    case 'C':
        add( $nome, $login, $senha,
            $ativo, $cargo, $cpf, $rg,
            $foto, $senhaatual);
        break;
    case 'A':
        change($id, $nome, $login, $senha,
            $ativo, $cargo, $cpf, $rg,
            $foto, $senhaatual);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($nome, $login, $senha, $ativo, $cargo, $cpf, $rg, $foto, $senhaatual){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Usuario.class.php";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/UsuarioController.class.php";

    $usuario = new Usuario();
    $usuario->setNmUsuario($nome);
    $usuario->setDsLogin($login);
    $usuario->setDsSenha($senha);
    $usuario->setSnAtivo($ativo);
    $usuario->setCargo(new Cargo());
    $usuario->getCargo()->setCdCargo($cargo);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $usuario->setNrCPF($novocpf);
    $usuario->setNrRg(str_replace("-",'',$rg));
    $usuario->setDsFoto($foto);
    $usuario->setSnSenhaAtual($senhaatual);

    $usuarioController = new UsuarioController();
    $teste = $usuarioController->insert($usuario);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $login, $senha, $ativo, $cargo, $cpf, $rg, $foto, $senhaatual){
    require_once "../beans/Usuario.class.php";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/UsuarioController.class.php";

    $usuario = new Usuario();
    $usuario->setCdUsuario($id);
    $usuario->setNmUsuario($nome);
    $usuario->setDsLogin($login);
    $usuario->setDsSenha($senha);
    $usuario->setSnAtivo($ativo);
    $usuario->setCargo(new Cargo());
    $usuario->getCargo()->setCdCargo($cargo);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $usuario->setNrCPF($novocpf);
    $usuario->setNrRg(str_replace("-",'',$rg));
    $usuario->setDsFoto($foto);
    $usuario->setSnSenhaAtual($senhaatual);

    $usuarioController = new UsuarioController();
    $teste = $usuarioController->update($usuario);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/UsuarioController.class.php";
    $usuarioController = new UsuarioController();
    $teste = $usuarioController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getLista($id){
    require_once "../beans/Usuario.class.php";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/UsuarioController.class.php";

    $usuario =  new Usuario();
    $usuarioController = new UsuarioController();
    $lista  = $usuarioController->getLista("");
    $usuarioLista = new UsuarioListIterator($lista);

    while ($usuarioLista->hasNextUsuario()){
        $usuario = $usuarioLista->getNextUsuario();

        $select = "";
        if($id == $usuario->getCdUsuario()){
            $select = "selected";
        }
        echo "<option $select value='".$usuario->getCdusuario()."'>".$usuario->getNmUsuario()."</option>>";
    }

}
