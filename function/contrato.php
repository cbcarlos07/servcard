<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include "../include/error.php";

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
$dias       = 0;
$observacao = "";
$titular    = "";
$acao = $_POST['acao'];
$responsavel = 0;


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['dias'])){
    $dias = $_POST['dias'];
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

if(isset($_POST['observacao'])){
    $observacao = $_POST['observacao'];
}


if(isset($_POST['titular'])){
    $titular = $_POST['titular'];
}

if(isset($_POST['responsavel'])){
    $responsavel = $_POST['responsavel'];
}


switch ($acao){
    case 'C':

        add($data, $quite, $valor, $parcela, $cliente,
            $usuario, $plano, $juros, $vencimento, $dias, $titular, $responsavel);
        break;
    case 'A':
        change($id, $data, $quite, $valor, $parcela, $cliente,
            $usuario, $plano, $juros, $dias, $vencimento, $titular, $responsavel);
        break;

    case 'D':
        cancelar_contrato($id, $observacao, $usuario);
        break;
    case 'L': //bairro por cidade
        getListaContratos($id);
        break;
    case 'T': //bairro por cidade
        getTabelaContratos($observacao);
        break;
    case 'P': //bairro por cidade
        getContratos($observacao);
        break;

}

function add($data, $quite, $valor, $parcela, $cliente, $usuario, $plano, $juros, $vencimento, $dias, $titular, $responsavel){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Contrato.class.php";
    require_once "../beans/Carteira.class.php";
    require_once "../beans/ContratoMensal.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../controller/CarteiraController.class.php";
    require_once "../controller/ContratoMensalController.class.php";
    require_once "../beans/Cliente.class.php";
    require_once "../beans/Plano.class.php";
    require_once "../beans/Usuario.class.php";



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
    $contrato->setDiasVencimento($dias);
    $contrato->setSnTitular($titular);
    $contrato->setResponsavel(new Usuario());
    $contrato->getResponsavel()->setCdUsuario($responsavel);


    $contratoController = new ContratoController();
    $genId = $contratoController->insert($contrato);

    $arr = json_decode($vencimento);

    $contratoMensal = new ContratoMensal();
    $cmc = new ContratoMensalController();
    $teste = false;
    $teste1 = false;
   // echo "Codigo gerado: $genId";
    if($genId > 0){
        foreach ($arr as $item => $value) {

                $contratoMensal->setContrato(new Contrato());
                $contratoMensal->getContrato()->setCdContrato($genId);
                $contratoMensal->setDtVencimento($value->{'Data do pagamento'});
                $contratoMensal->setNrValor($value->{'valor a pagar'});
                $contratoMensal->setNrParcela($value->{'Nº da Parc'});
                $contratoMensal->setSnPago('N');

                $teste = $cmc->insert($contratoMensal);

        }

        $carteira = new Carteira();
        $carteiraController = new CarteiraController();

        $carteira->setSnTitular($titular);
        $carteira->setContrato(new Contrato());
       // echo "Codigo do contrato: ".$genId." \n";
        $carteira->getContrato()->setCdContrato($genId);
        $carteira->setDtValidade($contratoMensal->getDtVencimento());
        $carteira->setCliente(new Cliente());
        $carteira->getCliente()->setCdCliente($cliente);
        $carteira->setSnAtivo('S');
        $teste1 = $carteiraController->insert($carteira);




    }

   //var_dump(json_decode($vencimento, true));
  //  echo $teste1;



    if($teste){
        echo json_encode(array('retorno' => 1, 'id' => $cliente));

    }
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $data, $quite, $valor, $parcela, $cliente, $usuario, $plano, $juros, $dias, $vencimento, $titular, $responsavel){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/ContratoMensal.class.php";
    require_once "../beans/Contrato.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../controller/ContratoMensalController.class.php";
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
    $contrato->setDiasVencimento($dias);
    $contrato->setSnTitular($titular);
    $contrato->setResponsavel(new Usuario());
    $contrato->getResponsavel()->setCdUsuario($responsavel);
    $contratoController = new ContratoController();
    $teste = $contratoController->update($contrato);



    $arr = json_decode($vencimento);

    $contratoMensal = new ContratoMensal();
    $cmc = new ContratoMensalController();

    $cmc->delete_nao_pago($id);
    //echo "Deletado: ".$deletando;
    $teste = false;
    //echo "Codigo gerado: $genId";

        foreach ($arr as $item => $value) {
          //  echo "Teste: ".$cmc->getMensalidadePaga($id,$value->{'Nº da Parc'})."<br>";
            if($cmc->getMensalidadePaga($id,$value->{'Nº da Parc'}) == 0) {
                $contratoMensal->setContrato(new Contrato());
                $contratoMensal->getContrato()->setCdContrato($id);
                $contratoMensal->setDtVencimento($value->{'Data do pagamento'});
                $contratoMensal->setNrValor($value->{'valor a pagar'});
                $contratoMensal->setNrParcela($value->{'Nº da Parc'});
                $contratoMensal->setSnPago('N');

                $teste = $cmc->insert($contratoMensal);
            }

        }



    if($teste)
        echo json_encode(array('retorno' => 1,'id' => $cliente));
    else
        echo json_encode(array('retorno' => 0));
}

function cancelar_contrato($id, $observacao, $usuario){
    require_once "../beans/Contrato.class.php";
    require_once "../beans/Usuario.class.php";
    require_once "../controller/ContratoController.class.php";
    $contratoController = new ContratoController();
    $contrato  = new Contrato();
    $contrato->setCdContrato($id);
    $contrato->setUsuario(new Usuario());
    $contrato->getUsuario()->setCdUsuario($usuario);
    $contrato->setDsObervacao($observacao);
    $teste = $contratoController->cancelar_contrato($contrato);
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
    $lista = $contratoController->getLista('');
    $bList = new ContratoListIterator($lista);

        while ($bList->hasNextContrato()) {
            $contrato = $bList->getNextContrato();
            $select = "";
            if($id == $contrato->getCdContrato()){
                $select = "selected";
            }
            echo "<option ".$select." value='" . $contrato->getCdContrato() . "'>" . $contrato->getCliente()->getNmCliente() ." - " . $contrato->getCdContrato()."</option>";
        }

}

function getTabelaContratos($id){
    require_once "../beans/Contrato.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../services/ContratoListIterator.class.php";
    $contrato = new Contrato();
    $contratoController = new ContratoController();
    $lista = $contratoController->getLista($id);
    $bList = new ContratoListIterator($lista);

    while ($bList->hasNextContrato()) {
        $contrato = $bList->getNextContrato();

        echo "<tr class='linha'>
                <td> ".$contrato->getCdContrato()."</td><td>" . $contrato->getCliente()->getNmCliente() ."</td>
             </tr>";
    }

}

function getContratos($id){
    require_once "../beans/Contrato.class.php";
    require_once "../controller/ContratoController.class.php";
    require_once "../services/ContratoListIterator.class.php";
    $contrato = new Contrato();
    $contratoController = new ContratoController();
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$id);

    $lista = $contratoController->getListaByCPF($novocpf);
    $bList = new ContratoListIterator($lista);

    while ($bList->hasNextContrato()) {
        $contrato = $bList->getNextContrato();
        $dataMySQL = explode('-',$contrato->getDhContrato());
        $tabela = "<table class='table table-hover' id='tabela'>
                            <thead>
                             <tr>
                                <th>Contrato</th>
                                <th>Nome</th>
                                <th>Data do Contrato</th>
                                <th>Usuario</th>
                             </tr>
                            </thead>
                            <tbody>";

        $tabela .=  "<tr class='linha'>
                        <td> ".$contrato->getCdContrato()."</td>
                        <td><a href='#' onclick='mensalidade(".$contrato->getCdContrato().",".$contrato->getCliente()->getCdCliente().",\"pagamentomensal.php\")'>" . $contrato->getCliente()->getNmCliente() ."</td>
                        <td>$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]</td>
                        <td>".$contrato->getUsuario()->getDsLogin()."</td>
                     </tr>";

        $tabela .= "</tbody>
                    </table>";
        echo $tabela;
    }

}

