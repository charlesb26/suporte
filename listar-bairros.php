<?php 

include_once("sistema/conexao.php");

$cidade = $_POST['txtcidade'];

echo "<select class='sm-width form-control' name='bairro' id='bairro'>";
echo "<option value=''>Selecione um Bairro</option>";

$res = $pdo->query("SELECT * FROM bairros where cidade = '$cidade' order by nome asc");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

           echo "<option value='" . $dados[$i]['id'] . "'>" . $dados[$i]['nome'] . "</option>";

       }

       echo "</select>";

 ?>



  

    


