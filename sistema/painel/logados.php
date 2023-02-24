<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'logs';
 ?>

 <!--<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Bairro</button>-->

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
							<div class="col-md-5">			
							<div class="form-group"> 
								<label>Usuário</label> 
								<input type="text" class="form-control" name="usuario" id="usuario" required> 
							</div>				
							</div>

							<div class="col-md-5">			
							<div class="form-group"> 
								<label>Usuario</label> 
								<select class="form-control sel2" name="cidade" id="cidade" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM usuarios order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							</div>				
							</div>

							<div class="col-md-2" align="right" style="margin-top:22px">	
								<button type="submit" class="btn btn-primary">Salvar</button>
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


<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
	});
</script>



