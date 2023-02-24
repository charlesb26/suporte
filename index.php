<?php
require_once("cabecalho.php");
?>


<style type="text/css">
    img {
        border-radius: 50px;
    }

        .top50 {
            margin-top: -80px;
        }

    .result{
        text-align: center;
        align-items: baseline;
    }
</style>

<!-- Inicio da tabela atendimento -->
<section class="search-section spad">
    <div class="container">

        <?php



        //9 Tipos de chamada -tc
        $chamado1 = ' ';
        $chamado2 = ' ';
        $chamado3 = ' ';
        $chamado4 = ' ';
        $chamado5 = ' ';
        $chamado6 = ' ';
        $chamado7 = ' ';
        $chamado8 = ' ';
        $chamado9 = ' ';

        $qtd1 = 0;
        $qtd2 = 0;
        $qtd3 = 0;
        $qtd4 = 0;
        $qtd5 = 0;
        $qtd6 = 0;
        $qtd7 = 0;
        $qtd8 = 0;
        $qtd9 = 0;

        $tipo_chamados = [$chamado1, $chamado2, $chamado3, $chamado4, $chamado5, $chamado6, $chamado7, $chamado8, $chamado9];
        $qtds = [$qtd1, $qtd2, $qtd3, $qtd4, $qtd5, $qtd6, $qtd7, $qtd8, $qtd9];

        $query = $pdo->query("SELECT tipo_chamado, count(*) as qtd FROM solicitacao GROUP BY tipo_chamado order by qtd desc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $tipo_chamados[$i] = $res[$i]['tipo_chamado'];
            $qtds[$i] = $res[$i]['qtd'];
        }
        //tc
        
        //T
