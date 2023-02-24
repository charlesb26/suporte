<?php 
require_once("../../conexao.php");

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$tecnico = $_GET['tecnico'];
$tipo_chamado = $_GET['tipo_chamado'];
$reparticao = $_GET['reparticao'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if($dataInicial == $dataFinal){
	$texto_apuracao = 'APURADO EM '.$dataInicialF;
}else if($dataInicial == '1971-01-01'){
	$texto_apuracao = 'APURADO EM TODO O PERÍODO';
}else{
	$texto_apuracao = 'APURAÇÃO DE '.$dataInicialF. ' ATÉ '.$dataFinalF;
}


//tec
if($tecnico == ''){
	$tecnico_rel = '';
}else{

	$query_con = $pdo->query("SELECT SUBSTRING_INDEX(nome, ' ', 1) as nome FROM usuarios where id = '$tecnico'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_tecnico = $res_con[0]['nome'];
					}else{
						$nome_tecnico= '';
					}


	$tecnico_rel = '- Técnico: '.$nome_tecnico;
}

//chamd
if($tipo_chamado == ''){
	$tipo_chamado_rel = '';
}else{
	$tipo_chamado_rel = ' - Serviço: '.$tipo_chamado;
}

//dep
if($reparticao == ''){
	$reparticao_rel = '';
}else{

	$query_con = $pdo->query("SELECT * FROM setor where id = '$reparticao'");
					$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
					if(count($res_con) > 0){
						$nome_reparticao = $res_con[0]['nome'];
					}else{
						$nome_reparticao= '';
					}


	$reparticao_rel = '- Repartição: '.$nome_reparticao;
}


$tecnico = '%'.$tecnico.'%';
$tipo_chamado = '%'.$tipo_chamado.'%';
$reparticao = '%'.$reparticao.'%';


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Boa_Vista');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


 ?>



 <!DOCTYPE html>
<html>
<head>
	<title>GOVERNO DE RORAIMA</title>

	<?php 
		if($relatorio_pdf != 'pdf'){
	 ?>
	<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 0px;

		}

		body{
			margin-top:0px;
			font-family:Times, "Times New Roman", Georgia, serif;
		}


		<?php if($relatorio_pdf == 'pdf'){ ?>

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		<?php }else{ ?>
			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;

			}

		<?php } ?>

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;
		}

		.titulo_cab{
			color:#0340a3;
			font-size:17px;
		}

		
		
		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;
		}



		hr{
			margin:8px;
			padding:0px;
		}


		
		.area-cab{
			
			display:block;
			width:100%;
			height:40px;

		}

		
		.coluna{
			margin: 0px;
			float:left;
			height:40px;
		}

		.area-tab{
			margin: 5px;
			display:block;
			width:100%;
			height:20px;

		}


		.imagem {
			width: 200px;
			position:absolute;
			right:20px;
			top:10px;
		}

		.titulo_img {
		position: absolute;
		margin-top: 10px;
		margin-left: 10px;
		
		}

		.data_img {
		position: absolute;
		margin-top: 40px;
		margin-left: 10px;
		border-bottom:1px solid #000;
		font-size: 10px;
		}

		.endereco {
		position: absolute;
		margin-top: 50px;
		margin-left: 10px;
		border-bottom:1px solid #000;
		font-size: 10px;
		}
		

	</style>


</head>
<body>	

		
		<div class="titulo_cab titulo_img"><u>GOVERNO DE RORAIMA</u></div>
		<br>
		<div class="titulo_cab titulo_img"><u>Relatório de Serviço Técnico de Informática <?php echo $reparticao_rel ?></u></div>

		
		
		<?php 
			if($logo_rel != ''){
		 ?>
		<img class="imagem" src="<?php echo $url_sistema ?>sistema/imagens/<?php echo $logo_rel ?>" width="200px" height="60">

		<?php } ?>
	

	<br><br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>
	<div class="data_img"><?php echo mb_strtoupper($data_hoje) ?> </div>
	<div class="mx-2" style="padding-top:10px ">

	<section class="area-cab">
		<div class="coluna" style="width:50%">
			<small><small><small><u><?php echo $texto_apuracao ?></u> <?php echo $tecnico_rel ?> <?php echo $tipo_chamado_rel ?></small></small></small>
		</div>
	</section>

		
	
	<?php 

		$query = $pdo->query("SELECT sr.id, sr.nome as reparticao,  sl.data_solicitacao, sl.tipo_chamado, SUBSTRING_INDEX(tec.nome, ' ', 1) as tecnico, sl.descricao as descricao
			FROM solicitacao sl 
			inner JOIN usuarios usr 
			on sl.solicitante = usr.id 
			INNER JOIN funcionarios fn 
			ON usr.id_func = fn.id 
			INNER JOIN setor sr 
			ON fn.setor = sr.id
			inner JOIN usuarios tec 
			on sl.tecnico = tec.id
			where tecnico LIKE '$tecnico' and sl.tipo_chamado LIKE '$tipo_chamado' and sr.id LIKE '$reparticao' and sl.data_solicitacao >= '$dataInicial' and sl.data_solicitacao <= '$dataFinal'");
	
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = count($res);
	if($total_reg > 0){
		?>

		

	<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 4px;">
						<div class="coluna" style="width:20%">REPARTIÇÃO</div>
						<div class="coluna" style="width:15%">DT_CHAMADO</div>
						<div class="coluna" style="width:12%">TIPO</div>
						<div class="coluna" style="width:40%">DESCRIÇÃO ATENDIMENTO</div>
						<div class="coluna" style="width:10%">TÉCNICO</div>
					</div>
					
				</section><small></small>
<br>
				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

				<?php
				 for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){}
					$reparticao = $res[$i]['reparticao'];
					$data_solicitacao = $res[$i]['data_solicitacao'];
					$tipo_chamado = $res[$i]['tipo_chamado'];
					$descricao = $res[$i]['descricao'];
					$tecnico = $res[$i]['tecnico'];

					$data_solicitacaoN = date('d/m/Y H:i:s', strtotime($data_solicitacao));
								
					
				?>


				<section class="area-tab" style="padding-top:4px">					
					<div class="linha-cab <?php echo $classe_item ?> <?php echo $inativa ?>">				
						<div class="coluna" style="width:20%"><?php echo $reparticao ?></div>

						<div class="coluna" style="width:15%"><?php echo $data_solicitacaoN ?></div>

						<div class="coluna" style="width:12%"><?php echo $tipo_chamado ?></div>

						<div class="coluna" style="width:40%"><?php echo $descricao ?></div>

						<div class="coluna" style="width:10%"><?php echo $tecnico ?></div>

					</div>
				</section>

<br>


				<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
				</div>

			<?php } ?>

			</small>



		</div>


		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
		</div>


	<?php }else{
		echo '<div style="margin:8px"><small><small>Sem Registros no banco de dados!</small></small></div>';
	} ?>



	<div class="col-md-12 p-2">
			<div class="" align="right">
				<span class=""> <small><small><small><small>TOTAL DE REGISTROS</small> :  <?php echo $total_reg ?></small></small></small>  </span>
			</div>
		</div>
		<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
		</div>




	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $end_sistema ?> Tel: <?php echo $tel_sistema ?></span> 
	</div>



</body>
</html>