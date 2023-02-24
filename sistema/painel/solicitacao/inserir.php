<?php
@session_start();
$tabela = 'solicitacao';
require_once("../../conexao.php");

$solicitante = @$_SESSION['id_usuario'];//se for zero pegar id do funcionario
$tombamento = $_POST['tombamento'];
$tipo_chamado = $_POST['tipo_chamado'];
$descricao = $_POST['descricao'];

$id = $_POST['id'];

$descricao = str_replace("'", "", $descricao);
$descricao = str_replace("\"", "", $descricao);
$descricao = str_replace(".", "", $descricao);
$descricao = str_replace("-", "", $descricao);
$descricao = str_replace(array("\n", "\r"), ' ', $descricao);



//recuperar o nome do solicitante
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_solicitante = $res2[0]['nome'];
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET solicitante = '$solicitante', data_solicitacao = now(), tipo_chamado = '$tipo_chamado', descricao = :descricao, atendimento = 'Aberto', tecnico = 0, obstecnico = 'no aguardo', data_tec = '0000-00-00 00:00:00', tombamento = :tombamento");//curDate()
	$acao = 'inserção';
}else{
	$query = $pdo->prepare("UPDATE $tabela SET tipo_chamado = '$tipo_chamado', descricao = :descricao, tombamento = :tombamento WHERE id = '$id'");
	$acao = 'edição';
}

    $query->bindValue(":descricao", "$descricao");
    $query->bindValue(":tombamento", "$tombamento");
	
	$query->execute();
	$ult_id = $pdo->lastInsertId();


if(@$ult_id == "" || @$ult_id == 0){
	$ult_id = $id;
}

//inserir log
$acao = $acao;
$descricao = $tipo_chamado;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

echo 'Salvo com Sucesso'; 

?>