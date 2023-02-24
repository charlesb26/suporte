<?php
date_default_timezone_set('America/Boa_Vista'); 

$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/suportev3/";
}


$usuario = 'root';
$senha = '';
$banco = 'suporte';
$servidor = 'localhost';

/*$usuario = 'geneso40_genecharles';
$senha = 'G&n&;-.12$)';
$banco = 'geneso40_suporte';
$servidor = 'localhost';*/


try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao Conectar com o banco de dados! <br><br>';
	echo $e;
}



//VARIAVEIS GLOBAIS DO SISTEMA
$nome_sistema = 'Help NTI';
$email_adm = 'aprendendorr@gmail.com';



//inserir registros na tabela config
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', telefone = $tel_sistema, telefone_fixo = $tel_fixo_sistema, email = '$email_adm',  logo = 'logo.png', favicon = 'favicon.ico', logo_rel = 'logo.jpg',  relatorio = 'pdf', logs = 'Sim' ");
}


//VARIAVEIS DE CONFIGURAÇÕES DA TABELA CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$logs = $res[0]['logs'];
$nome_sistema = $res[0]['nome'];
$tel_sistema = $res[0]['telefone'];
$tel_fixo_sistema = $res[0]['telefone_fixo'];
$email_adm = $res[0]['email'];
$end_sistema = $res[0]['endereco'];
$logo = $res[0]['logo'];
$favicon = $res[0]['favicon'];
$logo_rel = $res[0]['logo_rel'];
$relatorio_pdf = $res[0]['relatorio'];
 ?>