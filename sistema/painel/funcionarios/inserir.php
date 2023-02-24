<?php 
$tabela = 'funcionarios';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$data_adm = $_POST['data_adm'];
$cargo = $_POST['cargo'];
$setor = $_POST['setor'];


$obs = $_POST['obs'];
$id = $_POST['id'];

$cpf = str_replace('.', '', $cpf);
$cpf = str_replace('-', '', $cpf);


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-perfil.jpg';
}

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'CPF já Cadastrado, escolha Outro!';
	exit();
}

//validar email
$query = $pdo->query("SELECT * FROM $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Email já Cadastrado, escolha Outro!';
	exit();
}




//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-perfil.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



//recuperar o nome do cargo
$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$nome_cargo = $res2[0]['nome'];
	}

if($nome_cargo == 'Gerente'){
	$nivel_usu = 'Gerente';				
}


if($nome_cargo == 'Técnico'){
	$nivel_usu = 'Técnico';			
}

if($nome_cargo == 'Usuarios'){
	$nivel_usu = 'Usuarios';			
}




if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco, data_admissao = '$data_adm', cargo = '$cargo', setor = '$setor', obs = :obs, foto = '$foto', ativo = 'Sim'");


$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":email", "$email");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":obs", "$obs");
$query->execute();
$ult_id = $pdo->lastInsertId();


	//inserir o funcionário na tabela de usuários	
	if(@$nivel_usu != ""){
		$query_usu = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf,  email = :email, senha_crip = :senha_crip, senha = :senha, nivel = '$nivel_usu',  foto = '$foto' , id_func = '$ult_id', ativo = 'Sim'");


		$senha_crip = md5('123@mudar');
		$query_usu->bindValue(":nome", "$nome");
		$query_usu->bindValue(":email", "$email");
		$query_usu->bindValue(":cpf", "$cpf");
		$query_usu->bindValue(":senha_crip", "$senha_crip");
		$query_usu->bindValue(":senha", "123@mudar");	
		$query_usu->execute();
	}
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco, data_admissao = '$data_adm', cargo = '$cargo', setor = '$setor', obs = :obs, foto = '$foto' WHERE id = '$id'");


$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":email", "$email");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":obs", "$obs");
$query->execute();


	//atualizar na tabela de usuários
	if(@$nivel_usu != ""){
		$query_usu = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf,  email = :email, nivel = '$nivel_usu',  foto = '$foto' WHERE id_func = '$id'");

		if($query_usu != ""){
			$senha_crip = md5('123@mudar');
			$query_usu->bindValue(":nome", "$nome");
			$query_usu->bindValue(":cpf", "$cpf");
			$query_usu->bindValue(":email", "$email");
						
			$query_usu->execute();
		}
	}

}



echo 'Salvo com Sucesso'; 

?>