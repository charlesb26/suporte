<?php
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'solicitacao';


//verificar se ele tem a permissão de estar nessa página
if(@$_SESSION['nivel_usuario'] != "Administrador" && @$_SESSION['nivel_usuario'] != "Usuarios"){// 
echo "<script>window.location='../index.php'</script>";
exit();
}



 ?>

 <button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Chamada</button>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
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
								<label>Tipo Chamado</label> 
								<select class="form-control" name="tipo_chamado" id="tipo_chamado" required> 
									<option value="Computador">Computador</option>
									<option value="Documentos">Documentos</option>
									<option value="Impressora">Impressora</option>
									<option value="Internet">Internet</option>
									<option value="Login">Login</option>
									<option value="Monitor">Monitor</option>
									<option value="Rede interna">Rede interna</option>
									<option value="Software">Software</option>
									<option value="Outros">Outros</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group"> 
								<label></label> 
								<input type="text" class="form-control" name="tombamento" id="tombamento"> 
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group"> 
								<label>Descrição <small>(Max 500 Caracteres)</small></label> 
								<textarea maxlength="500" type="text" class="form-control" name="descricao" id="descricao" required> </textarea>
							</div>
						</div>	

					</div>

					<br>
					<input type="hidden" name="id" id="id"> 
					
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Enviar</button>					
				</div>



			</form>

		</div>
	</div>
</div>





<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="solicitante_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
				<div class="modal-body">			
					


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-4">							
							<span><b>TIPO: </b></span>
							<span id="tipo_chamado_mostrar"></span>							
						</div>
						<div class="col-md-12">							
							<span><b>Descrição da chamada: </b></span>
							<span id="descricao_mostrar"></span>
						</div>
					</div>


					

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
							<span><b>Data de Chamada: </b></span>
							<span id="data_solicitacao_mostrar"></span>							
						</div>
						
					</div>		


								

				</div>


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





<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>


<script>
	$(document).ready(function() {// ao ler o documento
		
		document.getElementById('tombamento').style.display = 'none';
		$('#tombamento').attr('');

		$('#tipo_chamado').change(function(){
			if($(this).val() == 'Computador'){ 				
				document.getElementById('tombamento').style.display = 'block';
				$('#tombamento').attr('placeholder','Informe o número do Tombamento');
			}else if($(this).val() == 'Monitor'){				
				document.getElementById('tombamento').style.display = 'block';
				$('#tombamento').attr('placeholder','Informe o número do Tombamento');				
			}else{
				document.getElementById('tombamento').style.display = 'none';
				$('#tombamento').attr('');
			}
		});


		
	});

</script>