//3 Melhores tecnicos
        $tecnico1 = ' ';
        $tecnico2 = ' ';
        $tecnico3 = ' ';

        $qtdt1 = 0;
        $qtdt2 = 0;
        $qtdt3 = 0;

        $nome_tecnicos = [$tecnico1, $tecnico2, $tecnico3];
        $fotos = ['', '', ''];
        $qtdts = [$qtdt1, $qtdt2, $qtdt3];

        $query = $pdo->query("SELECT SUBSTRING_INDEX(usr.nome, ' ', 1) as tecnico, foto, count(*) as qtd FROM `solicitacao` sol INNER JOIN usuarios usr on sol.tecnico = usr.id group by usr.nome order by qtd desc limit 3");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $nome_tecnicos[$i] = $res[$i]['tecnico'];
            $fotos[$i] = $res[$i]['foto'];
            $qtdts[$i] = $res[$i]['qtd'];
        }
        //T
        

        //9 Tipos de chamada -setr
        $setor1 = ' ';
        $setor2 = ' ';
        $setor3 = ' ';
        $setor4 = ' ';
        $setor5 = ' ';
        $setor6 = ' ';
        $setor7 = ' ';
        $setor8 = ' ';
        $setor9 = ' ';
        $setor10 = ' ';
        $setor11 = ' ';
        $setor12 = ' ';

        $qtdr1 = 0;
        $qtdr2 = 0;
        $qtdr3 = 0;
        $qtdr4 = 0;
        $qtdr5 = 0;
        $qtdr6 = 0;
        $qtdr7 = 0;
        $qtdr8 = 0;
        $qtdr9 = 0;
        $qtdr10 = 0;
        $qtdr11 = 0;
        $qtdr12 = 0;

        $setor_chamados = [$setor1, $setor2, $setor3, $setor4, $setor5, $setor6, $setor7, $setor8, $setor9, $setor10, $setor11, $setor12];
        $qtdrs = [$qtdr1, $qtdr2, $qtdr3, $qtdr4, $qtdr5, $qtdr6, $qtdr7, $qtdr8, $qtdr9, $qtdr10, $qtdr11, $qtdr12];

        $query = $pdo->query("SELECT st.nome as setor, count(*) as qtd FROM solicitacao sl inner JOIN usuarios usr on sl.solicitante = usr.id inner JOIN funcionarios fn on usr.id_func = fn.id inner JOIN setor st on fn.setor = st.id GROUP by st.nome order by qtd desc limit 12");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
            foreach ($res[$i] as $key => $value) {
            }
            $setor_chamados[$i] = $res[$i]['setor'];
            $qtdrs[$i] = $res[$i]['qtd'];
        }
        //setr
        

        $query = $pdo->query("SELECT * FROM solicitacao where atendimento != 'Finalizado' ORDER BY id desc limit 15");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);



        if ($total_reg > 0) {
            ?>

            <!--LINK CSS DOS CARDS-->
            <link rel="stylesheet" type="text/css" href="style.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet"
                crossorigin="anonymous">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet"
                crossorigin="anonymous">



            <table class="table table-sm table-dark top50">
                <thead class="t1-c" style="bg-dark;">
                    <tr>
                        <th scope="col">&#x27A1;</th>
                        <th scope="col">SETOR</th>
                        <th scope="col">PROBLEMA</th>
                        <th scope="col">DESCRIÇÃO</th>
                        <th class="esc" scope="col">DATA</th>
                        <th scope="col">ATENDIMENTO</th>
                        <th scope="col">TÉCNICO</th>
                    </tr>
                </thead>

                <tbody class="tabchamado">

                    <?php
                    for ($i = 0; $i < $total_reg; $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                        $id = $res[$i]['id'];
                        $solicitante = $res[$i]['solicitante'];
                        $data_solicitacao = $res[$i]['data_solicitacao'];
                        $tipo_chamado = $res[$i]['tipo_chamado'];
                        $descricao = $res[$i]['descricao'];
                        $atendimento = $res[$i]['atendimento'];
                        $tecnico = $res[$i]['tecnico'];
                        $obstecnico = $res[$i]['obstecnico'];
                        $data_tec = $res[$i]['data_tec'];


                        if ($atendimento == 'Aberto') {
                            $classe_linha = 'bg-danger';
                        } else if ($atendimento == 'Executando') {
                            $classe_linha = 'bg-success'; //
                        } else if ($atendimento == 'Agendado') {
                            $classe_linha = 'bg-success';
                        }

                        //retirar aspas do texto
                        $descricao = str_replace('"', "**", $descricao);

                        $data_tecF = date('d/m/Y H:i:s', strtotime($data_tec));
                        $data_solicitacaoF = date('d/m/Y H:i:s', strtotime($data_solicitacao));

                        $query2 = $pdo->query("SELECT * FROM usuarios where id = '$solicitante'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $nome_solicitante = $res2[0]['nome'];
                            $id_func = $res2[0]['id_func'];
                        } else {
                            $nome_solicitante = 'Sem Registro';
                        }


                        $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $id_setor = $res2[0]['setor'];
                        } else {
                            $id_setor = 0;
                        }

                        $query2 = $pdo->query("SELECT * FROM setor where id = '$id_setor'");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        if (@count($res2) > 0) {
                            $nome_setor = $res2[0]['nome'];
                        } else {
                            $nome_setor = 'Sem setor';
                        }



                        ?>

                        <div class="result">

                            <tr class="<?php echo $classe_linha ?>">
                                <th scope="row">&#x27A1;</th>

                                <td>
                                    <font size="4"><b>
                                            <?php echo $nome_setor ?>
                                        </b></font>
                                </td>

                                <td>
                                    <font size="3">
                                        <?php echo $tipo_chamado ?>
                                    </font>
                                </td>

                                <td>
                                    <font size="3">
                                        <?php echo $descricao ?>
                                    </font>
                                </td>

                                <td class="esc" >
                                    <font size="3">
                                        <?php echo $data_solicitacaoF ?>
                                    </font>
                                </td>

                                <td align="center">
                                    <font size="3">
                                        <?php echo $atendimento ?>
                                    </font>
                                </td>

                                <td align="center">
                                    <font size="3">
                                        <?php 
                                        if($tecnico == 2){
                                            echo 'Charles';
                                        }elseif ($tecnico == 3) {
                                                echo 'Marcos';
                                        }elseif ($tecnico == 7) {
                                                echo 'Edilberto';
                                        }elseif ($tecnico == 16) {
                                            echo 'Ruy';
                                        }elseif ($tecnico == 128) {
                                                echo 'Marcio';
                                        }elseif($tecnico == 0){
                                                echo '';
                                        }

                                     
                                        
                                        
                                        
                                        
                                        
                                        ?>
                                    </font>
                                </td>
                            </tr>

                        </div>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <h3>TODOS OS CHAMADOS ATENDIDOS! &#x1F60E;</h3>

            <?php
        } ?>
    </div>


    <br>
    <br>

    <div class="container" align="center">
        <style color="green"></style>
        <h3><strong>TÉCNICOS RANKING</strong></h3>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row" align="center">
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class='bx bx-wrench'></i> </div> &nbsp;&nbsp;&nbsp;
                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $nome_tecnicos[0] ?>
                                    </strong> </h5>
                            </div>
                        </div>
                        <div class="badge"> <span>Técnico 1</span> </div>
                    </div>
                    <div class="mt-5">
                        <img src="sistema/painel/images/perfil/<?php echo $fotos[0] ?>" width="200px">
                        <div class="mt-5">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdts[0] ?> Atendimentos <span class="text2">de 500 </span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class='bx bx-wrench'></i> </div> &nbsp;&nbsp;&nbsp;
                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $nome_tecnicos[1] ?>
                                    </strong></h5>
                            </div>
                        </div>
                        <div class="badge"> <span>Técnico 2</span> </div>
                    </div>
                    <div class="mt-5">
                        <img src="sistema/painel/images/perfil/<?php echo $fotos[1] ?>" width="200px">
                        <div class="mt-5">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdts[1] ?> Atendimentos <span class="text2">de 500 </span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class='bx bx-wrench'></i> </div> &nbsp;&nbsp;&nbsp;
                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $nome_tecnicos[2] ?>
                                    </strong> </h5>
                            </div>
                        </div>
                        <div class="badge"> <span>Técnico 3</span> </div>
                    </div>
                    <div class="mt-5">
                        <img src="sistema/painel/images/perfil/<?php echo $fotos[2] ?>" width="150px">
                        <div class="mt-5">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdts[2] ?> Atendimentos <span class="text2">de 500 </span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <br>
    <hr>
    <br>

    <div class="container" align="center">
        <h3><strong>RANKING DE CHAMADOS</strong></h3>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div id="chamado">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row">

                                <div class="ms-2 c-details">
                                    <h5 class="mb-0"> <strong>
                                            <?php echo $tipo_chamados[0] ?>
                                        </strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAAA8BJREFUeF7tnT2vDVEUhp9baQS5USkoJIhoRCgoEAWtXyARNFoSGl8VfoBERKPV6FCJglwJpVBpJKIhPqImOxkd1t57HWtmzX2nucWsr3mevefmJCdnL6ErFYGlVNNqWCQs2SKQMAlLRiDZuNphEpaMQLJxtcMkLBmBZONqh0lYMgLJxtUOk7BkBJKN691h64H9wHZgQ7Jnjx73C/AWeA58623eK+wYcA440tt4lec9BK4BK60cWoWV+NvA6dZGiv8jgevAxRY2rcLuAidbGijWJHADuGBGDQEtws4DN2sLK66JwAngXk1GrbBNwDtgTU1RxTQT+AxsBn5YmbXCLgFXrWK67yJwBrhjVagV9gLYZxXTfReBB8Bxq0KtsE/AslVM910Eyr+crVaFWmE/rUJ6ZZqELpsR2N+xWaSw2loVc88ypGbRmwzNgAHdQprNUkP9Qy2EoYTVA/dGSpiXYHC+hAUD97aTMC/B4HwJCwbubSdhXoLB+RIWDNzbTsK8BIPzJSwYuLedhHkJBudLWDBwbzsJ8xIMzpewYODedhLmJRicL2HBwL3tJMxLMDhfwoKBe9tJmJdgcL6EBQP3tpMwL8HgfAkLBu5tJ2FegsH5EhYM3NtOwrwEg/MlLBi4t52EeQkG50tYMHBvOwnzEgzOl7Bg4N52EuYlGJwvYcHAve0kzEswOF/CgoF720mYl2BwvoQFA/e2kzAvweB8CQsG7m0nYV6CwfmTExb8/LNsZ/6qgxkwYKlZHbMkGPxQpg8zQMJClZk+zAAJk7BQAsmamRvIDNAOC1Vu+jADJEzCQgkka2ZuIDNAOyxUuenDDBjG/Q6sDR199TUrjNdZj10r7A2wwyqm+y4Cr4FdVoVaYeXnuU9ZxXTfReAWcNaqUCvsKPDIKqb7LgKHgKdWhVphpc6z4egpq6butxMoooow82oRtgV4CWw0qyqghcAHYC9Q/ppXi7BSbDfwBCgHvenyE/gIHB4Ogquq1iqsFN05nMSzp6qDgv5G4PFwDtv7FkQ9wn7XPzicFXIA2FbzGaJlsBnGfgXKx6Py/+o+8KrnGT3Cevr9r5wrgHVURjmdqcSlviQsmT4Jk7BRCOiVOAr2/qYS1s9ulEwJGwV7f1MJ62c3SqaEjYK9v6mE9bNzZ07tW8aT+ugzqWEG1RL2jzUvYfYLYVKMJjWMdliy1SNhEmYTsCMm9Raa1DDaYclWj4RJmE3AjpjUW2hSw9jsFCFhydaAhElYMgLJxtUOk7BkBJKNqx0mYckIJBtXOyyZsF9ttaRtMQTSewAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[0] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[1] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABJxJREFUeF7tnOGxTEEQhftFgAjIABEgAkRABogAESADIkAEiAARIAMioI66fuDd7TOzZ7u2956per+2b3fP+bpnZrfenbPwaKXAWatsnWwYWLMiMDADa6ZAs3TdYQbWTIFm6brDDKyZAs3Sre6wn830YdMt07Es0DJzA2NLYMXOwPYUcHm8TMeyQO6wZpVhYAamUUDjpWylKgvkDmtWGQZmYBoFNF7KVqqyQAMdVp1Thoz57liWc1kgA8vqgvvcwHKd3GGJRtVFlCEzMAPLamT98+pqPqpqJWU7qpwNLKdmYF4S8ypZs3CH5dq5w9xheZW4w+Y1coe5w+arx3tYrt1Jd9iViLgcEdci4uI5WjzJ9QnGhnAjM2HyOc/me0R8iohvEfFVlY2iwwDmcUTcXECpcjslPwD3JiJeRARATo99gAHUg4h4uNJN00md8IOA9Twins7OcRYYYL1zR83K/nupvDXTbTPAsD8B1nl71PQMNvggug3QAI8eo8DcWbS0lOFwp40CQ2fhcOGhUwCHkbusuxFgAAVgHnoFsDS+Z9yOAPvoQwYj6ZQNYAFaOlhgOGgAGDN+LBspVTGMw6Y2f76XXiDzv84cQFhg+K71jAj8NiLuzxxXCd8dTXBIexkRt4nkHy3f0XaassDQLTeSoJ+9ZK4qhNPg1US/D8yBjgXG7F846eDE4/G/Anci4nUiDKBiWZR0GPOL9SUvhata40fxLxmMiPxmIrbDGGCsLyLvMhNmXkwyzNyZWKmf1GDJVhKMmXmxDTMvJiVGRyZW6ic1MDCGV76URYSBUVLuNmJEZMIwhc/ESv2kBu4whpc7jFJJYMRUPROGKXwmVuonNXCHMbzcYZRKAiOm6pkwTOEzsVI/qYE7jOHlDqNUambkDjOwdQUk1dFMYHW6Eg23voepoezyZ2CVagtiGZhAxEoXBlaptiCWgQlErHRhYJVqC2K1BMYkLdCm3AVz2mbmnvpJDcQ/TTFJl6stCMjoyMw99ZMaGBiFk9HRwCgpa4wMrEZnWRQDk0lZ48jAanSWRTEwmZQ1jgysRmdZlE0DYyYvU5pwJDmOd/1HUtXkCZ1lJqqcJX7YapYEU1WZDAXn6KjmbmA5tJMFNnuJ1r+SsUWUS62xYICVzZ0VB7e2sC9X7ysTm9O+cdjnGWCsr112eJk/vV2IFYd5x1mRNHywOaniZX6qgEnfcWZvEcgmz3y+VWDSWwTQqriksWJZ3CIwLId4Dzq9S3FEHGysuMjy0GMkp0PnAv8VSyLuT2QOLsP7BS4JuXdglbYG7NVyGQ0l64w4h4Y2kxM12UmjQ3bYEKx9TmS4RwktnN2OM6PRFoDhRAj9hu/j2lccbJS4OAx/zGD2wH1zYvIYsWE6jL3DF7fd4G/6lu1qcZjJV+eUwTuqnKvFOarJZ6SWz48qZwPLqRlYolF1EWXIDCxTqOHnZUVWFmhgP2jIa/gHiOk5Gti0dH89WKZjWSB3WLPKMDAD0yig8VK2UpUFcoc1qwwDMzCNAhovZStVWSCNLvZiYM1qwMAMrJkCzdJ1hxlYMwWapesOM7BmCjRL1x3WDNgvn87gbdv+0jcAAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[1] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[2] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAACcxJREFUeF7tnY+RLUMUh/tFgAgQASJABIgAESACRIAIeBEgAkSACBABIqC+rWnVO+ZOf6ene+7Me9NVt3ardqb79PmdP79zZm7vk3SNU2ngyamkvYRNF2AnM4ILsAuwk2ngZOJeHnYBdjINnEzcy8MuwE6mgZOJe1YPez2l9HJKiZ+vTB9UX/6eofg9pcSHkX//JaX0R0qJn6caZwEMYN5MKb2VUnq3o4b/Sin9OH1+OgOARwYMkN5PKX2QUnqxI0hrUwHgNymlp0cF72iAAQwgfVyEuZ2w+t8yhMsMHkAeYhwFMID6aAJqL2+yAADWlymlr1JKdwfu3oAdGag5oIcA7p6AQR6+OEDos55Wss5PUkrfRW/scf09AIN6fz0xvh57uNccAAZwuWTYRY69AcOrAOtoeapV2YTJD/f0tj0BI/zB/kYOLB6CUA6M5NuRi05rsvbwsQdgeNMPU1di5Ia+XymqoeeUCyMHZcDbo5nkaMD2Auvvibzcot3IgUJpZ40cw0EbCRidCjyrNV/hMe9I7b4n8ghtLeQx49eU0mvmwoVrMBo8bUifchRgW8CiLfTZ1JL6VCiNHiBgmGFDI/1FyARytITSYaCNAAyP+q3Bs7Bq+obZMpmDEqA23ghYM7JBw1+oTZpSyvNiDBCZqMcB2qu9c1pvwFpz1ueTNWc9Ahz0vzZoF0WZJ9fDWGsDT0eOPPA24/HlvN1zWm/Afg6yQZ5JoRRCUDnMPDWisQYIXmYICB5SFsZ4GwWz8dC8PqDhrV1GT8AIGzRw7SAEooA5s7PkoMW7smy2Npt7GfcTRTCwSIjcIusjffYCzCogLw5R4J4lGg6TMyRibv3WUErLN0pfWqcFNMNkq3voARjEgBBm6fuS1WZBmQuyURtrc9TuzX/vkSct62RNjJPQuKn32AMw6xEIvdaN4O9WiRFmuDWXoWC87NYgp9l6kWvxtOaxFbBIKLyVs0rhzeaZhzqvx+hhINHwuCk0bgEMQQmFplaC0aHktXDAfH8KFChoCUU9hq3LaiEYHcAGDXtEB0SIpqfXWwCL1CUmhBlr30LlbwFs8hDKfaliIRgkBmzGvO409zxc0wpYpJthhTPhsJYD9caLC20ZYUKZNeLmLkgrYFYwm2/uEQ5LcE0hXQuLeT4zF9daQ35khC2ARbyLrvW8i7HkBdbKCUtNsb/ieqboN2GRZexemrysBbDWXtyazozHRrry0dBo848t1k1eRMalJ+SrsrcAZrvodnMIaPJXUwgJIIfF11ieZai2ARDuM0YBs5Zo433WpzECG14DGD261HhFZF9mPgQwDPo/QaOAmVjP5BHvstYYlTUKnCkrIh5h9xVqDEeVQGFb6xlGrBClmm6JZZtRkMrrrYIjxMd4mSUz4TrMhkNTr5SKMoQjZIUbUDN5LBKajTGGwmLEwww7pBNR88C5PqH9fPdrbYwmHHntEbIYI9BsMQKYYXLRcIiijJIiVr3BwR5euqm9BhA1HhMWdQcnAtg/QhPRcMiUhiFGSIwQ8+YlJoRF60FDZnQes4DZ/BVJyFlrxhCsnFvA4l7TpYgCZttuit5bRRjL44Ua86hlrtQaYC15sRU4wxS1NxRCmP6iik4WMBPbdRwuNjLColvBGunxJk+r3GgBM4lTLTjT5hEBM6wumlONwSvCZgEzFgKLjL5PTggqX9Zc8g7CSa8nzMb7kKcW2pEn8jINHKB2XIXKjT0BM8q4rrmtga6AGep9gbFNA7W3sx5mtx5WY3LbRL3uzhqo4lG9YJrpAmwfo6riUb3gAmwfpKZVqnhUL7gAOydgplLfdWfP4GKqU2Q9zNRhz6AOd91SV1pvAKM11VI4175DjOXtXTjXvuxHVyJaONe+MNEVsOepNWUYsY1M2UV3b02ZBVuav+bRQ+TFlx4xbARgJkKpXqy1FPN4RVXqCxodoaBW4MzjlZYXgkynSD1Vt4CNfIBpuuNWzlag8n0jnh6YKML6XR9gMqHxBPUQbqZVEy7UZraiJb8BGn2Dy7wioB/SRiz3eXgJx7woq3JNYTxGbzr/RwAzr7m1PD4foaRWZzPebt+vzzKYl2+HvOZm81g0LBoGqp7GtqJU3GeUq8jBNKchazp/RR6v5D0ZghBV7ohE34KdJQeRqGTqV9WS0s9fZjs34YtbIu88jFBUC2DGG1Q3YlrclAhcGiIxEWthchsWo15mmsujmaIxxohyjXeFwmFLSOQeOg+tR/7csnzDpHRibnGv6QSA2vkfNj9b7woX4VEPQxeGLXJdxMsM8dDUtwEwG5ZtqLfeFTbCFsDsYSTozTIqQzxaSgaLnSluLTkwe0GupjNHWgBjMeMRXGf7i9bCR+UxE5JtxDB9Q3QTLcAfjK8VsIiXWcFMbowkfetd1lhM/rKG3ORdWwCLeJllQmazIx61mHBoen02FDZ711bAImfBm7MCbclgE7/1MHN8YC0cRs6MJBey16YDYlpDYlaGKTbztebAYlOP9QyL1kjW+ofRg6ktEVs0uK2AMalJ2Hnx2gGPpnjtyRYt/V77oiL/16X2RYe8/82lSQ/AImcFIjhKwmKXhvXYaMd8aS1LNm4pmfs5Tr327Zu8tjkzshrGewDGIlbRJjyaBjOPQQgtW4YhOcy/FMKiYZB5DMus7qcXYCxkwlkp0K2ctkWR1Q1PF9gT6ZaK5RawuuXdnoChC1NLlUrFm7C88og+G6q2eJk1rnnohbqTsyJnkYT7hWtW1xuw6IHFWTa8igI7D0sGWhiXbczOvYvzO5AzMszB1JH5mjsda4tEuiDzEEkzFM+xdLulkDZ1F3LlxixeBbmodfLnOtlUb91ScG8Py+uwORRfO39wSa78z0DxstqRRqVijaVacgSjAyi8ylL2cv18f/TV9eoeRgHGwltAy/nQWLXpojCfJRpcy5yRPLULWCwyErCspOg/lqla2cIFhoDYUNiyfr6ne86aCzMasD1BW3sqYEuFQ4O1h4eVCrBUeovSllhjpIveuna3OqsmwB4eVspAAodMtJCR2l7u8XfIBa2p3f7N/d6AoVTqILyt9gW3ewAQWZMeI2A1PSaJLFReew/A8vp4G8DVvu3YurdR9936N5Cj1ns07z0By4SEt7D4HD1MEv4wMD67etVRPKyUg5rnqMAdAqisrHt72DyMABx5gY95WXVkGKKmgiDxuZtH3aMOa1UqXY4M3l7hEm/KIHVvK7Uq4oghsbYXwKOeyp9eAAIQXZL8OSRIZwRsDigAUh7kn/lASn7OWSesLp+pwU8+AJN/1ozlUH8/Wg47lHKOKMwF2BFRWZHpAuwC7GQaOJm4l4ddgJ1MAycT9/KwC7CTaeBk4l4edjLA/gX1/FWLGqQ9KgAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[2] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[3] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABeBJREFUeF7tnfG1DTEQh+dVQAeoABWgAlSAClABKkAFqAAVoAJUgA6ogPM5m3PWulcmm2SSuSbn3PP+uPuys79vZzKT7OaeSTRXCpy5sjaMlQDm7CYIYAHMmQLOzA0PC2DOFHBmbnhYAHOmgDNzw8MCmDMFnJkbHhbAnCngzNzwsADmTAFn5oaHBTBnCjgzNzwsgDlTwJm54WEBzJkCzswNDwtgQxS4KCIXRIS/fNbtu4h8EpEfy98hBrY6qUcPOy8i10Tk+vK5UigG8N4vnw8iAlA3zROwmyJyS0TuNlb3jYi8FJG3jfvt0p0HYHdE5PGBUNdakK/LeV617rhlfzMDswK11ZOQ+XAJmS21btLXjMAYk16ISOnY1ESQVSeMc4AD4DRtNmD3l7BEYjFLu7eMcVPYMwswAL1esr4phNkYQVICuOFtBmDAejdBCMzBIETeHl0GjAbWElaqqbZjTiqmqd1qG30DjYxySBsJjKSCMLidmdAK8XkZW7jztYkB56SW43NZe6LVccPHs1HAajyLOom6rPYuB94DEaF80LThsDByFDDS9tIZC2YiELgW1BYOHv5MRJhJOdamgDUKGKI/1dzSyzFM2gKXKaSejTBJNnhuc5JpYI0ARhj6WKA64xRCtvaqYyYQqhkT0/g2FawRwEjfmWXXNLI+YFnPpgMNT0uTwhpbzY6xHMMABTBNI7EoHeM0/bo/xhIYoVAzP0gYBK61Z7mAaQUMbyEzzDUSDKBajVk5ezTfE0LJNLW1oKbPo8dYAfuiLJBvzLqscUTBVE8CDNu7Q7MARuLAjEaukWRoE5JcXxbfb4t/Qnh3aBbAKEpZNsk1T951bKamOzQLYJpw6CkrzE2rdYXWG5i2UL5qEf9zLq74PgcrddENWm9gTNI+ygjxTZmQKPTseogWVldovYFpaq/ny6RuV7UrOy+F1Q1ab2A/FULNnmzshdUFmhbY3gU/QmKuaY5Z90FxTeZp0WphNYemBbadxbYQ69A5gEWt1r1AFZFWsJpC0wLjpKOheYbVDFoJsJHQTgFWE2ilwEZAOyVY1dD2ALOEdoqwqqDtBWYB7ZRh7YZWA6wntP8B1i5otcB6QPufYBVDawGsJTRLWNjNhIDmsYV1TZibG+XYJzsKVSaMsxMCrYC1gGYNa4emv4t2zYNELXX9w87WHe8trj3AQjjNYiwPEZV6rfrmaQ1sj6d5gcW1aRZjCYel86NDgZVA8wSLB20AlmtdF2N7eFi6oFx49ASLa+Jp4NybLt0XY3sC+5eneYOl9a7ui7G9gR2C5g0W18BjepQAudZ9MdYC2Boad6rVelZOXO332lS+ezjEYCtgCZrZI81aGpnjsJfnUjTbUJi8mmQJrJGGZt2UrDibPbUcwI7z145b9NB97EpmzgosvenC1kHWrx3hWZxfk2Sgo5l3WY9h2li2fmGdh224e62g7dnn6pLl61Gzedih3QWAxWYmvHvcs+FRnF+TYCQ7TBKN9UXPBCy3FQTAmKdrDY60nSWT0leduhfJh+7OWYDlYK1tZ4oIsWqfTST8AUo7Vq1tMB23ZvOwElhr23mtljf9+SCgprHfVNq6qGbLpGHvYI/2MERD8D37Pm0BESrTDtrr7/AkxqXSkHfoBhg+rTYaWJoBAVqL3dY0Xrb3mCl2N5gBWBJQs3yxV+za/5vmDdGZgCGqdnuIWgAl/0/xnn04pqTDmmNnA8a1MOYg0OgQSSLDUn/rMqKGl+lsfamhJAmAa5GQlJybZRJAEaKnazN62FYkwiQC8tsqPdvUoNKFewCWbE31U+65ihKoQCLkpXqu5H+HHOsJWBIo1VTpx3JKQybpeQJUO1tiDs0jsEMipZ2zD/0cFTMi64+5yC1PeCrAWmoydV8BbGo8fxsXwAKYMwWcmRseFsCcKeDM3PCwAOZMAWfmhocFMGcKODM3PCyAOVPAmbnhYQHMmQLOzA0PC2DOFHBmbnhYAHOmgDNzw8MCmDMFnJkbHhbAnCngzNxf+LobfIEzylQAAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[3] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[4] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABSFJREFUeF7tneGxTEEQhftFQAaIABEgAyJABIgAESACZCCDRwSIABkQAXXK3Cq1nj09M92zevdM1fu1vT1zz3d7pu9M731nplZKgbNSo9VgTcCK3QQCJmDFFCg2XEWYgBVToNhwFWECVkyBYsNVhAlYMQWKDVcRJmDFFCg2XEWYgBVToNhwFWECVkyBYsNVhJ0QsNtmdt/MbrS/Ypd+kOF+MjP8vTWz9yMjGIkwAHphZgCmNq4AgD1pAN1eeoEB1rmZXXb3IMN9Cnw3szs90HqACVbOzdcFrQcYIkvTYA40TI+INNq8wAAKwNTyFAAwmoh4gb1pGWHecOUZmeMDJoMX2Eel7kzK6c+R7t9kXrzAfjJH+jxEAcqDGrRhCFgID+qE8qAGAkZFjjSgPKiBgEXyoL4oD2ogYFTkSAPKgxoIWCQP6ovyoAYCRkWONKA8qIGARfKgvigPaiBgVORIA8qDGghYJA/qi/KgBouBfTCzd20TFFs1aFfbthg2oLHXdoledl0DyoMaLAL2rcFgu9U4OH15xBvRlAc1WADscztnw0GetyHSXnuNC9lRHtQgGdiPNuX1wNr0P8YjH8qDGiQDe2hmEH6kYXr8OrmmPR/p2PEdrLe3HHa7JpQHNUgEhnULCcVMe9wquEZ9eK+/1/8zM3va+yUz/hoO74AzjldemRkEn2kA/mXCgff6e7s4SmD3WgrfK8au/czNJGAd6ruKThz+8Cgwsl7AtYA5BN5MBOxvsegNRA0Skw5NicWAKekoBgzPUNc6ptCLTJXW/0PAmUxsH5PZB2ek9DM/zED6ndHw4DxS1k6XKGqQuIbBNbakEGUjW1PYS6SVshk0En1SHtQgGRjc4xgFGWMPtEdt1z5Ru4O4pjyowQJg6ALrGaZHz/EKfkx4bJG13R2UBzVYBGwbMIDhABNRh8NMNGw/XTezu+1vZs06SNh0dEp5UIPFwDqu7ShNKQ9qIGBLbwzKgxoImIDtUwDrFtavizLG7fUSV5ZKuLYzGkDUIDnCUCKAE+etUsojD5IQJCDIFJGMRDbcMCxT9fR3dCfOAIVdBsDqef7aFQvCwM/o8cquP5QMROx+HNUBJjZ9cUEzoHaFRsQB/mzNooD9oSyiCsJGTDkXTUt4PoPvmWlSwJqygIXpa6vm9awDozYz5W8C1lTHr+NXwNogj5YNCFh7ARbKq1e20ZrFkweGNHnkXCgC7kg598kDi6rbGAWIU4CeB+2TBhZR2TsKavtebwkB1r6ILLbkifMhp8MNWLWXmtGdJ2owsTUVNb3MRNlsKfdM3yPfpTyoQXFgGH5WAdEIEPYdyoMaCBjTOPRzyoMaTAALvZITcUZ5UAMBW3qrUB7UQMAEbKkCxTqjAUQNFGFLkVMe1EDABGypAsU6owFEDRRhS5FTHtRAwARsqQLFOqMBRA3aBeN4f6a4pZhuBxku3rmFYtm9zQtsprCFjUGf/1Yg9F95VDtXqngTuF6D4Y0wCDBaiVRRvNVjdh/29gDD/Apos9W1q8X43/vrqtnsAYYLF7RY/F2w0HUvsA0a6gyjfoAQK0Edb5gGUSTUVWA7AmyTZHtpMqJOKb/vRkHqDkDIuoeqs2aA+YYoq1AFBCxUznxnApavcWgPAhYqZ74zAcvXOLQHAQuVM9+ZgOVrHNqDgIXKme9MwPI1Du1BwELlzHcmYPkah/YgYKFy5jsTsHyNQ3sQsFA5850JWL7GoT0IWKic+c4ELF/j0B4ELFTOfGe/AIIG1G0M3DZfAAAAAElFTkSuQmCC" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[4] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[5] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAAA+JJREFUeF7tnO2NFDEMQH0VQCdABUAlUAJUwFEBlACVABUAnUAFIB97YgV7F9vjxI70RrpflzjJe/maKLNXwrMVgautaktlBWGbdQKEIWwzAptVlxGGsM0IbFZdRhjCNiOwWXV3GWHPROSFiDw+/WVi/iYi+vdRRD5nBp4Rq7swFfRORFTYikeFvT4JXFGeu4zOwlTWJxF56G7VsQw/ROR5V2ldhVXJulXdVlpXYTqyVk2Dd41HnR51pLV6OgpTUSqsw6PCWm1EOgr7cNoRdhCmO8eXHSpyW4eOwr5O2LpHmet2/0k084x8HYX9mtHQAzFbMWpVmRNUi7Cseq8s60Cf+Zs1q+EplUHYGCPCNmOEMISNCQxSrFxXVpZ1GIwGYISNMbZi1KoybDo26z0IQ9iIAGvYiJDh/yshrizL0PRxEtawzRghDGFjAryHxRkxwsbsWjFqVRm29Zv1HoQhbESAbf2IkOH/KyGuLMvQ9HGSXdewccvyUrRi1KoyJ8Z68eVRHu9Dkb43uhB005COwrjmdk8f6yiMi6SbCdPq6m3bp4cms+OZvzS4Lv5fKzqOMK2kfgyh0h4c5x6K8PMkS9fTVk9XYZXS2srquuk479E60t4vnB51GnzV9duwHYTdytONiH6UoAKzt/y6ddepT3enrb5UuTQXd54SPWvHtYi8GWR4KyKabusHYZvpQxjCSggwJZZgjxeKsDi7kpwIK8EeLxRhcXYlORFWgj1eKMLi7EpyIqwEe7xQhMXZleREWAn2eKEIC7AbHb4GQpqz6Gn+6MfE9CS+8jReD58PP5lniZY7focrvHGAFNYpQU4QEXZ/b0phnRIEYaZxn8I6JQjCEGYisFmilMGREoQRZuo6KaxTgiAMYSYCmyVKGRwpQRwjLOXl8YIofWkeXe3WO4ezXpwthwYprFOCOIRllnfurfpoyvIOmtL2lCAIE4Q51ydGmBOYJl/Wyy7UDWEIcxFY1llZw1xe7kyMMCdHpkQnMNawMbCU2SwlCNv6dRsuhI1HhiUFa5iF0lka1jAnMNawMbCU2SwlCGtY/zXMMgWN+5xI9Ltjy5phKT/SYUvbHqmwgiittPEYDGHORd4CjBFmoXSWhhHmBFY9uyAMYS4CTIkuXPEfuGTT4QR9IXmoszIl+sGXdlaEIcxFIDQt8B7mYnyTuHRaQBjCPARKOytrmEfVn7QI8zMznY5bwkY6LMIsZP9Jw2m9E1ppL2PT4bRVPY8jDGEeAqWzS2TR9TSOtMkEEJYMdHY4hM0mnBwfYclAZ4dD2GzCyfERlgx0djiEzSacHB9hyUBnh0PYbMLJ8X8DXMYHfOVVQ0YAAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[5] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[6] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABNRJREFUeF7tnTvMdVMQhp+/UQlxSXQUEgQFESTuNDqi1VCg0WgkKCQqjUSnISES1d9INBRuQeHaiBAd4hZBRKUik+wjEt//z+w960y+WefdzVesWTNznudbZ5/L2mefQEcrAidadatmkbBm/wQSJmHNCDRrVytMwpoRaNauVpiENSPQrF2tMAlrRqBZu1phEtaMQLN2tcIkrBmBZu1qhUlYMwLN2tUKOyBhNwH3APb3UuDsZo+9ut0/gK+A94CTwEdbGtiywi4DXgKu31JQc/4l8AbwEPDtGiZrhV0FvAmcu6aIYk9J4EfgNuDrKKM1wi4GPgTOiyZXXIjA98A1wM+R6DXCPgOujiRVzGoCrwF3RWZFhd0NvBpJqJjNBK4FPvFmR4W9AtzrJdN4isAzwKNehqiwb4ALvWQaTxH4GLjOyxAV9hdwhpdM4ykCv0defUeF/R1oJZorkGrKkCEMo5CHFJtSQ/xBDWEoYXHg2UgJyxIsni9hxcCz5SQsS7B4voQVA8+Wk7AsweL5ElYMPFtOwrIEi+dPJ+wJ4Hngl2KQVeWmEvYs8Miy5+GWSaVNI2wna/efbhtVZpQ2hbCngCePeE6aUVp7YY8BT5/mBDKbtNbC7HxlT4XeYdJuBH7zAhuMtxV2P/DiCsCfA7cDv66YcxxD2wo7H3h/2S0cBWvSbP9e55XWVphJOkRprYUdorT2wg5N2hTCdtLeAa6IntAAO6fdDNgVIV2OaYQZ8HOWy3DWSLOt43c0kjaVsEOQNp2w2aVNKWxmadMK20l7C7ALCKPHcT+nTS3sLOBdCfv//+px3PlrrxhnW11GfsoVNvPL++mEzSxruhW2RVa3TzumWWH2yf2Wj6a6fd0yhbBD+pqlvbBDktX+HHZosloLu2B5U2w/KBY9tmwRiDwFRet7cZH3s5F+3DxuwNLpkGJLrvuWHxfzIOzGt27CifQc7cGLi3CM9OPmcQP2IMxSRre5bVlZO7gRQJ6I6HiEY6QfN48bsCdhljaykTSzJzECKCrEi4twjPTj5nED9ijMUu9zq3YEkCciOh7hGOnHzeMG7FmYpd/XxRARQFEhXlyEY6QfN48bUCDsv9JG7qePAPJERMcjHCP9uHncgCJhVuZx4IWB14ZFAEWFeHERjpF+3DxuQKEwD8ra8QigtTlPFR/hGOnHzeMGNBY2SsaoPBI2imRRHgkrAj2qjISNIlmUR8KKQI8qI2GjSBblkbAi0KPKSNgokkV5JKwI9KgypcL+BM4c1bnyHEnAGNsW9dMe0U86vgTsNlQ69kfgC+BKL31UmP3K2gNeMo2nCDwHPOxliAq7E3jdS6bxFAHbGGtX7Ax5SrQkHwA3eAk1vomAiTJh7hFdYZboouV2SbanUMc4Aj8Adisq++sea4RZMrvh29u6QanLNRrw0/I7WvZNe+hYK8ySXg68vNwGMFREQUcSsJuWPgh8t4bPFmG7/LcutwW2rWiXRN5DrGlswlj7ERh7e2TnK7st8KdbHmNG2JZ6mpMkIGFJgNXTJayaeLKehCUBVk+XsGriyXoSlgRYPV3Cqokn60lYEmD1dAmrJp6sJ2FJgNXTJayaeLKehCUBVk+XsGriyXoSlgRYPV3Cqokn60lYEmD1dAmrJp6sJ2FJgNXT/wFN4Al8hEGjDAAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[6] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[7] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABEJJREFUeF7tnUvLTVEYx3/vyMDAZaBIUoqRqYGBSxJTn0AJUynkkmuRSxkYKGHiE5gpA6GIT8DIjJlLYkyrztHb2znv86y1tnU557+n67nt/289z9lnt9t7AR1dKbDQVbUqFgHrbBMImIB1pkBn5arDBKwzBTorVx0mYJ0p0Fm56jAB60yBzspVhwlYZwp0Vm5uh60CdgLbgNWdnXvpcn8AH4G3wM/U5KnADgKngH2piefc7xlwDXgXq0MssGD/ADgWm0j2ExW4CZyL0SYW2GPgSEwC2ZoK3ALOmlYjgxhgp4Hb3sCyi1LgMPDE4+EFtgH4BKzwBJVNtALfgE3Ab8vTC+wScNUKpvUsBY4DD60IXmDvgR1WMK1nKfAUOGRF8AL7Cqy1gmk9S4Hwk7PFiuAF9scKpJFpKnTZtMB+xmZIYN5Yjrpn0sSz6U0NTYORdIMkm0kM/pMaREMB8wueaylguQoW9hewwoLnphOwXAUL+wtYYcFz0wlYroKF/ecW2BpgO/C6sOC56eYWWBAunPx94CIQ7nT3cMw9sAApwArQArzWDwFbRCiMxwCu5TEpYBNaquUxKWBTZmCrY1LAjB+t1sakgDmvMloZkwLmBNbK1aSARQAbm9YckwKWAGzsUmNMClgGsBpjUsAygZUekwI2ELBSY1LABGy6AoPsjgEF9tTjTVfqytFTs/lQlGkwOutBknkVdNh56rHClL6F5anZ5GEazCgwXdbjeMzY2vIR657dOilcqfE3KbenZrOBTIMZ6bDS40/Alijg2a2lLte9g8FTs9lApkHHHVZz/KnDIjqshfEnYE5gNa7+NBIdCiz9PWht/KnDpnRYq+NPwCYAa3n8CdgSBXY1/gyigDl+11o3mev/Ya3DUYf1SMj5V2SxmXkjwzRo9E5Hj/w0EjujJmACNl2BQXZHZwIPXe4gGuo3bGgs/3nTDwlM71NcHn7Rl4N9AdaX24xzmekzsNE6c2+HvQD2WsG0nqXAc+CAFcELTC9otpTMXz8B3LPCeIGtG72keaUVUOtJCoQvRWwGvlveXmAhzkngrhVQ60kKhA83PPJ4xgAL8cJbn496AsvGrcAd4IzXOhZYsA87QV+H8Cq8vN0N4EJMqFhg49j7gfPAnphksv2nQPhYznXgTawmqcDGecKLusLnqLYC4dNUtY6wcXYbyV8BL2sVCITPUX0YQfqVWkcusNS8Q/tdAaw7CeFOTLDr+hCwzvAJmIBVUUAjsYrs6UkFLF27Kp4CVkX29KQClq5dFU8BqyJ7elIBS9euiqeAVZE9PamApWtXxVPAqsienlTA0rXL9vQ8cJmdJCJAU7fvmipmJKKALbObBMxutaY0aqoYdVhnu0fABMxWwLZoago1VYw6rLPdI2ACZitgWzQ1hZoqxtZOFgLW2R4QMAHrTIHOylWHCVhnCnRWrjpMwDpToLNy1WGdAfsLYTX9bSZLfU4AAAAASUVORK5CYII=" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[7] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $tipo_chamados[8] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtds[8] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <br>
    <hr>
    <br>

    <div class="container" align="center">
        <h3><strong>RANKING SETOR</strong></h3>
    </div>

    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div id="chamado">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row">

                                <div class="ms-2 c-details">
                                    <h5 class="mb-0"> <strong>
                                            <?php echo $setor_chamados[0] ?>
                                        </strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABDtJREFUeF7tneGNE0EMhU0HlEIHQAVABUAlQCVABdAB0AGlQAWgEYt0hCSfnfH4PNJb6cSPe2N732fvbDaX8MB0bOXAg62qVbEmYJs1gYAJ2GYObFauJkzANnNgs3I1YQK2mQOblbtywt6a2Rvw452ZDd3d45fDw9O6d8jlOC2WCFjco1ubgzM5FALGJmVNM2dyKASMTRKwOx5pD+OG+UehCWPDNGGaMO6SSwpNGHunCdOEcZd0nbDbK++98tzNVErF931JTDmJhkEErCGUayUJmID9cUCXxDWdoAlb4+uyqAK2zNo1gQVsja/LogrYMmvXBN4S2DkrPO8mr7FwbdSVN29lT+sFbEGTlHXGUbsmbBKigE0aeCwv87EsUWDCxoZNB/01Fq3/+/usXGU+liUKAPPUlHVpzcrlieNtoqu6skQClsJr6bPEW+8SPU2kCcvhj1E8RgvYFRs95iCFgEDAAmadkwoYG5jVZJzJoRAwNknAwCNPE3lMZBS+N3A9uTw1e+pBjTeR54Wq50Vo1sl74uDJO99x9+Ty+JjioSfROPGsoivjdAOWcu4CxlhTjM5qegETsKsOVHYro6i96Ug5944T5jG6m8bjo4A1oiZgjWB4ShEwj0uNNFsCO/2+jXN+ejSNOLhL8ZyXR4PgUXCU7Nkw3Wcn4UUHkAcKBKy0vZAHCgRMwEod2CwZDhAKNGGlyJEHCgRMwEod2CwZDhAKNGGlyJEHCjYC9tPMvpvZj+PfUfojM3toZo9Lbb89GfJAwQbAPprZ5+PnmlXPzWz8vLzdz+UrkQcKGgP7dnz97NegjU+OdR2nDnmgoCmwMVWvgqBO5R8aThvyQEFDYK/NbJidcQzo7zMCJcVAHihoBixjsjpPGvJAQSNgY88a+8+KY+yDHfY05IGCRsCemln0BsMLdzTCF694oQ55oKAJsBWXwo6XRuSBgibAXjheZ802/niN9mk2yOR65IGCBsDGE4zxtKLiuO931pEHChoAW3mzcdoE933zgTxQ0ABYxf71F9x4xPWsYpQv5EAeKGgAbNkXbZ0xzfMf4azkiTxQIGAr+fwXG3mgQMAELOqALol3HNOE/ds+2sOi43RGrwnThF1sI02YJizkAG5RKNBdYsjwWTHyQIGAzTIIrUceKBCwkOGzYuSBAgGbZRBajzxQIGAhw2fFyAMFAjbLILQeeaBAwEKGz4qRBwoEbJZBaD3yQIGAhQyfFSMPFAjYLIPQeuSBAgELGT4rRh4oELBZBqH1yAMFAhYyfFaMPFAgYLMMQuuRBwoELGT4rBh5oOCowPPFVrPFXlo//rhz1YcgTnOOD0Ws+oSMxx/02QvMk0yaAgcErMDkzBQClulmQSwBKzA5M4WAZbpZEEvACkzOTCFgmW4WxBKwApMzUwhYppsFsQSswOTMFAKW6WZBLAErMDkzhYBlulkQ6zca2hx8x/cXewAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[0] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[1] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAACclJREFUeF7tnXnIfkUVx78/K4sybYE2LTXUsCxbyYUsFywI1AwKs7JMpaDNCopQLFCMyDZwwS2XCuuPLBIqbA8SCltAK2wP2v6pLCoKUvnovfLw9jx3vjN37ty57zsHHl5+3DMz55zvPXPPnDkzv11qtCgL7FqUtE1YNcAW9hI0wBpgC7PAwsRtHtYAW5gFFiZu87AG2MIssDBxm4c1wBZmgYWJ2zysAbYwCyxM3OZhDbCFWeA+cd8r6TJJf6ld+uZh0imSPi3p95JOlvS9mkHb6YA9VtJPJT1yBaSzJF1RK2g7HbCbJL10DTgflPQeSXfXBlytgO0n6URJJ3UG49/8oG92f38j6fOSvpBo1FdKumGg7SclvSax78ma1QbYeR1Iz4zQ+G8dcB+T9COz3aMk/VwSf4foYklvNvsswlYLYKdJet+KF6Uqf42k90vC+4boc5JeZg7ydkm8DFXQ3IA9QtKNkl6U0Rp43NmSAG8dHSfp5sjxni7ptsg2k7DPCRjTHmD136bcCn60A25rv+iM11wo6cHmoD+TdKik/5r8k7HNBRhgfUMSHjYl4WWv3zDAYZK+ImlPUwAW14A8K80BGCD9ugBYvWH5pvF9XEfPlvR1SXsZKDDVMhvcafBOxlIaMMDCs2KiwBzKE2CwBFhHeNrXJD3UGOh8SecafJOxlAaMN53QvTThHftL4u86eoOkKw2h/i7pMZL+Y/BOwlISsJSp8NrOM1hf9aE6ESUeSuCwb4RVhqZGuvmSpJcY/b1W0vUG3yQsJQEjanubqQXZCwAJradeJ4l+3W/Qswb6fLKkXxryfUfSUQbfJCwlAXPzcngVQLiEt5GuckBjfQbAm+jjkt5iDPzoubZiSgFGTpA1V4hiwer7c0FjasXLNtE+kn4rabeAoK+W9KmQMlM8LwUY6yHST0NEuEzYvCkwCOnvBjQEH0NTLWuz4wODXSXpjJBAUzwvBdhfjXVXKCgI6U9QAxChqTE0Lb5D0kWBwdjkfH5IoCmelwLM+X6F3nxHf8eTQy8Gi+lbA4P9S9LDHIFy85QAjDcfDwtNhznSVESWHwmMReYdviFyXrDHSfpzbkBC/ZUAjHUT2Y0h+lamjH2usX7VLbSHZGYN+LuQgXM/b4CttyjrMdZlQ3RQtwmaG5PB/koA5kyJRIarhTCpRsg1JToedoik21MFTW1XAjBkc74JtQQdyMtuQmifbttOiRgADwqF26HoLfRSurnKUFj/QEn/kPSQgQF5AR9gvoghuaOel/IwJ9wOZdRDiuVaOLPdcktgMLIhIQ8MyZv0vBRgbmpqaId4SEF3B/vHxl7cOyV9KGDNb0t6YZLFRzYqBZg7LcIXC5oLFn2HpkN4nIoqMiHvGmn7pOYlAYvZXmF3GOOGtlfIT9Kvs+gmVwm4Q32yOcl0N/T9wtBHrxS0Jhk+tVFJwNxc36oueBvgMZX1hmYq6jcwY74jTlBzuaQzA8YEeLZX/pdq9DHtSgKGnG5gMEandW2dnQAWwj/por+h8T8riTLvWag0YCjJnhQ1fiVpqAgHOR7eRYZPM4Ri6yW2ENXo1mOZA7CUqdHTZj1XKNDYvct1HmEM8gNJzzH4JmOZAzCUcXeIxyru7GCzE96fkgmNd4KkL4aYpnw+F2A9aAQUMZVPMbZwggy2+V9ldsoJTUoIZqU5AUNxpkdAy7kIJcAgCbzpMATjUrNxnaRTI61PtMpBvy9HtsvGPjdgvSJUSRFBjvU2pkD6Ca3fKBqleDSVqPtA5j+ldpDarhbAevnxDAwRE0XiUXipAxTjUEBzeqrBVtqR+wR0MiPFqDbAesVZEBMIrB6Z7b2P3WmoPzK7qWZ+nREvkfSmzNbFWzmlWaR8u1bAMtv0/u6eKunYroztGPMAhCMLa0vOZE9eMrDTAFs1/oMksfZ6cQcg1VJj7EEUSQk3u9WT0RgBJxNqpo737opdSSiTpkqhP0p6gVmjn9L/qDcqacCFNMLo795wh0dIBbL9eO4fQowpz+f2MNZhRISr93Ck6LHahoMRRI7uFRBD4x0u6QMJp1W4XYe22U9rlgasvzCF+kF+zj7WGAABDQD5pV7Awvgvl/RhSU+KEOar3ffxrog2QdZSgPFdYH2V83qHoHJbGFg3kf2g8je0sF7XN5uarOHcVBZ9XCDpnFhBh/inBizXhSk5daYv9wKWreNiL86QubfjUF31PKNW39ZvKsDwJGrcSx8+txXvGMmO4HGxR5y4/oGcokNO4Y/Tz708UwAGUKHDBraABRiZHtngjA1SLpX0RlM+sitcoDmacgJGQMHeUu1etcloKXdKEciwRxYiksQHSPpniDH0PBdgMaVmIZnmfB5bYsctOj80Dk6gE+s67mEcRTkA2y5g9YaMBe25kr5voEAW5AkG3yDLWMBygMVHmY8+v9jvyKpyrOn66Zi/oVr+IcPEgsZlmM5mKNs6nxgD2hjAMBDTQUxtYC8rWyRsi/BLWRM5OvfbM/xNAS9UvLMqwxPNTD1X+HGVXzKNASymeGUVKD7uYzwpRVnCd8aNBY4rIlxZWR681RDuSEnfNfjWsqQC5hycWx2QhCiZjv6+3lR5x7RjRgA49zYexsL7Ac1Zpz3eTPiy7OGmgiRKAYwpkKnQzQMy/TEtOUonKRHZKOa6I7p2qq96ET4j6RUBeXgJOLyYRCmAOWe9emGcusAkwUc2iq2LdE+HUhVMgU6IniLpjhDTuuexgOFdHCd1qFawetljQIvRhdObewQMRC6SG7ujKRYw17sI1ckn1jINbjIM06MbZrte5kyL/NchzjLg/+SOAcy5DYABnJMi0W/WhA3cc2vOhSyISX6RPOMQcenzwSk6xQDmRoYxH+kUmXO3cQ9nuFdTcALGuTI9xvb36xzTiMgwlNhdmnf1hnDPrYWOLfX9/ds4xXmgpF/Evn0uYO50yJXjQzXtsfKV5HeupnCnRb7hzwgIn3Ts1gXMvQXA/TCXBMIdywmoQhdk9mNt+l+TVmXhFCenOaPIBcyZMrLurEZpkYfZfSkdm1098B8c9NKm7L/ZO84kaSlFHqKYZGkeE+fvxZkWY/KL2SV03hYGJQcYOsOVNCdn12hch9Xr6QLmXO61UwCbddmSEzCuz6s9sxHyP2cRvW0Ac8EPGW3O505w1QCbE6EtYzfAKgLDEaUB5lipIp4GWEVgOKJsG8AcZRtPAQtsh8iugJnqGaIBVg8WliQNMMtM9TA1wOrBwpKkAWaZqR6mBlg9WFiSNMAsM9XD1ACrBwtLkgaYZaZ6mBpg9WBhSdIAs8xUD1MDrB4sLEkaYJaZ6mFqgNWDhSVJA8wyUz1MDbB6sLAkaYBZZqqH6R69Mpd8Y7GaBwAAAABJRU5ErkJggg==" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[1] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[2] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[2] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[3] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[3] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[4] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[4] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[5] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[5] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[6] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[6] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[7] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[7] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[8] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[8] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[9] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAAXNSR0IArs4c6QAABG1JREFUeF7tndFxFDEQROUIIBMgAkwkOASIBEKASAwRAJlABFBT7PrLdre0fSPNbV+Vv3Z2pqefpJOvdHs3za9SDtyUUmuxzcCKDQIDM7BiDhST6xlmYMUcKCbXM8zAijlQTG6VGXbbWnvfWnu9/RWz+UHuz9Za/H1trX0baWJ1YAHoU2stgF3bK4B93ADSva0MLGDdt9Ze0t3UC/zdWnvXA21VYGeAtQ+vLmirAouZdY3L4FNrQCyPMdPga0VgASqAne0VwOBGZEVgX7Yd4dmAxc7xDjW9IrAfxbfuyPOnrsd2/w26eUVgf5HoK74OecCACeYwwFbUjayS9LVi45LGkHsTrkv6MrA8cgaW57WkkoFJbMxLYmB5XksqGZjExrwkBpbntaSSgUlszEtiYHleSyoZmMTGvCQGlue1pJKBSWzMS2JgeV5LKhmYxMa8JAaW57WkkoFJbMxLYmB5XksqTQfm49N9HKcB8/HpPlB79BRgZziR23USt4NdOrAzwNr9vwS0dGA+Pt0xnR4JTQXm49PHYMXdqcB8fLoYMB+fLgaMmc7HW1ozg+rsJuMhrAUDNg8lxRbkkdmXpJaB4VHEeoQyGRhyiLguMZGok75LzGyM7F8SltmXpBY73SXFJBZrk2T2JallYHgAsB6hTAaGHCKuS0wk6vg9jDQJhRkYcmix6wYGgDAGqZgy7z2MHiYPo1lSixUjKUZ+Ys00z8Qwvan6YvRIajFNyd4wDQxyhTxggPizRGaUwa7IAKY3Rg+Th5EkqcWKkRTzDINcIQ8Y4Bkm+zEGyaA3MDjoDQxbpIlgBqNk1JNyJbWYprxLJIkI/geFPGCA+D1M07ouCzPqddVwJsgDBhgYdlkU8Yt5TqSBidwWpJE+kZRZOlj4gt5kKZi+ZMVAIukzf5nGDGwc7Xf2KeKsyQY2DgPd+WeDFc/8hS8DgxZdNKALVigxsIvyeDZ5LIMfen7Gw8C4b5QokcbWPZa++HIJ/FGBxwpnzzDmvVBlENMbo4fJo9IM87BiVI0xeaBoMoDpjdHD5CElHQ9jxagaY/Ic7+p/BqY3Rg+TR6UZ5mHFqBpj8kDRZADTG6OHyUNKOh7GilE1xuQ53pVnmOb7uSc/IiAZiJ5h2EbWI5xJEMGKYZYyJheTR9CWNx2M0QamGmrP5GFMjttVwBJa6ipRri8Dw3xZj3AmQQQrptxIJL0p15eBYbKsRziTIIIVU24kkt6U68vAMFnWI5xJEMGKKTcSSW/K9WVgmCzrEc4kiGDFlBuJpDfl+lICIz0qF8Z6lNIYKybOIbxKUbRWEer4dKZkFpifSJpJRfBZop/5WwxYyI1jWW8X0Z0hgz4+nSFmr8EuiREfz60PaC8yBU6q1X0iN0tnD7CzQFsWVgDoBbZD+3yly+PQ8ems2TUKbNcXG5G7bamsvOU/fHy6CrBMna61OTCyJNq8iQ4Y2ETzR0ob2IhrE+8xsInmj5Q2sBHXJt5jYBPNHyltYCOuTbzHwCaaP1L6HxRW+m3e2qcyAAAAAElFTkSuQmCC" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[9] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[10] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[10] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row text-align=" center">

                            <div class="ms-2 c-details">
                                <h5 class="mb-0"> <strong>
                                        <?php echo $setor_chamados[11] ?>
                                    </strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5" align="center">
                        <img
                            src="data:image/png;base64,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" />
                        <div class="mt-5">
                            <div class="mt-3"> <span class="text1">
                                    <?php echo $qtdrs[11] ?><span class="text2"> Chamados</span>
                                </span> </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <br>
    <br>
    <hr>

    <div class="rodape" text-align="center" align="center">
        <h6 class="credits">Secretaria do Trabalho e Bem Estar Social
            <p>
                UGAM-<strong>NTI</strong>
            </p>
        </h6>
    </div>

</section>




<?php
include_once("rodape.php");
?>





<!--AJAX PARA CHAMAR O ENVIAR.PHP DO EMAIL -->
<script type="text/javascript">
    $(document).ready(function () {

        $('#btn-enviar').click(function (event) {
            $('#mensagem').addClass('text-info')
            $('#mensagem').text("Enviando!!")
            event.preventDefault();

            $.ajax({
                url: "enviar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    $('#mensagem').removeClass()

                    if (mensagem.trim() === 'Enviado com Sucesso!') {

                        $('#mensagem').addClass('text-success')


                        $('#nome').val('');
                        $('#telefone').val('');
                        $('#email').val('');
                        $('#comentario').val('');

                        $('#mensagem').text(mensagem)
                        //$('#btn-fechar').click();
                        //location.reload();


                    } else {

                        $('#mensagem').addClass('text-danger')
                        $('#mensagem').text("Você precisa está com o site hospedado para fazer envio de Emails")

                    }



                },

            })
        })
    })
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="js/mascara.js"></script>
<script type="text/javascript"></script>