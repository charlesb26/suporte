<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'solicitacao-gerencia';

//verificar se ele tem a permissão de estar nessa página
if(@$cargos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>
<h3><center><b>Gerencimento de Chamadas</b></center></h3>
 
<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>


<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
			<div class="modal-body">				
				
				<div class="row">
					<div class="col-md-12">						
						<div class="form-group"> 
							<label>Técnico</label> 
							<select class="form-control sel2" name="tecnico" id="tecnico" required style="width:100%;">
								<option value="0"></option>
								<?php 
								$query = $pdo->query("SELECT id, SUBSTRING_INDEX(nome, ' ', 1) as nome FROM usuarios where nivel = 'Técnico' || nome = 'Gene' order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){
									foreach ($res[$i] as $key => $value){}
										?>
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
								<?php } ?>
							</select>
						</div>						
					</div>

					

				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group"> 
							<label>TÉCNICO</label> 
							<input type="text" class="form-control" name="nome_tec" id="nome_tec"> 
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group"> 
							<label>SOLICITANTE</label> 
							<input type="text" class="form-control" name="nome_solicitante" id="nome_solicitante"> 
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group"> 
							<label>SETOR</label> 
							<input type="text" class="form-control" name="nome_setor" id="nome_setor"> 
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group"> 
							<label>TIPO</label> 
							<input type="text" class="form-control" name="tipo_chamado" id="tipo_chamado"> 
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group"> 
							<label>SITUAÇÃO</label> 
							<input type="text" class="form-control" name="descricao" id="descricao"> 
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12" align="right" style="margin-top:-5px">						 
						<button type="submit" class="btn btn-dark">Salvar</button>
					</div>
				</div>

				
				
				
				<br>
				<input type="hidden" name="id" id="id"> 
				<small><div id="mensagem" align="center" class="mt-3"></div></small>					

			</div>

			
			
			</form>

		</div>
	</div>
</div>




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>