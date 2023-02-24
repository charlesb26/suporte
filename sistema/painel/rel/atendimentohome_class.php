<?php 
require_once("../../conexao.php");

$dataInicial = $_POST['dataInicial'];
$dataFinal = $_POST['dataFinal'];
$tecnico = $_POST['tecnico'];
$tipo_chamado = $_POST['tipo_chamado'];
$reparticao = $_POST['reparticao'];//id do setor


//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."sistema/painel/rel/atendimentohome.php?dataInicial=$dataInicial&dataFinal=$dataFinal&tecnico=$tecnico&tipo_chamado=$tipo_chamado&reparticao=$reparticao");


if($relatorio_pdf != 'pdf'){
	echo $html;
	exit();
}

//CARREGAR DOMPDF
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new DOMPDF($options);


//Definir o tamanho do papel e orientação da página dompdf
$pdf->set_paper('A4', 'portrait');// landscape // -> PAISAGEM  + // portrait  //-> RETRATO

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'logs.pdf',
array("Attachment" => false)
);


?>