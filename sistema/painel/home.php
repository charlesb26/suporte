<?php 
require_once("verificar.php");
require_once("../conexao.php");



$total_tecnicos = 0;
$total_setores = 0;
$total_hosts = 0;
$total_atendidoHoje = 0;
$total_chamadoHoje = 0;
$totalTarefasHoje = 0;
$totalTarefasConcluidasHoje = 0;
$porcentagemTarefas = 0;
$totalChamadasDoSetor = 0;
$totalChamadosExecutandoHoje =  0;
$totalChamadosAbertoHoje = 0;

$totalChamadas = 0;
$totalChamadasFinalizadas = 0;
$porcentagemChamadasFinalizadas = 0;
$porcentagemSetorMaiorNrChamada = 0;
$porcentagemChamadosAberto = 0;

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Técnico' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_tecnicos = @count($res);

$query = $pdo->query("SELECT * FROM setor");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_setores = @count($res);


$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Usuarios' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_hosts = @count($res);

$query = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Finalizado' and DATE(data_tec) = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_atendidoHoje = @count($res);

$query = $pdo->query("SELECT * FROM solicitacao where DATE(data_solicitacao) = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_chamadoHoje = @count($res);

//chamadas realizadas
$query = $pdo->query("SELECT * FROM solicitacao"); //where data = curDate() and usuario = '$id_usu'
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalChamadas = @count($res);

// chamada finalizada
$query = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Finalizado'");// data = curDate() and usuario = '$id_usu' and
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalChamadasFinalizadas = @count($res);

// setor com maior nr chamada
$query = $pdo->query("SELECT st.nome as reparticao, COUNT(*) as qtd FROM solicitacao sl INNER JOIN usuarios sr ON sl.solicitante = sr.id INNER JOIN funcionarios fc ON sr.id_func = fc.id INNER JOIN setor st ON fc.setor = st.id GROUP BY st.nome order by qtd desc limit 1");// data = curDate() and usuario = '$id_usu' and
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$reparticao_maiorNr_chamado = $res[0]['reparticao'];
	$totalChamadasDoSetor = $res[0]['qtd'];
}else{
	$reparticao_maiorNr_chamado = '';
	$totalChamadasDoSetor = 0;
}

if($totalChamadasDoSetor > 0 and $totalChamadas > 0){
	$porcentagemSetorMaiorNrChamada = ($totalChamadasDoSetor / $totalChamadas) * 100;
}


if($totalChamadasFinalizadas > 0 and $totalChamadas > 0){
	$porcentagemChamadasFinalizadas = ($totalChamadasFinalizadas / $totalChamadas) * 100;
}


