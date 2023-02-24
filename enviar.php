<?php 
require_once("sistema/conexao.php");


if($_POST['nome'] == ""){
	echo 'Preencha o campo Nome!!';
	exit();
}

if($_POST['email'] == ""){
	echo 'Preencha o campo Email!!';
	exit();
}


if($_POST['comentario'] == ""){
	echo 'Preencha o campo Mensagem!!';
	exit();
}

$remetente = $email_adm;
$assunto = 'Contato do Site Imobiliária';

$mensagem = utf8_decode('Nome: '.$_POST['nome']. "\r\n"."\r\n" . 'Telefone: '.$_POST['telefone']. "\r\n"."\r\n" . 'Mensagem: ' . "\r\n"."\r\n" .$_POST['comentario']);
$dest = $_POST['email'];
$cabecalhos = "From: " .$dest;

mail($remetente, $assunto, $mensagem, $cabecalhos);

echo 'Enviado com Sucesso!';

 ?>
