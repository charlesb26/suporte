<?php 
$tabela = 'solicitacao';
require_once("../../conexao.php");

$id = $_POST['id'];
$tipo_chamados = $_POST['nome'];


$query = $pdo->query("SELECT * FROM  $tabela where id = $id and atendimento != 'Aberto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este atendimento não pode ser excluído, pois o chamado já entrou em execução!';
	exit();
}


$pdo->query("DELETE FROM $tabela where id = '$id'");


//inserir log
$acao = 'exclusão';
$descricao = $tipo_chamados;
$id_reg = $id;
require_once("../inserir-logs.php");


echo 'Excluído com Sucesso';

?>