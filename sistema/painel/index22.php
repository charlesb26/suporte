<?php 
require_once("verificar.php");
require_once("../conexao.php");

$id_usuario = @$_SESSION['id_usuario'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome'];
	$foto_usu = $res[0]['foto'];
	$nivel_usu = $res[0]['nivel'];
	$cpf_usu = $res[0]['cpf'];
	$cpf_user = $res[0]['cpf'];
	$senha_usu = $res[0]['senha'];
	$email_usu = $res[0]['email'];
	$id_usu = $res[0]['id'];
}

if( @$_GET['pagina'] == ""){
	$pagina = 'home';
}else{
	$pagina = @$_GET['pagina'];	
}
 



$esc_ger = '';
$esc_tec = '';
$esc_usr = '';

$classe_widget = '';
//PERMISSÕES DOS USUÁRIOS
if($nivel_usu == "Técnico"){
	$esc_tec = 'ocultar'; // esc_cor -->  esc_tec
}else if($nivel_usu == "Gerente"){
	$esc_ger = 'ocultar'; // esc_tes --> esc_ger
}else if($nivel_usu == "Usuarios"){
	$esc_usr = 'ocultar'; // esc_recep --> esc_usr
}else if($nivel_usu == "Administrador"){
	$esc_admin = 'ocultar';
}

if($nivel_usu != "Administrador"){
	$esc_todos = 'ocultar';
}

$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";


