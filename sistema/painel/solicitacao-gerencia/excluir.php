<?php 
$tabela = 'solicitacao';
require_once("../../conexao.php");

$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM $tabela where id = '$id' and tecnico != 0");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo 'Você não pode excluir uma chamada com técnico já Escalado!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>