<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM solicitacao where atendimento != 'Finalizado' ORDER BY data_solicitacao desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Solicitante</th>
	<th class="esc">Setor</th> 	
	<th class="esc">Dt Chamada</th>
	<th>Situação</th>
	<th>Status</th> 	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$id = $res[$i]['id'];
		$solicitante = $res[$i]['solicitante'];		
		$data_solicitacao = $res[$i]['data_solicitacao'];
		$tipo_chamado = $res[$i]['tipo_chamado'];
		$descricao = $res[$i]['descricao'];
		$atendimento = $res[$i]['atendimento'];
		$tecnico = $res[$i]['tecnico'];

		$data_solicitacaoN = date('d/m/Y H:i:s', strtotime($data_solicitacao));

		if($atendimento == 'Aberto'){
			//$icone = 'fa-check-square';
			//$titulo_link = 'Desativar Item';
			//$acao = 'Não';
			$classe_linha = 'success';
		}else if($atendimento == 'Executando'){
			//$icone = 'fa-square-o';
			//$titulo_link = 'Ativar Item';
			//$acao = 'Sim';
			$classe_linha = 'text-muted';
		}

		//Recuperar nome do solicitante da chamada
		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$id_funcionario = $res2[0]['id_func'];
			$nome_solicitante = $res2[0]['nome'];
		}else{
			$id_funcionario = '';
			$nome_solicitante = 'Sem solicitante';
		}

		//Recuperar setor do Solicitante
		$query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_funcionario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){			
			$id_setor = $res2[0]['setor'];
		}else{
			$id_setor = '';
		}

		$query2 = $pdo->query("SELECT * FROM setor where id = '$id_setor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){			
			$nome_setor = $res2[0]['nome'];
		}else{
			$nome_setor = 'Sem setor';
		}



		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td> {$nome_solicitante} </td> 
		<td class="esc"> {$nome_setor} </td> 
		<td class="esc"> {$data_solicitacaoN} </td>
		<td title="{$descricao}">{$tipo_chamado}</td>
		<td> {$atendimento} </td> 
		
		
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$tecnico}')" title="Definir Técnico"><i class="fa fa-edit text-primary"></i></a></big>



		</td>  
		</tr> 
		HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
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



	function editar(id, tecnico){

		
		$('#id').val(id);
		$('#tecnico').val(tecnico);
		
		$('#tituloModal').text('Escalar Técnico');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}




	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');		
		$('#target').attr('src','images/tipos/sem-foto.png');
		$('#target-ficha').attr('src','images/tipos/sem-foto.png');
		$('#foto').val('');
		$('#foto-ficha').val('');
	}


	

</script>



