<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'finalizado-tecnico';

//verificar se ele tem a permissão de estar nessa página
/*if(@$cargos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}*/

 ?>

 
<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
			<div class="modal-body">				
				
				<div class="row">

					<div class="col-md-3">						
						<div class="form-group"> 
							<label>Situação</label> 
							<input type="text" class="form-control" name="tipo_chamado" id="tipo_chamado" readonly> 
						</div>						
					</div>

					

					<div class="col-md-12">
						<div class="form-group"> 
							<label>Descrição</label> 
							<textarea maxlength="500" type="text" class="form-control" name="descricao" id="descricao" readonly> </textarea>
						</div>
					</div>


					<div class="col-md-3">	
						<div class="form-group"> 
							<label>Status</label> 
							<select class="form-control" name="atendimento" id="atendimento"> 
								<option value="Finalizado">Finalizado</option>
								<option value="Executando">Executando</option>
								<option value="Agendado">Agendado</option>
							</select>
						</div>
					</div>


					<div class="col-md-12">
						<div class="form-group"> 
							<label>Parecer técnico <small>(Max 500 Caracteres)</small></label> 
							<textarea maxlength="500" type="text" class="form-control" name="obstecnico" id="obstecnico"> </textarea>
						</div>
					</div>

					<div class="col-md-3" style="margin-top:20px">						 
						<button type="submit" class="btn btn-primary">FINALIZAR</button>
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


<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="titulo_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-9">							
						<span><b>Solicitante: </b></span>
						<span id="nome_solicitante_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Setor: </b></span>
						<span id="nome_setor_mostrar"></span>
					</div>

					
					
				</div>	


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data Chamada: </b></span>
						<span id="data_solicitacao_mostrar"></span>
					</div>
					
				</div>			




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-4">							
						<span><b>Situação: </b></span>
						<span id="tipo_chamado_mostrar"></span>
					</div>
					
				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Descrição: </b></span>
						<div id="descricao_mostrar"></div>							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>