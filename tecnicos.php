<?php 

include_once("sistema/conexao.php");
include_once("cabecalho.php");

 ?>


<!-- Agent Section Begin -->
<section class="agent-section spad">
    <div class="container">
<!--        <div class="row">
            <div class="col-lg-6">
                <div class="agent-search-form">
                    <form action="corretores.php">
                        <input type="text" name="nome" placeholder="Buscar Técnicos">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>-->
        <div class="as-slider owl-carousel">
            <div class="row">

                <!-- Início do Card Corretores -->

                <?php

                        if(@$_GET['nome'] != null){
                            @$busca = @$_GET['nome'];
                        }
                       
                        
          $res = $pdo->query("SELECT * FROM usuarios where (nivel = 'Técnico') and ativo = 'Sim' and nome LIKE '%".@$busca."%' order by id asc");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);

          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id_func'];


             $res_2 = $pdo->query("SELECT * FROM funcionarios where id = '$id'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
            if(@count($dados_2)> 0) {

                        $nome = $dados_2[0]['nome'];                       
                        $telefone = $dados_2[0]['telefone'];
                        $email = $dados_2[0]['email'];                        
                        $imagem = $dados_2[0]['foto'];
               
           }else{
            $nome = $dados[$i]['nome'];                     
            $telefone = $tel_sistema;
            $email = $dados[$i]['email'];                      
            $imagem = $dados[$i]['foto'];
           }        

            
                        


            ?>

              <div class="col-md-4">
                <div class="ts-item">
                    <div class="ts-text">
                        <img src="sistema/painel/images/perfil/<?php echo $imagem ?>" alt="">
                        <h5><?php echo $nome ?></h5>
                        <span><i class="fa fa-whatsapp mr-1"></i><?php echo $telefone ?></span>
                      
                        <div class="ts-social">
                           <!--
                            <a target="_blank" title="<?php echo $email ?>" href="#"><i class="fa fa-envelope-o"></i></a>
                            <a target="_blank" title="<?php echo $telefone ?>" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone ?>"><i class="fa fa-whatsapp"></i></a>-->
                        </div>
                    </div>
                </div>
            </div>


            <?php  }
               ?>



            </div>
        </div>
    </div>
</section>
<!-- Agent Section End -->


<?php 
include_once("rodape.php");
 ?> 