?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $nome_sistema; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Sistema para atendimento HelpDesk-NTI da SETRABES" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

		<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
	<!-- //side nav css file -->

	<link rel="stylesheet" href="css/monthly.css">

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts--> 

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->

	<link rel="icon" href="../imagens/favicon (2).ico" type="image/x-icon">
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
	</style>
	<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$('#demo-pie-1').pieChart({
				barColor: '#2dde98',
				trackColor: '#eee',
				lineCap: 'round',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-2').pieChart({
				barColor: '#8e43e7',
				trackColor: '#eee',
				lineCap: 'butt',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-3').pieChart({
				barColor: '#ffc168',
				trackColor: '#eee',
				lineCap: 'square',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});


		});

	</script>
	<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

	<!-- requried-jsfiles-for owl -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel({
				items : 3,
				lazyLoad : true,
				autoPlay : true,
				pagination : true,
				nav:true,
			});
		});
	</script>
	<!-- //requried-jsfiles-for owl -->

	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<link rel="stylesheet" href="painel.css">
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left">
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1>
							<a class="navbar-brand" href="./index.php">
							<img
								src="./images/navbar.png"
								alt="login form"
								class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
							</a></h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header" align-items-center>MENU DE NAVEGAÇÃO</li>
							<li class="treeview <?php echo $esc_usr ?> <?php echo $esc_tec ?>">
								<a href="./">
									<i class="fa fa-dashboard"></i> <span>Home</span>
								</a>
							</li>
							<li class="treeview <?php echo $esc_todos ?>">
								<a href="#">
									<i class="fa fa-plus"></i>
									<span>Cadastros</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=cargos"><i class="fa fa-angle-right"></i> Cargos</a></li>	
								
									<li><a href="index.php?pagina=setor"><i class="fa fa-angle-right"></i> Departamento</a></li>
									
								</ul>
							</li>


							<li class="treeview <?php echo $esc_todos?>">
								<a href="#">
									<i class="fa fa-user"></i>
									<span>Pessoas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">								
									<li class="<?php echo $esc_ger ?> <?php echo $esc_tec ?>"><a href="index.php?pagina=funcionarios"><i class="fa fa-angle-right"></i> Funcionários</a></li>
									
									<li class="<?php echo $esc_todos ?>"><a href="index.php?pagina=usuarios"><i class="fa fa-angle-right"></i> Usuários</a></li>

								</ul>
							</li>






							<li class="treeview <?php echo $esc_ger ?> <?php echo $esc_tec ?>">
								<a href="#">
									<i class="fa fa-tty"></i>
									<span>Chamadas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=solicitacao"><i class="fa fa-angle-right"></i> Abrir</a></li>
									
								</ul>
							</li>


							<li class="treeview <?php echo $esc_usr ?> <?php echo $esc_tec ?>">
								<a href="#">
									<i class="fa fa-cogs"></i>
									<span>Gerenciamento</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=solicitacao-gerencia"><i class="fa fa-angle-right"></i> Escalonar</a></li>
									
								</ul>
							</li>

							<li class="treeview <?php echo $esc_usr ?> <?php echo $esc_ger ?>">
								<a href="#" align-items-center>
									<span>👨‍🔧 &#x200D;Técnico</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=solicitacao-tecnico"><i class="fa fa-angle-right"></i> Atender</a></li>
									<li><a href="index.php?pagina=finalizado-tecnico"><i class="fa fa-angle-right"></i> Atendidos</a></li>
								</ul>
							</li>

							<li class="treeview <?php echo $esc_todos?>">
								<a href="index.php?pagina=agenda">
									<i class="fa fa-calendar-o"></i> <span>Agenda</span>
								</a>
							</li>

							<li class="treeview <?php echo $esc_todos?>">
								<a href="#" align-items-center>
									<i class="fa fa-file"></i> <span>Relatórios</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="#" data-toggle="modal" data-target="#RelAtendimento"><i class="fa fa-angle-right"></i> Atendimentos</a></li>
									
								</ul>
							</li>
								
								
								</ul>
							</div>
							<!-- /.navbar-collapse -->
						</nav>
					</aside>
				</div>
				<!--left-fixed -navigation-->

				<!-- header-starts -->
				<div class="sticky-header header-section ">
					<div class="header-left">

						<!--toggle button start-->
						<button id="showLeftPush"><i class="fa fa-bars"></i></button>
						<!--toggle button end-->

						<div class="profile_details_left"><!--notifications of menu start -->
							<ul class="nofitications-dropdown">
								

								<?php 
								$query2 = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Executando' and tecnico = '$id_usuario' order by data_solicitacao asc");
								$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
								$chamadasPendentes_chamad = @count($res2);

								$query = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Executando' and tecnico = '$id_usuario' order by data_solicitacao asc limit 6 ");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$chamadasPendentes_chamad_limit = @count($res);
								 ?>
								<li class="dropdown head-dpdn">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue1"><?php echo $chamadasPendentes_chamad ?></span></a>
									<ul class="dropdown-menu">
										<li>
											<div class="notification_header">
												<h3>Você possui <?php echo $chamadasPendentes_chamad ?> Chamadas Pendentes!</h3>
											</div>
										</li>

										<?php 
											if($chamadasPendentes_chamad_limit > 0){
											for($i=0; $i < $chamadasPendentes_chamad_limit; $i++){
												foreach ($res[$i] as $key => $value){}
											$id_chamad = $res[$i]['id'];
											$tipo_chamad = $res[$i]['tipo_chamado'];											
											$data_solicitacao_chamad = $res[$i]['data_solicitacao'];
											
											$dataF_solicitacao_chamad = date('d/m/Y H:i:s', strtotime($data_solicitacao_chamad));
										 ?>
										<li>
											<a href="#">
											<div class="notification_desc">
												<p><i class="fa fa-calendar-o text-danger" style="margin-right: 3px"></i><?php echo $tipo_chamad ?></p>
												<p><span><?php echo $dataF_solicitacao_chamad ?></span></p>
											</div>
											<div class="clearfix"></div>	
											</a>
											<hr style="margin:2px">
										</li>
									<?php }} ?>								
									
										
										<li>
											<div class="notification_bottom">
												<a href="index.php?pagina=solicitacao-tecnico">Ver Chamados</a> <!-- agenda -->
											</div> 
										</li>
									</ul>
								</li>









								<?php 
								$query2 = $pdo->query("SELECT * FROM solicitacao where atendimento = 'Aberto' order by data_solicitacao asc");
								$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
								$chamadasAbertas_chamad = @count($res2);

								
								$Porcentagem_chamadasAbertas = 100 - $chamadasAbertas_chamad;


								 ?>




								<li class="dropdown head-dpdn">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue"><?php echo $chamadasAbertas_chamad ?></span></a>
									<ul class="dropdown-menu">
										<li>
											<div class="notification_header">
												<h3>Gerente possui <?php echo $chamadasAbertas_chamad ?> Chamadas Abertas!</h3>
											</div>
										</li>										
										<li><a href="#">
											<div class="task-info">
												<span class="task-desc">Chamados a serem escalonados</span><span class="percentage"><?php echo $chamadasAbertas_chamad ?></span>
												<div class="clearfix"></div>	
											</div>
											<div class="progress progress-striped active">
												<div class="bar red" style="width: <?php echo $Porcentagem_chamadasAbertas ?>%;"></div>
											</div>
										</a></li>



										<li>
											<div class="notification_bottom">
												<a href="#"></a>
											</div> 
										</li>
									</ul>
								</li>








								<?php 
								$query2 = $pdo->query("SELECT * FROM funcionarios where ativo = 'Não'");
								$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
								$chamadasAbertas_sem_tec = @count($res2);

								$query = $pdo->query("SELECT * FROM funcionarios where ativo = 'Não' order by nome asc limit 6 ");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$chamadasAbertas_sem_tec_limit = @count($res);
								 ?>
								<li class="dropdown head-dpdn">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue1"><?php echo $chamadasAbertas_sem_tec ?></span></a>
									<ul class="dropdown-menu">
										<li>
											<div class="notification_header">
												<h3>Você possui <?php echo $chamadasAbertas_sem_tec ?> Chamadas Pendentes!</h3>
											</div>
										</li>

										<?php 
											if($chamadasAbertas_sem_tec_limit > 0){
											for($i=0; $i < $chamadasAbertas_sem_tec_limit; $i++){
												foreach ($res[$i] as $key => $value){}
											$id_tec = $res[$i]['id'];
											$nome_tec = $res[$i]['nome'];											
											$telefone = $res[$i]['telefone'];
											
										 ?>
										<li>
											<a href="#">
											<div class="notification_desc">
												<p><i class="fa fa-calendar-o text-danger" style="margin-right: 3px"></i><?php echo $nome_tec ?></p>
												<p><center><span><?php echo $telefone ?></span></center></p>
											</div>
											<div class="clearfix"></div>	
											</a>
											<hr style="margin:2px">
										</li>
									<?php }} ?>								
									
										
										<li>
											<div class="notification_bottom">
												<a href="index.php?pagina=funcionarios">Ver Registros</a>
											</div> 
										</li>
									</ul>
								</li>




								
							</ul>

							
							<div class="clearfix"> </div>
						</div>
						<!--notification menu end -->
						<div class="clearfix"> </div>
					</div>
					<div class="header-right">




						<div class="profile_details">		
							<ul>
								<li class="dropdown profile_details_drop">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<div class="profile_img">	
											<span class="prfil-img"><img src="images/perfil/<?php echo $foto_usu ?>" alt="" width="50px" height="50px"> </span> 
											<div class="user-name">
												<p><?php echo $nome_user ?></p>
												<span><?php echo $nivel_usu ?></span>
											</div>
											<i class="fa fa-angle-down lnr"></i>
											<i class="fa fa-angle-up lnr"></i>
											<div class="clearfix"></div>	
										</div>	
									</a>
									<ul class="dropdown-menu drp-mnu">

										<li> <a href="#" data-toggle="modal" data-target="#modalPerfil"><i class="fa fa-user"></i> Perfil</a> </li> 

										<li class="<?php echo $esc_todos ?>"> <a href="#" data-toggle="modal" data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li> 

										<li> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="clearfix"> </div>				
					</div>
					<div class="clearfix"> </div>	
				</div>
				<!-- //header-ends -->




				<!-- main content start-->
				<div id="page-wrapper">
					<?php 					
						require_once($pagina.'.php');	
					?>
				</div>






			</div>

			<!-- new added graphs chart js-->

			<script src="js/Chart.bundle.js"></script>
			<script src="js/utils.js"></script>

			<script>
				var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				var color = Chart.helpers.color;
				var barChartData = {
					labels: ["January", "February", "March", "April", "May", "June", "July"],
					datasets: [{
						label: 'Dataset 1',
						backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
						borderColor: window.chartColors.red,
						borderWidth: 1,
						data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
						]
					}, {
						label: 'Dataset 2',
						backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
						borderColor: window.chartColors.blue,
						borderWidth: 1,
						data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
						]
					}]

				};

				window.onload = function() {
					var ctx = document.getElementById("canvas").getContext("2d");
					window.myBar = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							responsive: true,
							legend: {
								position: 'top',
							},
							title: {
								display: true,
								text: 'Chart.js Bar Chart'
							}
						}
					});

				};

				document.getElementById('randomizeData').addEventListener('click', function() {
					var zero = Math.random() < 0.2 ? true : false;
					barChartData.datasets.forEach(function(dataset) {
						dataset.data = dataset.data.map(function() {
							return zero ? 0.0 : randomScalingFactor();
						});

					});
					window.myBar.update();
				});

				var colorNames = Object.keys(window.chartColors);
				document.getElementById('addDataset').addEventListener('click', function() {
					var colorName = colorNames[barChartData.datasets.length % colorNames.length];;
					var dsColor = window.chartColors[colorName];
					var newDataset = {
						label: 'Dataset ' + barChartData.datasets.length,
						backgroundColor: color(dsColor).alpha(0.5).rgbString(),
						borderColor: dsColor,
						borderWidth: 1,
						data: []
					};

					for (var index = 0; index < barChartData.labels.length; ++index) {
						newDataset.data.push(randomScalingFactor());
					}

					barChartData.datasets.push(newDataset);
					window.myBar.update();
				});

				document.getElementById('addData').addEventListener('click', function() {
					if (barChartData.datasets.length > 0) {
						var month = MONTHS[barChartData.labels.length % MONTHS.length];
						barChartData.labels.push(month);

						for (var index = 0; index < barChartData.datasets.length; ++index) {
                    //window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }

                window.myBar.update();
            }
        });

				document.getElementById('removeDataset').addEventListener('click', function() {
					barChartData.datasets.splice(0, 1);
					window.myBar.update();
				});

				document.getElementById('removeData').addEventListener('click', function() {
            barChartData.labels.splice(-1, 1); // remove the label first

            barChartData.datasets.forEach(function(dataset, datasetIndex) {
            	dataset.data.pop();
            });

            window.myBar.update();
        });
    </script>
    <!-- new added graphs chart js-->

    <!-- Classie --><!-- for toggle left push menu script -->
    <script src="js/classie.js"></script>
    <script>
    	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
    	showLeftPush = document.getElementById( 'showLeftPush' ),
    	body = document.body;

    	showLeftPush.onclick = function() {
    		classie.toggle( this, 'active' );
    		classie.toggle( body, 'cbp-spmenu-push-toright' );
    		classie.toggle( menuLeft, 'cbp-spmenu-open' );
    		disableOther( 'showLeftPush' );
    	};


    	function disableOther( button ) {
    		if( button !== 'showLeftPush' ) {
    			classie.toggle( showLeftPush, 'disabled' );
    		}
    	}
    </script>
    <!-- //Classie --><!-- //for toggle left push menu script -->

    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->

    <!-- side nav js -->
    <script src='js/SidebarNav.min.js' type='text/javascript'></script>
    <script>
    	$('.sidebar-menu').SidebarNav()
    </script>
    <!-- //side nav js -->

    <!-- for index page weekly sales java script -->
    <script src="js/SimpleChart.js"></script>
    <script>
    	var graphdata1 = {
    		linecolor: "#CCA300",
    		title: "Monday",
    		values: [
    		{ X: "6:00", Y: 10.00 },
    		{ X: "7:00", Y: 20.00 },
    		{ X: "8:00", Y: 40.00 },
    		{ X: "9:00", Y: 34.00 },
    		{ X: "10:00", Y: 40.25 },
    		{ X: "11:00", Y: 28.56 },
    		{ X: "12:00", Y: 18.57 },
    		{ X: "13:00", Y: 34.00 },
    		{ X: "14:00", Y: 40.89 },
    		{ X: "15:00", Y: 12.57 },
    		{ X: "16:00", Y: 28.24 },
    		{ X: "17:00", Y: 18.00 },
    		{ X: "18:00", Y: 34.24 },
    		{ X: "19:00", Y: 40.58 },
    		{ X: "20:00", Y: 12.54 },
    		{ X: "21:00", Y: 28.00 },
    		{ X: "22:00", Y: 18.00 },
    		{ X: "23:00", Y: 34.89 },
    		{ X: "0:00", Y: 40.26 },
    		{ X: "1:00", Y: 28.89 },
    		{ X: "2:00", Y: 18.87 },
    		{ X: "3:00", Y: 34.00 },
    		{ X: "4:00", Y: 40.00 }
    		]
    	};
    	var graphdata2 = {
    		linecolor: "#00CC66",
    		title: "Tuesday",
    		values: [
    		{ X: "6:00", Y: 100.00 },
    		{ X: "7:00", Y: 120.00 },
    		{ X: "8:00", Y: 140.00 },
    		{ X: "9:00", Y: 134.00 },
    		{ X: "10:00", Y: 140.25 },
    		{ X: "11:00", Y: 128.56 },
    		{ X: "12:00", Y: 118.57 },
    		{ X: "13:00", Y: 134.00 },
    		{ X: "14:00", Y: 140.89 },
    		{ X: "15:00", Y: 112.57 },
    		{ X: "16:00", Y: 128.24 },
    		{ X: "17:00", Y: 118.00 },
    		{ X: "18:00", Y: 134.24 },
    		{ X: "19:00", Y: 140.58 },
    		{ X: "20:00", Y: 112.54 },
    		{ X: "21:00", Y: 128.00 },
    		{ X: "22:00", Y: 118.00 },
    		{ X: "23:00", Y: 134.89 },
    		{ X: "0:00", Y: 140.26 },
    		{ X: "1:00", Y: 128.89 },
    		{ X: "2:00", Y: 118.87 },
    		{ X: "3:00", Y: 134.00 },
    		{ X: "4:00", Y: 180.00 }
    		]
    	};
    	var graphdata3 = {
    		linecolor: "#FF99CC",
    		title: "Wednesday",
    		values: [
    		{ X: "6:00", Y: 230.00 },
    		{ X: "7:00", Y: 210.00 },
    		{ X: "8:00", Y: 214.00 },
    		{ X: "9:00", Y: 234.00 },
    		{ X: "10:00", Y: 247.25 },
    		{ X: "11:00", Y: 218.56 },
    		{ X: "12:00", Y: 268.57 },
    		{ X: "13:00", Y: 274.00 },
    		{ X: "14:00", Y: 280.89 },
    		{ X: "15:00", Y: 242.57 },
    		{ X: "16:00", Y: 298.24 },
    		{ X: "17:00", Y: 208.00 },
    		{ X: "18:00", Y: 214.24 },
    		{ X: "19:00", Y: 214.58 },
    		{ X: "20:00", Y: 211.54 },
    		{ X: "21:00", Y: 248.00 },
    		{ X: "22:00", Y: 258.00 },
    		{ X: "23:00", Y: 234.89 },
    		{ X: "0:00", Y: 210.26 },
    		{ X: "1:00", Y: 248.89 },
    		{ X: "2:00", Y: 238.87 },
    		{ X: "3:00", Y: 264.00 },
    		{ X: "4:00", Y: 270.00 }
    		]
    	};
    	var graphdata4 = {
    		linecolor: "Random",
    		title: "Thursday",
    		values: [
    		{ X: "6:00", Y: 300.00 },
    		{ X: "7:00", Y: 410.98 },
    		{ X: "8:00", Y: 310.00 },
    		{ X: "9:00", Y: 314.00 },
    		{ X: "10:00", Y: 310.25 },
    		{ X: "11:00", Y: 318.56 },
    		{ X: "12:00", Y: 318.57 },
    		{ X: "13:00", Y: 314.00 },
    		{ X: "14:00", Y: 310.89 },
    		{ X: "15:00", Y: 512.57 },
    		{ X: "16:00", Y: 318.24 },
    		{ X: "17:00", Y: 318.00 },
    		{ X: "18:00", Y: 314.24 },
    		{ X: "19:00", Y: 310.58 },
    		{ X: "20:00", Y: 312.54 },
    		{ X: "21:00", Y: 318.00 },
    		{ X: "22:00", Y: 318.00 },
    		{ X: "23:00", Y: 314.89 },
    		{ X: "0:00", Y: 310.26 },
    		{ X: "1:00", Y: 318.89 },
    		{ X: "2:00", Y: 518.87 },
    		{ X: "3:00", Y: 314.00 },
    		{ X: "4:00", Y: 310.00 }
    		]
    	};
    	var Piedata = {
    		linecolor: "Random",
    		title: "Profit",
    		values: [
    		{ X: "Monday", Y: 50.00 },
    		{ X: "Tuesday", Y: 110.98 },
    		{ X: "Wednesday", Y: 70.00 },
    		{ X: "Thursday", Y: 204.00 },
    		{ X: "Friday", Y: 80.25 },
    		{ X: "Saturday", Y: 38.56 },
    		{ X: "Sunday", Y: 98.57 }
    		]
    	};
    	$(function () {
    		$("#Bargraph").SimpleChart({
    			ChartType: "Bar",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata4, graphdata3, graphdata2, graphdata1],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});
    		$("#sltchartype").on('change', function () {
    			$("#Bargraph").SimpleChart('ChartType', $(this).val());
    			$("#Bargraph").SimpleChart('reload', 'true');
    		});
    		$("#Hybridgraph").SimpleChart({
    			ChartType: "Hybrid",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata4],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});
    		$("#Linegraph").SimpleChart({
    			ChartType: "Line",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: false,
    			data: [graphdata4, graphdata3, graphdata2, graphdata1],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});
    		$("#Areagraph").SimpleChart({
    			ChartType: "Area",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata4, graphdata3, graphdata2, graphdata1],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});
    		$("#Scatterredgraph").SimpleChart({
    			ChartType: "Scattered",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata4, graphdata3, graphdata2, graphdata1],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});
    		$("#Piegraph").SimpleChart({
    			ChartType: "Pie",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			showpielables: true,
    			data: [Piedata],
    			legendsize: "250",
    			legendposition: 'right',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});

    		$("#Stackedbargraph").SimpleChart({
    			ChartType: "Stacked",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata3, graphdata2, graphdata1],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});

    		$("#StackedHybridbargraph").SimpleChart({
    			ChartType: "StackedHybrid",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata3, graphdata2, graphdata1],
    			legendsize: "140",
    			legendposition: 'bottom',
    			xaxislabel: 'Hours',
    			title: 'Weekly Profit',
    			yaxislabel: 'Profit in $'
    		});
    	});

    </script>
    <!-- //for index page weekly sales java script -->


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
    <!-- //Bootstrap Core JavaScript -->

    <!-- Mascaras JS -->
    <script type="text/javascript" src="js/mascaras.js"></script>
    <!-- Ajax para funcionar Mascaras JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

