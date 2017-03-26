<?php
include "include/error.php";
session_start();

/*if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}*/

//echo "<link rel='shortcut icon' href='img/ham.png'>";
// PRIMEIRAMENTE: INSTALEI A CLASSE NA PASTA FPDF DENTRO DE MEU SITE.
define('FPDF_FONTPATH','fpdf/font/'); 

// INSTALA AS FONTES DO FPDF
require('fpdf/fpdf.php');

// INSTALA A CLASSE FPDF
class PDF extends FPDF {

// CRIA UMA EXTENSÃO QUE SUBSTITUI AS FUNÇÕES DA CLASSE. 
// SOMENTE AS FUNÇÕES QUE ESTÃO DENTRO DESTE EXTENDS É QUE SERÃO SUBSTITUIDAS.


    function Header(){ //CABECALHO
        
        $codigo = "Variavel Codigo";
        global $codigo; // EXEMPLO DE UMA VARIAVEL QUE TERÁ O MESMO VALOR EM QUALQUER ÁREA DO PDF.
        $l=3; // DEFINI ESTA VARIAVEL PARA ALTURA DA LINHA
        $this->SetXY(10,10); // SetXY - DEFINE O X E O Y NA PAGINA
        //$this->Rect(10,10,190,280); // CRIA UM RETÂNGULO QUE COMEÇA NO X = 10, Y = 10 E 
                                    //TEM 190 DE LARGURA E 280 DE ALTURA. 
                                    //NESTE CASO, É UMA BORDA DE PÁGINA.

       // $this->Image('logo.jpg',11,11,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
        $this->SetFont('Arial','B',8); // DEFINE A FONTE ARIAL, NEGRITO (B), DE TAMANHO 8


        $this->Ln(); // QUEBRA DE LINHA

        $l = 4;
        $this->SetFont('Arial','B',12);
        $this->SetXY(10,15);
       $this->Cell(0,$l,'LISTA DE CLIENTES EM DIA','B',1,'C');

        $this->SetFont('Arial','B',12);

        $this->Ln();



    }

    function Footer(){ // CRIANDO UM RODAPE

        $this->SetXY(15,173);
        //$this->Rect(10,270,190,20);
        $this->SetFont('Arial','',10);
        //$this->Cell(70,8,'Assinatura ','T',0,'L');
        $this->Cell(40,8,' ',0,0,'L');
        //$this->Cell(70,8,'Assinatura','T',0,'L'); 
        $this->Ln();
        $this->SetFont('Arial','',7);
        $this->Cell(190,7,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'L');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Manaus');
        $dia_hoje = date('d');
        $ano_hoje = date('Y');
        $hora_hoje = date('H:i:s');
        $data =  'Manaus, '.ucfirst(gmstrftime('%A')).', '.$dia_hoje.' de '.utf8_decode(ucfirst(gmstrftime('%B'))).' '.$ano_hoje.' '.$hora_hoje;
        //echo $data;
        
        $this->Cell(0,7,$data,0,0,'R');


    }


}

//CONECTE SE AO BANCO DE DADOS SE PRECISAR 
//include("config.php"); // A MINHA CONEXÃO FICOU EM CONFIG.PHP

           include_once 'controller/ContratoController.class.php';
           include_once 'beans/Contrato.class.php';
           include_once 'services/ContratoListIterator.class.php';
           $contrato = new Contrato();
           $contratoController = new ContratoController();
           $lista = $contratoController->getListClienteEmDia();
           $contratoList = new ContratoListIterator($lista);


            //$pdf=new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
            $pdf=new PDF('L','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4 L = PAISAGEM
            $pdf->AddPage(); // ADICIONA UMA PAGINA
            $pdf->AliasNbPages(); // SELECIONA O NUMERO TOTAL DE PAGINAS, USADO NO RODAPE
            $pdf->SetFont('Arial','',8);

                //CAMPOS :
                $pdf->SetFont('Arial','B',10);

                $pdf->SetY(20);
                $pdf->SetX(18);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(17,6,utf8_decode('CÓDIGO'),1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(20);
                $pdf->SetX(35);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(120,6,'CLIENTE',1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                $pdf->SetY(20);
                $pdf->SetX(155);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(25,6,'CONTRATO',1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(20);
                $pdf->SetX(180);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'PLANO',1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                $pdf->SetY(20);
                $pdf->SetX(220);
                //$pdf->Rect(10,$y,25,$l);
                $pdf->MultiCell(40,6,'RESPONSAVEL',1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA




                //DADOS
               $pdf->SetFont('Arial','',10);
               $y = 26;
               $l = 6.1;
               $item = 0;
               $itens = 0;
               while ($contratoList->hasNextContrato()){
                   $item++;
                   $itens++;
                   $contrato = $contratoList->getNextContrato();

                   $pdf->SetY($y);
                   $pdf->SetX(10);
                   //    $pdf->Rect(10,$y,20,$l);
                   $pdf->MultiCell(8,6,$item,1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA

                   $pdf->SetY($y);
                   $pdf->SetX(18);
                   //    $pdf->Rect(10,$y,20,$l);
                   $pdf->MultiCell(17,6,$contrato->getCliente()->getCdCliente(),1,'C',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                   $pdf->SetY($y);
                   $pdf->SetX(35);
                   //$pdf->Rect(30,$y,80,$l);
                   $pdf->MultiCell(120,6,$contrato->getCliente()->getNmCliente()." ".$contrato->getCliente()->getNmSobrenome(),1,'L',false); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA


                   $pdf->SetY($y);
                   $pdf->SetX(155);
                   //    $pdf->Rect(10,$y,20,$l);
                   $pdf->MultiCell(25,6,$contrato->getCdContrato(),1,'C',false);

                   $pdf->SetY($y);
                   $pdf->SetX(180);
                   $pdf->MultiCell(40,6,utf8_decode($contrato->getPlano()->getDsPlano()),1,'C',false);


                   $pdf->SetY($y);
                   $pdf->SetX(220);
                   $pdf->MultiCell(40,6,$contrato->getResponsavel()->getDsLogin(),1,'C',false); //CPF

                   $y += $l;
                   if($itens > 24)
                   {
                       $pdf->AddPage();
                       $itens = 0;
                       $y = 20;
                   }


               }


$pdf->Footer();
$pdf->Output(); // IMPRIME O PDF NA TELA

Header('Pragma: public'); // ESTA FUNÇÃO É USADA PELO FPDF PARA PUBLICAR NO IE

function contaLinhas($text, $maxwidth){	
	$lines=0;
	if($text==''){
		$cont = 1;
	}else{
		$cont = strlen($text);
	}
	if($cont < $maxwidth){
		$lines = 1;
	}else{
		if($cont % $maxwidth > 0){
			$lines = ($cont / $maxwidth) + 1; 
		}else{
			$lines = ($cont / $maxwidth); 
		}
	} 
	$lines = $lines + substr_count(nl2br($text),'
');
	return $lines;

    }