$query = $pdo->query("SELECT * FROM tarefas where data = curDate() and usuario = '$id_usu'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefasHoje = @count($res);

$query = $pdo->query("SELECT * FROM tarefas where data = curDate() and usuario = '$id_usu' and status = 'Concluída'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefasConcluidasHoje = @count($res);

if($totalTarefasConcluidasHoje > 0 and $totalTarefasHoje > 0){
	$porcentagemTarefas = ($totalTarefasConcluidasHoje / $totalTarefasHoje) * 100;
}

$query = $pdo->query("SELECT * FROM solicitacao where DATE(data_solicitacao) = curDate() and atendimento = 'Aberto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalChamadosAbertoHoje = @count($res);

$query = $pdo->query("SELECT * FROM solicitacao where DATE(data_solicitacao) = curDate() and atendimento = 'Executando'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalChamadosExecutandoHoje = @count($res);

if($totalChamadosExecutandoHoje > 0 and $totalChamadosAbertoHoje > 0){
	$porcentagemChamadosAberto = ($totalChamadosAbertoHoje / $totalChamadosExecutandoHoje) * 100;
}
 ?>
<div class="main-page">
			<div class="col_3">
        	<a href="#">	<!-- index.php?pagina=compradores -->
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa user1 icon-rounded" >🏢</i>
                    <div class="stats">
                      <h5><strong><?php echo $total_setores ?></strong></h5>
                      <span>Repartições</span>
                    </div>
                </div>
        	</div>
        	</a>
        	<a href="#"> <!-- index.php?pagina=vendedores -->
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa user2 icon-rounded">🖥️</i>
                    <div class="stats">
                      <h5><strong><?php echo $total_hosts ?></strong></h5>
                      <span>Hosts</span>
                    </div>
                </div>
        	</div>
        	</a>
        	<a href="">	<!-- index.php?pagina=funcionarios -->
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa  icon-rounded">🧑‍🔧</i>
                    <div class="stats">
                      <h5><strong><?php echo $total_tecnicos ?></strong></h5>
                      <span>Técnicos</span>
                    </div>
                </div>
        	</div>
        	</a>
        	<a href="#"> <!-- index.php?pagina=locatarios -->
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa dollar1 icon-rounded">☎️</i>
                    <div class="stats">
                      <h5><strong><?php echo $total_chamadoHoje ?></strong></h5>
                      <span>Chamados Hoje</span>
                    </div>
                </div>
        	 </div>
        	 </a>
        	<a href="#"> <!-- index.php?pagina=locadores -->
        	<div class="col-md-3 widget">
        		<div class="r3_counter_box">
                    <i class="pull-left fa dollar2 icon-rounded">🏁</i>
                    <div class="stats">
                      <h5><strong><?php echo $total_atendidoHoje ?></strong></h5>
                      <span>Atendidos Hoje</span>
                    </div>
                </div>
        	 </div>
        	</a>
        	<div class="clearfix"> </div>
		</div>
		
		<div class="row-one widgettable">
			<div class="col-md-8 content-top-1 card">
				<div class="agileinfo-cdr">
					<?php 
					if(@$_SESSION['nivel_usuario'] == "Usuarios"){/// definir tipo nivel USR, GER, TEC
						//echo "NIVEL: " .@$_SESSION['nivel_usuario'];
						//exit();
					
					?>
					
					<div class="col-md-14"><!--  <?php //echo $esc_vis ?> -->
						<div class="activity_box">
							<a href="index.php?pagina=solicitacao"><h2>LISTA DE CHAMADAS DO CLIENTE</h2></a>
							<div class="scrollbar" id="style-1">

								<?php 
									$query = $pdo->query("SELECT * FROM solicitacao where solicitante = '$id_usu' and atendimento != 'Finalizado' limit 6");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										
										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){}
											$id_solic = $res[$i]['id'];
											$tipo_chamad = $res[$i]['tipo_chamado'];
											$descricao_chamad = $res[$i]['descricao'];
											$atendimento_chamad = $res[$i]['atendimento'];
											$data_chamad = $res[$i]['data_solicitacao'];

											$data_solicitacaoN = date('d/m/Y', strtotime($data_chamad));

											//$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

								?>
								<div class="activity-row">

									<?php if ($id_solic != 0) {?>

									<div class="col-xs-3 activity-desc"><?php echo $tipo_chamad ?></div>

									<div class="col-xs-2 activity-desc">
										<p><?php echo $data_solicitacaoN ?></p>
									</div>
									<div class="col-xs-5 activity-desc">
										<p><h6><?php echo $descricao_chamad ?></h6></p>
									</div>

									<div class="col-xs-2 activity-desc"><h6><?php echo $atendimento_chamad ?></h6></div>


								<?php } ?>
									
									
									<div class="clearfix"> </div>
								</div>
								<?php } }else{ ?>
									<div class="row-one"><h1><b>SEM CHAMADOS ABERTO EM SEU NOME!</b></h1></div>
									<br><b>Clique <a href="index.php?pagina=solicitacao">AQUI</a> para abrir novas chamadas.</b>
								<?php }?>

							</div>

						</div>
					</div>

					<!-- MUDOU TIPO DE NIVEL DE USUARIO -->
					<?php } else if(@$_SESSION['nivel_usuario'] == "Gerente"){
					?>
					<!--  <div><img style="width: 100%; height: 370px" src='images/slider4.jpg' class="img-responsive" alt=""/></div> id="Linegraph"  -->
					 <div class="col-md-14"><!--  <?php //echo $esc_vis ?> -->
						<div class="activity_box">
							<a href="index.php?pagina=solicitacao-gerencia"><h2>LISTA DE GERENCIAMENTO DE CHAMADAS PARA ESCALONAR</h2></a>
							<div class="scrollbar" id="style-1">

								<?php 
									$query = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Aberto' limit 6");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										
										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){}
											$id_soli = $res[$i]['id'];
											$id_solicant = $res[$i]['solicitante'];
											$tipo_chamad = $res[$i]['tipo_chamado'];
											$descricao_chamad = $res[$i]['descricao'];
											$atendimento_chamad = $res[$i]['atendimento'];
											$data_chamad = $res[$i]['data_solicitacao'];

											$data_solicitacaoN = date('d/m/Y', strtotime($data_chamad));


											//Recuperar nome do solicitante da chamada
											$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_solicant'");
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

											//$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

								?>
								<div class="activity-row">

									<?php if ($id_soli != 0) {?>

									<div class="col-xs-3 activity-desc" title="<?php echo $nome_solicitante ?>"><?php echo $nome_setor ?></div>

									<div class="col-xs-4 activity-desc">
										<p title="<?php echo $descricao_chamad ?>"><?php echo $tipo_chamad ?></p>
									</div>
									<div class="col-xs-3 activity-desc">
										<p><h6><?php echo $data_solicitacaoN ?></h6></p>
									</div>

									<div class="col-xs-2 activity-desc"><h6><?php echo $atendimento_chamad ?></h6></div>


								<?php } ?>
									
									
									<div class="clearfix"> </div>
								</div>
								<?php } }else{ ?>
									<div class="row-one"><h1><b>SEM ATENDIMENTO PARA ESCALONAR!</b></h1></div>
									<br><b>Clique <a href="index.php?pagina=solicitacao-gerencia">AQUI</a> para ser direcionado a página de escalonamento.</b>
								<?php }?>

							</div>

						</div>
					</div>


				<!-- FINAL DO MUDOU TIPO DE NIVEL DE USUARIO -->


				<!-- MUDOU TIPO DE NIVEL DE USUARIO -->
					<?php } else if(@$_SESSION['nivel_usuario'] == "Técnico"){
					?>
					<!--  <div><img style="width: 100%; height: 370px" src='images/slider4.jpg' class="img-responsive" alt=""/></div> id="Linegraph"  -->
					 <div class="col-md-14"><!--  <?php //echo $esc_vis ?> -->
						<div class="activity_box">
							<a href="index.php?pagina=solicitacao-tecnico" ><h2>LISTA DE ATENDIMENTO PARA DAR O PARECER TÉCNICO</h2></a>
							<div class="scrollbar" id="style-1">

								<?php 
									$query = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Executando' && tecnico = $id_usuario limit 6");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										
										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){}
											$id_soli = $res[$i]['id'];
											$id_solicant = $res[$i]['solicitante'];
											$tipo_chamad = $res[$i]['tipo_chamado'];
											$descricao_chamad = $res[$i]['descricao'];
											$atendimento_chamad = $res[$i]['atendimento'];
											$data_chamad = $res[$i]['data_solicitacao'];

											$data_solicitacaoN = date('d/m/Y', strtotime($data_chamad));


											//Recuperar nome do solicitante da chamada
											$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_solicant'");
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

											//$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

								?>
								<div class="activity-row">

									<?php if ($id_soli != 0) {?>

									<div class="col-xs-3 activity-desc" title="<?php echo $nome_solicitante ?>"><?php echo $nome_setor ?></div>

									<div class="col-xs-4 activity-desc">
										<p title="<?php echo $descricao_chamad ?>"><?php echo $tipo_chamad ?></p>
									</div>
									<div class="col-xs-3 activity-desc">
										<p><h6><?php echo $data_solicitacaoN ?></h6></p>
									</div>

									<div class="col-xs-2 activity-desc"><h6><?php echo $atendimento_chamad ?></h6></div>


								<?php } ?>
									
									
									<div class="clearfix"> </div>
								</div>
								<?php } }else{ ?>
									<div class="row-one"><h1><b>SEM ATENDIMENTO PARA DAR PARECER TÉCNICO!</b></h1></div>
									<br><b>Clique <a href="index.php?pagina=solicitacao-tecnico">AQUI</a> para ser direcionado a página de parecer.</b>
								<?php }?>

							</div>

						</div>
					</div>

				<!-- FINAL DO MUDOU TIPO DE NIVEL DE USUARIO -->


				<!-- MUDOU TIPO DE NIVEL DE USUARIO -->
					<?php } else if(@$_SESSION['nivel_usuario'] == "Administrador"){
					?>
					<!--  <div><img style="width: 100%; height: 370px" src='images/slider4.jpg' class="img-responsive" alt=""/></div> id="Linegraph"  -->
					 <div class="col-md-14"><!--  <?php //echo $esc_vis ?> -->
						<div class="activity_box">
							<a href="index.php?pagina=solicitacao-gerencia"><h2>LISTA DE CHAMADOS EM EXECUÇÃO E/OU ABERTO <small>(Gerenciar)</small></h2></a>
							<div class="scrollbar" id="style-1">

								<?php 
									$query = $pdo->query("SELECT * FROM solicitacao where atendimento != 'Finalizado' limit 6");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										
										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){}
											$id_soli = $res[$i]['id'];
											$id_solicant = $res[$i]['solicitante'];
											$tipo_chamad = $res[$i]['tipo_chamado'];
											$descricao_chamad = $res[$i]['descricao'];
											$atendimento_chamad = $res[$i]['atendimento'];
											$data_chamad = $res[$i]['data_solicitacao'];
											$tecnico = $res[$i]['tecnico'];//pega o tecnico escalado --> 

											$data_solicitacaoN = date('d/m/Y', strtotime($data_chamad));


											//Recuperar nome do solicitante da chamada
											$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_solicant'");
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

											//Recuperar Técnico escalado
											$query2 = $pdo->query("SELECT id, SUBSTRING_INDEX(nome, ' ', 1) as nome FROM usuarios where id = '$tecnico'");
											$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
											if(@count($res2) > 0){			
												$nome_tecnico = $res2[0]['nome'];
											}else{
												$nome_tecnico = 'Falta escalar';
											}

											$query2 = $pdo->query("SELECT * FROM setor where id = '$id_setor'");
											$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
											if(@count($res2) > 0){			
												$nome_setor = $res2[0]['nome'];
											}else{
												$nome_setor = 'Sem setor';
											}

											//$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

								?>
								<div class="activity-row">

									<?php if ($id_soli != 0) {?>

									<div class="col-xs-3 activity-desc" title="<?php echo $nome_solicitante ?>"><?php echo $nome_setor ?></div>

									<div class="col-xs-4 activity-desc">
										<p title="<?php echo $descricao_chamad ?>"><?php echo $tipo_chamad ?></p>
									</div>
									<div class="col-xs-3 activity-desc">
										<p><h6><?php echo $data_solicitacaoN ?></h6></p>
									</div>

									<div class="col-xs-2 activity-desc"><h6><?php echo $atendimento_chamad ?></h6></div>

									<div class="col-xs-2 activity-desc"><h6><b><?php echo $nome_tecnico ?></b></h6></div>


								<?php } ?>
									
									
									<div class="clearfix"> </div>
								</div>
								<?php } }else{ ?>
									<div class="row-one"><h1><b>TODOS OS ATENDIMENTO FINALIZADOS!</b></h1></div>
									<br><b>Equipe de atendimento de parabéns.</b>
								<?php }?>

							</div>

						</div>
					</div>


				<?php }?><!-- FINAL DO MUDOU TIPO DE NIVEL DE USUARIO -->




				</div>
			</div>







			<div class="col-md-4 stat">

				<a href="#"> <!-- index.php?pagina=agenda -->
					<div class="content-top-1">
						<div class="col-md-6 top-content">
							<h5>Atendimentos</h5>
							<label><?php echo $totalChamadasFinalizadas ?> de <?php echo $totalChamadas ?></label>
						</div>
						<div class="col-md-6 top-content1">	   
							<div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $porcentagemChamadasFinalizadas ?>"> <span class="pie-value"></span> </div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</a>


				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Repartição</h5>
					<label><?php echo $reparticao_maiorNr_chamado ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $porcentagemSetorMaiorNrChamada ?>"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
				<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Abertos | Atuando</h5>
					<label>&nbsp;&nbsp;&nbsp;<?php echo $totalChamadosAbertoHoje ?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?php echo $totalChamadosExecutandoHoje ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $porcentagemChamadosAberto?>"> <span class="pie-value"></span> </div>
				</div>
				 <div class="clearfix"> </div>
				</div>
			</div>
			
			<div class="clearfix"> </div>
		</div>
				
			
	
	<!-- for amcharts js -->
			<script src="js/amcharts.js"></script>
			<script src="js/serial.js"></script>
			<script src="js/export.min.js"></script>
			<link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
			<script src="js/light.js"></script>
	<!-- for amcharts js -->

    <script  src="js/index1.js"></script>
	<!--
		<div class="charts">		
			<div class="mid-content-top charts-grids">
				<div class="middle-content">
						<h4 class="title">Carousel Slider</h4> -->
					<!-- start content_slider -->
	<!--				<div id="owl-demo" class="owl-carousel text-center">
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider1.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider2.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider3.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider4.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider5.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider6.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/slider7.jpg" alt="name">
						</div>
						
					</div>
				</div> -->
					<!--//sreen-gallery-cursual---->
			</div>
		</div>

				
			</div>

</body>
</html>