</body>
</html>




<!-- Modal -->
<div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar Dados</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-usu">
			<div class="modal-body">

				<div class="row">
					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Nome</label> 
							<input type="text" class="form-control" name="nome_usu" value="<?php echo $nome_user ?>" required> 
						</div>						
					</div>
					<div class="col-md-6">
						<div class="form-group"> 
							<label>CPF</label> 
							<input type="text" class="form-control" id="cpf_usu" name="cpf_usu" value="<?php echo $cpf_user ?>" required> 
						</div>
					</div>

				</div>


				<div class="row">
					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Email</label> 
							<input type="email" class="form-control" name="email_usu" value="<?php echo $email_usu ?>" required> 
						</div>						
					</div>
					<div class="col-md-6">
						<div class="form-group"> 
							<label>Senha</label> 
							<input type="password" class="form-control" name="senha_usu" value="<?php echo $senha_usu ?>" required> 
						</div>
					</div>

				</div>	


				<div class="row">
					<div class="col-md-8">						
						<div class="form-group"> 
							<label>Foto</label> 
							<input type="file" name="foto" onChange="carregarImg2();" id="foto-usu">
						</div>						
					</div>
					<div class="col-md-4">
						<div id="divImg">
							<img src="images/perfil/<?php echo $foto_usu ?>"  width="100px" id="target-usu">									
						</div>
					</div>

				</div>

				<input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">
				<input type="hidden" name="foto_usu" value="<?php echo $foto_usu ?>">

				<small><div id="msg-usu" align="center" class="mt-3"></div></small>					

			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Editar Dados</button>
			</div>
			</form>

		</div>
	</div>
