<?php
@session_start();
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
$id_usuario = $_SESSION['id_usuario'];



echo <<<HTML
<small>
HTML;

//Abrir somente os chamados que o usuário realizou EE que ainda não foram finalizado pelos técnicos
$query = $pdo->query("SELECT * FROM solicitacao WHERE solicitante = $id_usuario AND atendimento != 'Finalizado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Solicitante</th> 
	<th class="esc">Data Chamada</th> 
	<th>Tipo</th>
	<th class="esc">Status</th>	
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
		$nome = $res[$i]['tipo_chamado'];// recuperar para exclusao
		$descricao = $res[$i]['descricao'];
		$atendimento = $res[$i]['atendimento'];
		$tombamento = $res[$i]['tombamento'];
				

		if($atendimento == 'Finalizado'){
			$icone = 'fa-check-square';
			$titulo_link = 'Desativar Item';
			$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'fa-square-o';
			$titulo_link = 'Ativar Item';
			$acao = 'Sim';
			$classe_linha = 'text-muted';
		}

		//retirar quebra de texto do obs
		$descricao = str_replace(array("\n", "\r"), ' + ', $descricao);
		$data_solicitacaoF = implode('/', array_reverse(explode('-', $data_solicitacao)));

		$data_solicitacaoN = date('d/m/Y H:i:s', strtotime($data_solicitacao));

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_solicitante = $res2[0]['nome'];
		}else{
			$nome_solicitante = 'Sem solicitante';
		}


		echo <<<HTML
		<tr class="{$classe_linha}">
		<td>{$nome_solicitante}</td> 
		<td class="esc">{$data_solicitacaoN}</td>
		<td>{$tipo_chamado}</td>
		<td class="esc">{$atendimento}</td>
		<td>

		

		<big><a href="#" onclick="mostrar('{$nome_solicitante}', '{$tipo_chamado}', '{$descricao}', '{$data_solicitacaoN}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
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



	function mostrar(solicitante, tipo_chamado, descricao, data_solicitacao){

		for (let letra of descricao){  				
					if (letra === '+'){
						descricao = descricao.replace(' +  + ', '\n')
					}			
				}
		
		$('#solicitante_mostrar').text(solicitante);
		$('#tipo_chamado_mostrar').text(tipo_chamado);
		$('#descricao_mostrar').text(descricao);
		$('#data_solicitacao_mostrar').text(data_solicitacao);			
		
				

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#tipo_chamado').val('');
		$('#descricao').val('');
	/*	$('#cpf').val('');
		$('#email').val('');
		$('#endereco').val('');
		$('#obs').val('');
		$('#data_adm').val('<?=$data_atual?>');
		$('#target').attr('src','images/perfil/sem-perfil.jpg');*/
		
	}


	

</script>



