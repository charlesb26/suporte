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
			<th class="esc">Data chamado</th>
			<th>Ocorrência</th>
			<th>Status</th> 	
			<th>Ações</th>
			</tr> 
		</thead>

	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$id = $res[$i]['id'];
		$solicitante = $res[$i]['solicitante'];	//p	
		$data_solicitacao = $res[$i]['data_solicitacao'];
		$tipo_chamado = $res[$i]['tipo_chamado'];//p
		$descricao = $res[$i]['descricao'];//p
		$atendimento = $res[$i]['atendimento'];
		$tecnico = $res[$i]['tecnico'];//p

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

		//Recuperar nome do Técnico ecalado para a chamada
		if ($tecnico != 0) {
			$query2 = $pdo->query("SELECT id, SUBSTRING_INDEX(nome, ' ', 1) as nome, id_func FROM usuarios where id = '$tecnico'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

			$id_tec = $res2[0]['id'];
			$nome_tec = $res2[0]['nome'];
			$id_fun = $res2[0]['id_func'];


			$query3 = $pdo->query("SELECT * FROM funcionarios where id = '$id_fun'");
			$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			$telefone = $res3[0]['telefone'];

			$telefoneF = str_replace("(", "", $telefone);
			$telefoneF = str_replace(") ", "", $telefoneF);
			$telefoneF = str_replace("-", "", $telefoneF);

			$classe_msg = 'text-success';


		}else{
			$id_tec = '';
			$nome_tec = 'Falta escalonar';
			$classe_msg = 'text-warning';
			$telefoneF = '';
		}
		
		/*if(@count($res2) > 0){
			$id_tec = $res2[0]['id'];
			$nome_tec = $res2[0]['nome'];
		}else{
			$id_funcionario = '';
			$nome_solicitante = 'Sem solicitante';
		}*/

		//Recuperar nome do solicitante da chamada
		$query2 = $pdo->query("SELECT id, SUBSTRING_INDEX(nome, ' ', 1) as nome, id_func FROM usuarios where id = '$solicitante'");
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
		

		$msg = 'Amigo *'.$nome_tec. "\n"."\r\n" . '*, temos um chamado no *'.$nome_setor. "\r\n"."\r\n" . '* com o problema de *' . "\r\n"."\r\n" .$tipo_chamado. "*\n"."\r\n" . ', especificamente *'.$descricao. "*\r\n"."\r\n" . ', fala com o(a) *'.$nome_solicitante.'*';

		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td> {$nome_solicitante} </td> 
		<td class="esc"> {$nome_setor} </td> 
		<td class="esc"> {$data_solicitacaoN} </td>
		<td title="{$descricao}">{$tipo_chamado}</td>
		<td> {$atendimento} </td> 
		
		
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$tecnico}', '{$nome_tec}', '{$tipo_chamado}', '{$descricao}', '{$nome_setor}', '{$nome_solicitante}')" title="Definir Técnico"><i class="fa fa-edit text-primary"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

			<ul class="dropdown-menu" style="margin-left:-230px;">
				<li>
					<div class="notification_desc2">
						<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
					</div>
				</li>
			</ul>
		</li>

		<li class="dropdown head-dpdn2" style="display: inline-block;">			
			<a class="text-dark" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55{$telefoneF}&text=$msg"> <i class="fa fa-whatsapp {$classe_msg}"></i></a>
		</li>


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



	function editar(id, tecnico, nome_tec, tipo_chamado, descricao, nome_setor, nome_solicitante){

		
		$('#id').val(id);
		$('#tecnico').val(tecnico);

		$('#nome_tec').val(nome_tec);
		$('#tipo_chamado').val(tipo_chamado);
		$('#descricao').val(descricao);
		$('#nome_setor').val(nome_setor);
		$('#nome_solicitante').val(nome_solicitante);
		
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