</div>








<!-- Modal -->
<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Configurações do Sistema Imobiliário</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-config">
			<div class="modal-body">

				<div class="row">
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Nome</label> 
							<input type="text" class="form-control" name="nome_config" value="<?php echo $nome_sistema ?>" required> 
						</div>						
					</div>
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Telefone</label> 
							<input type="text" class="form-control" name="tel_config" id="tel_config" value="<?php echo $tel_sistema ?>" > 
						</div>						
					</div>
					
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Email</label> 
							<input type="email" class="form-control" name="email_config" value="<?php echo $email_adm ?>" required> 
						</div>						
					</div>

				</div>


				<div class="row">

					<div class="col-md-9">
						<div class="form-group"> 
							<label>Endereço</label> 
							<input type="text" class="form-control" name="end_config" value="<?php echo $end_sistema ?>" > 
						</div>
					</div>
					
				

					<div class="col-md-3">						
						<div class="form-group"> 
							<label>Relatório PDF / HTML</label> 
							<select class="form-control" name="rel"  required> 
								<option <?php if($relatorio_pdf == 'pdf'){ ?>selected <?php } ?> value="pdf">PDF</option>
								<option <?php if($relatorio_pdf == 'html'){ ?>selected <?php } ?> value="html">HTML</option>
							</select>
						</div>						
					</div>

				</div>	


				<div class="row">
					<div class="col-md-2">						
						<div class="form-group"> 
							<label>Logo</label> 
							<input type="file" name="logo" onChange="carregarImgLogo();" id="foto-logo">
						</div>						
					</div>
					<div class="col-md-4">
						<div id="divImgLogo">
							<img src="../imagens/<?php echo $logo ?>"  width="100px" id="target-logo">									
						</div>
					</div>



					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Favicon (ico)</label> 
							<input type="file" name="favicon" onChange="carregarImgFavicon();" id="foto-favicon">
						</div>						
					</div>
					<div class="col-md-2">
						<div id="divImgFavicon">
							<img src="../imagens/<?php echo $favicon ?>"  width="20px" id="target-favicon">									
						</div>
					</div>



					

				</div>


				<div class="row">

					<div class="col-md-3">						
						<div class="form-group"> 
							<label>Img Relatório (*jpg) 200x60</label> 
							<input type="file" name="imgRel" onChange="carregarImgRel();" id="foto-rel">
						</div>						
					</div>
					<div class="col-md-3">
						<div id="divImgRel">
							<img src="../imagens/<?php echo $logo_rel ?>"  width="100px" id="target-rel">									
						</div>
					</div>

				</div>

				
				<small><div id="msg-config" align="center" class="mt-3"></div></small>					

			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Editar Dados</button>
			</div>
			</form>

		</div>
	</div>
