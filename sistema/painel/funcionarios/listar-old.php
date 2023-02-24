<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM funcionarios ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>
	<th class="esc">Telefone</th> 
	<th class="esc">CPF</th> 
	<th class="esc">Email</th>
	<th class="esc">Lotação</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$cpf = $res[$i]['cpf'];
		$telefone = $res[$i]['telefone'];
		$email = $res[$i]['email'];
		$endereco = $res[$i]['endereco'];
		$data_admissao = $res[$i]['data_admissao'];
		$cargo = $res[$i]['cargo'];
		$ativo = $res[$i]['ativo'];
		$setor = $res[$i]['setor'];
		$foto = $res[$i]['foto'];
		$obs = $res[$i]['obs'];
		

		if($ativo == 'Sim'){
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
		$obs = str_replace(array("\n", "\r"), ' + ', $obs);
		$data_admissaoF = implode('/', array_reverse(explode('-', $data_admissao)));
		//$telefoneF = utf8_encode($telefone);
		//$telefoneF = implode('', $array(explode('(', $telefone)));
		$telefoneF = str_replace("(", "", $telefone);
		$telefoneF = str_replace(") ", "", $telefoneF);
		$telefoneF = str_replace("-", "", $telefoneF);
		$qtd = strlen($cpf);
		if($qtd >= 11) {
			if($qtd === 11 ) {
				$docFormatado = substr($cpf, 0, 3) . '.' .
	                            substr($cpf, 3, 3) . '.' .
	                            substr($cpf, 6, 3) . '-' .
	                            substr($cpf, 9, 2);
			}
			$cpfF = $docFormatado;
		}


		//$telefoneG = implode('', array(explode('-', $telefoneF)));
		//$telefoneF = implode('', array_reverse(explode(' ', $telefoneF)));
		//$telefoneF = implode('', array_reverse(explode('-', $telefoneF)));

		$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cargo = $res2[0]['nome'];
		}else{
			$nome_cargo = 'Sem Cargo';
		}

		$query2 = $pdo->query("SELECT * FROM setor where id = '$setor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_setor = $res2[0]['nome'];
		}else{
			$nome_setor = 'Sem Cargo';
		}
		$msg = 'Parabéns, seu login foi liberado em nosso sistema de atendimento e chamado do *HELPNTI* _https://www.genesoft.com.br/sistema/index.php_  LOGIN: {SEU_EMAIL@} - SENHA: _123@mudar_';


		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td>
		<img src="images/perfil/{$foto}" width="27px" class="mr-2">
		{$nome}
		</td> 
		<td class="esc"><a class="text-dark" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55{$telefoneF}&text=$msg"> $telefone <i class="fa fa-whatsapp"></i></a></td>
		<td class="esc">{$cpfF}</td>
		<td class="esc">{$email}</td>
		<td class="esc">{$nome_setor}</td>
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$cpfF}', '{$telefone}', '{$email}', '{$endereco}', '{$data_admissao}', '{$cargo}', '{$setor}', '{$obs}', '{$foto}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$cpf}', '{$telefone}', '{$email}', '{$endereco}', '{$data_admissaoF}', '{$nome_cargo}', '{$nome_setor}', '{$obs}', '{$foto}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

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


		<big><a href="#" onclick="ativar('{$id}', '{$nome}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>


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



	function editar(id, nome, cpf, telefone, email, endereco, data_admissao, cargo, setor, obs, foto){


		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#cpf').val(cpf);
		$('#telefone').val(telefone);
		$('#email').val(email);
		$('#endereco').val(endereco);
		$('#data_adm').val(data_admissao);
		$('#cargo').val(cargo).change();
		$('#setor').val(setor).change();
		$('#obs').val(obs);	
		$('#foto').val('');
		$('#target').attr('src','images/perfil/' + foto);			

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}



	function mostrar(nome, cpf, telefone, email, endereco, data_admissao, cargo, setor, obs, foto){

		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}
		
		$('#nome_mostrar').text(nome);
		$('#cpf_mostrar').text(cpf);
		$('#telefone_mostrar').text(telefone);
		$('#email_mostrar').text(email);
		$('#endereco_mostrar').text(endereco);
		$('#data_adm_mostrar').text(data_admissao);
		$('#cargo_mostrar').text(cargo);		
		$('#setor_mostrar').text(setor);
		$('#obs_mostrar').text(obs);		
		
		$('#target_mostrar').attr('src','images/perfil/' + foto);	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#cpf').val('');
		$('#telefone').val('');
		$('#email').val('');
		$('#endereco').val('');
		$('#data_adm').val('<?=$data_atual?>');
		$('#obs').val('');
		
		$('#target').attr('src','images/perfil/sem-perfil.jpg');
	}


	

</script>