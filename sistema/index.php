<?php 
require_once("conexao.php");
$senha_crip = md5('123@mudar');

echo("<meta http-equiv='refresh' content='600'>");

if((date('H:i') > '17:30') && (date('H:i') < '7:30')){	
	echo "<script>window.location='../index.php'</script>";	
}

//CRIAR UM USUÁRIO ADMINISTRADOR CASO NÃO EXISTA NENHUM
$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Administrador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO usuarios SET nome = 'Administrador', cpf='000.000.000-00', email='aprendendorr@gmail.com', senha_crip='$senha_crip', senha='123@mudar', nivel='Administrador', foto = 'sem-perfil.jpg', id_func = '0', ativo = 'Sim' ");
}


//inserir os cargos que geram níveis de usuários
$query = $pdo->query("SELECT * FROM cargos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){	
	$pdo->query("INSERT INTO cargos SET nome = 'Gerente'");	
	$pdo->query("INSERT INTO cargos SET nome = 'Técnico'");
	$pdo->query("INSERT INTO cargos SET nome = 'Usuarios'");
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="login.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<link rel="shortcut icon" href="imagens/favicon (2).ico" type="image/x-icon">
	<link rel="icon" href="imagens/favicon (2).ico" type="image/x-icon">


	<title><?php echo $nome_sistema?></title>
</head>
<body class="backgorund">

	<section class="vh-100" style="background-color: #343A40;">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col col-xl-10">
					<div class="card" style="border-radius: 1rem;">
						<div class="row g-0">
							<div class="col-md-6 col-lg-5 align-items-center d-none d-md-block">
								<img
								src="imagens/img-login.jpg"
								alt="login form"
								class="img-fluid" style="border-radius: 1rem 0 0 1rem;"
								/>
							</div>
							<div class="col-md-6 col-lg-7 d-flex align-items-center">
								<div class="card-body p-4 p-lg-5 text-black">

									<form action="autenticar.php" method="POST">

										<div class="d-flex mb-3 pb-1">
											<i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
											<span class="h1 fw-bold mb-0"><img src="imagens/logo.png" width="50%"></span>
										</div>
										

										<div class="form-outline mb-4">
											<label class="form-label" for="form2Example17"></label>
											<input type="text" id="usuario" name="usuario" placeholder="Email ou CPF" class="form-control form-control-lg" required/>
											
										</div>

										<div class="form-outline mb-4">
											<label class="form-label" for="form2Example27"></label>
											<input type="password" id="senha" name="senha" placeholder="Senha" class="form-control form-control-lg" required/>
											
										</div>

										<div class="pt-1 mb-4">
											<button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
										</div>

									<!--	<a class="small text-muted" href="#" data-bs-toggle="modal" data-bs-target="#modalRecuperar">Recuperar Senha?</a>-->
										<a class="small text-muted" href="#" data-bs-toggle="modal" data-bs-target="#modalForm">Registre-se</a>
									
										
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>
</html>



<!-- ModalcRecuperar -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-recuperar" method="POST">
      <div class="modal-body">
        <input type="email" id="email" name="email" class="form-control form-control-sm" required placeholder="Digite seu email de Cadastro" />
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-secondary">Recuperar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal">Pré Cadastro</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -20px"></button>
			</div>
			<form method="post" id="form-precadastro">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-8">						
							<div class="form-group"> 
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome" id="nome" required> 
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>CPF</label> 
								<input type="text" class="form-control" name="cpf" id="cpf" required> 
							</div>						
						</div>

						

					</div>


					<div class="row">
						

						<div class="col-md-3">						
							<div class="form-group"> 
								<label>Telefone</label> 
								<input type="text" class="form-control" name="telefone" id="telefone"> 
							</div>						
						</div>


						<div class="col-md-3">						
							<div class="form-group"> 
								<label>Data Admissão</label> 
								<input type="date" class="form-control" name="data_adm" id="data_adm" value="<?php echo date('Y-m-d') ?>"> 
							</div>						
						</div>

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Status</label> 
								<select readonly class="form-control sel2" name="cargo" id="cargo" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM cargos where nome = 'Usuarios'");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Setor lotado</label> 
								<select class="form-control sel2" name="setor" id="setor" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM setor order by nome asc");
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
								<label>Endereço</label> 
								<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua X Número 20 Bairro X" required> 
							</div>
						</div>

						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Email</label> 
								<input type="email" class="form-control" name="email" id="email" required> 
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




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	<script type="text/javascript">
		$("#form-recuperar").submit(function () {

			event.preventDefault();
			var formData = new FormData(this);
			
			$.ajax({
				url: "recuperar.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {

					 $('#mensagem').removeClass()
					  $('#mensagem').addClass('text-info')
            			$('#mensagem').text("Enviando!!")

                    if(mensagem.trim() === 'Senha Enviada para o Email!'){
                        
                        $('#mensagem').addClass('text-success')                       
                       
                        $('#email').val('');                      
                      
                        $('#mensagem').text(mensagem)
                        //$('#btn-fechar').click();
                        //location.reload();

                   } else {

                        $('#mensagem').addClass('text-danger')
                        $('#mensagem').text(mensagem)
                       
                    }


				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
	});
</script>

<script type="text/javascript">
		$("#form-precadastro").submit(function () {

			event.preventDefault();
			var formData = new FormData(this);
			
			$.ajax({
				url: "precadastro.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {

					 $('#mensagem').removeClass()
					  $('#mensagem').addClass('text-info')
            			$('#mensagem').text("Enviando!!")

                    if(mensagem.trim() === 'Enviado com sucesso, aguardar confirmação do NTI!'){
                        
                        $('#mensagem').addClass('text-success')                       
                       
                        $('#email').val('');                      
                      
                        $('#mensagem').text(mensagem)
                        //$('#btn-fechar').click();
                        //location.reload();

                   } else {

                        $('#mensagem').addClass('text-danger')
                        $('#mensagem').text(mensagem)
                       
                    }


				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>

	<script type="text/javascript">
    $(document).ready(function(){
      $('#telefone').mask('(00) 00000-0000');
      $('#cpf').mask('000.000.000-00');
      });
</script>