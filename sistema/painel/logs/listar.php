<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM logs WHERE data = curdate() and (acao = 'login' OR acao = 'logout') ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Usuário</th>
	<th>Data / Hora</th>		
	<th>Telefone</th>
	<th>Situação</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
			$usuario = $res[$i]['usuario'];
			$data = $res[$i]['data'];
			$hora = $res[$i]['hora'];
			$acaoo = $res[$i]['acao'];

			$dataF = implode('/', array_reverse(explode('-', $data)));

		$query2 = $pdo->query("SELECT id, SUBSTRING_INDEX(nome, ' ', 3) as nome, id_func FROM usuarios where id = '$usuario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_usuario = $res2[0]['nome'];
			$id_func = $res2[0]['id_func'];
		}else{
			$nome_usuario = 'Sem Cidade';
		}

		$query2 = $pdo->query("SELECT telefone FROM funcionarios where id = '$id_func'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$telefone = $res2[0]['telefone'];
			$setor = $res2[0]['setor'];

			
		}else{
			$telefone = '*******';
			$setor = '';
			
		}
		
		//$ativo = $res[$i]['ativo'];

		if($acaoo == 'login'){
			$icone = 'fa-check-square';
			$titulo_link = 'Desativar Item';
			//$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'fa-square-o';
			$titulo_link = 'Ativar Item';
			//$acao = 'Sim';
			$classe_linha = 'text-muted';
		}



		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td>{$nome_usuario}</td>
		<td>{$dataF} ás {$hora}</td>		
		<td>{$telefone}</td>
		<td>{$acaoo}</td>
				
		
		</tr> 
		HTML;
	}
	echo <<<HTML
	</tbody> 	
	</table>
	</small>
	HTML;
}else{
	echo 'Não possui nenhum registro cadastrado!';
}

?>




<script type="text/javascript">


	$(document).ready( function () {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
	} );



	
	

</script>