</div>


<!-- Modal Rel Atendimento -->
<div class="modal fade" id="RelAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório de Atendimento
					<small>(
										<a href="#" onclick="datas('1971-01-01', 'tudo-Bene', 'Bene')">
											<span style="color:#000" id="tudo-Bene">Tudo</span>
										</a> / 
									<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Bene', 'Bene')">
											<span id="hoje-Bene">Hoje</span>
										</a> /
										<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Bene', 'Bene')">
											<span style="color:#000" id="mes-Bene">Mês</span>
										</a> /
										<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Bene', 'Bene')">
											<span style="color:#000" id="ano-Bene">Ano</span>
										</a> 
									)</small>



				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="rel/bene_class.php" target="_blank">
			<div class="modal-body">

				<div class="row">
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Chamado <small>(Inicial)</small></label> 
							<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Bene" value="<?php echo date('Y-m-d') ?>" required> 
						</div>						
					</div>
					<div class="col-md-4">
						<div class="form-group"> 
							<label>Chamado <small>(Final)</small></label> 
							<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Bene" value="<?php echo date('Y-m-d') ?>" required> 
						</div>
					</div>
					

				</div>


				<div class="row">
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Tipo Chamado</label> 
							<select class="form-control" name="ativo">
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
					
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Repartição</label> 
							<select class="form-control sel3index" name="municipio" id="municipio" style="width:100%;">
								<option value="">Selecionar tudo</option>

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


					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Repartição</label> 
							<select class="form-control sel3index" name="municipio" id="municipio" style="width:100%;">
								<option value="">Selecionar tudo</option>

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
				

			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Gerar Relatório</button>
			</div>
			</form>

		</div>
	</div>
