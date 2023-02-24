<?php 
$tabela = 'solicitacao';
require_once("../../conexao.php");

$atendimento = $_POST['atendimento'];
$obstecnico = $_POST['obstecnico'];
$id = $_POST['id'];

//validar nome
/*$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Nome já Cadastrado, escolha Outro!';
	exit();
}
*/

/*
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);*/
/*
if($total_reg > 0){
	$foto = $res[0]['foto'];
	$foto_ficha = $res[0]['foto_ficha'];
}else{
	$foto = 'sem-foto.png';
	$foto_ficha = 'sem-foto.png';
}
*/



$query = $pdo->prepare("UPDATE $tabela SET obstecnico = :obstecnico, atendimento = '$atendimento', data_tec = now() WHERE id = '$id'");


$query->bindValue(":obstecnico", "$obstecnico");
$query->execute();



echo 'Salvo com Sucesso'; 

?>