<?php 
$tabela = 'solicitacao';
require_once("../../conexao.php");

$tecnico = $_POST['tecnico'];
$id = $_POST['id'];

//msg grupo whatsap
$nome_tec = $_POST['nome_tec'];
$nome_solicitante = $_POST['nome_solicitante'];
$nome_setor = $_POST['nome_setor'];
$tipo_chamado = $_POST['tipo_chamado'];
$descricao = $_POST['descricao'];



$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);



if($tecnico == "0"){
	
	$query = $pdo->prepare("UPDATE $tabela SET tecnico = '$tecnico', atendimento = 'Aberto' WHERE id = '$id'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET tecnico = '$tecnico', atendimento = 'Executando' WHERE id = '$id'");

}

$query->execute();



echo 'Salvo com Sucesso'; 

?>