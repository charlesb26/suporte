<?php 
require_once("conexao.php");

$email = $_POST['email'];
//echo $email;
//exit();

$res = $pdo->query("SELECT * FROM usuarios where email = '$email' "); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

if(@count($dados) > 0){
    $senha = $dados[0]['senha'];
   
   //ENVIAR O EMAIL COM A SENHA
    $destinatario = $email;
    $assunto = $nome_sistema . ' - Recuperação de Senha';
    $mensagem = utf8_decode('Sua senha é ' .$senha);
    $cabecalhos = "From: ".$email_adm;
    mail($destinatario, $assunto, $mensagem, $cabecalhos);

    echo 'Senha Enviada para o Email!';
}else{
   echo 'Este email não está cadastrado!';

}



 ?>
