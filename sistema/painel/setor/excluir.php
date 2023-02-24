<?php 
$tabela = 'setor';
require_once("../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM funcionarios where setor = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este setor não pode ser excluído, primeiro exclua os funcionários relacionados a ele para depois excluir este setor!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>