</div>



<script type="text/javascript">
	function carregarImg2() {
		var target = document.getElementById('target-usu');
		var file = document.querySelector("#foto-usu").files[0];

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



<script type="text/javascript">
	$("#form-usu").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-dados.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-usu').text('');
				$('#msg-usu').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {					
					location.reload();
				} else {

					$('#msg-usu').addClass('text-danger')
					$('#msg-usu').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>



<style type="text/css">
	.select2-selection__rendered {
		line-height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;

	}

	.select2-selection {
		height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;

	}
</style>  




<script type="text/javascript">
	function carregarImgLogo() {
		var target = document.getElementById('target-logo');
		var file = document.querySelector("#foto-logo").files[0];

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




<script type="text/javascript">
	function carregarImgFavicon() {
		var target = document.getElementById('target-favicon');
		var file = document.querySelector("#foto-favicon").files[0];

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



<script type="text/javascript">
	function carregarImgRel() {
		var target = document.getElementById('target-rel');
		var file = document.querySelector("#foto-rel").files[0];

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





<script type="text/javascript">
	$("#form-config").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-config.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-config').text('');
				$('#msg-config').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {					
					location.reload();
				} else {

					$('#msg-config').addClass('text-danger')
					$('#msg-config').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>

<script type="text/javascript">
	function datas(data, id, campo){
		var data_atual = "<?=$data_atual?>";
		$('#dataInicialRel-'+campo).val(data);
		$('#dataFinalRel-'+campo).val(data_atual);

		document.getElementById('hoje-'+campo).style.color = "#000";
		document.getElementById('mes-'+campo).style.color = "#000";
		document.getElementById(id).style.color = "blue";	
		document.getElementById('tudo-'+campo).style.color = "#000";
		document.getElementById('ano-'+campo).style.color = "#000";
		document.getElementById(id).style.color = "blue";		
	}
</script>