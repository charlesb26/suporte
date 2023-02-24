<?php
require_once("sistema/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
echo("<meta http-equiv='refresh' content='60'>");
?>

<head>
    <link rel="stylesheet" href="cabecalho.css">
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $nome_sistema ?>">
    <meta name="keywords" content="ajudasetrabes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nome_sistema ?></title><!---->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="cabecalho.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    

    <link rel="icon" href="sistema/imagens/favicon (2).ico" type="image/x-icon">
</head>

<body 
    style="background-color: #CED4DA;">
    
    <!-- Page Preloder  -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Wrapper Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <span class="icon_close"></span>
        </div>
        <div class="logo">
            <a href="#"><!-- ./index.php -->
                <img src="sistema/imagens/logo.png" alt="">
            </a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="om-widget">
            <ul>
                <li>
                    <a href="./sistema/index.php"> 
                    <button type="button" class="btn btn-dark">Login </button>
                    </a>
            </li>
            </ul>
        </div>

    </div>
    <!-- Offcanvas Menu Wrapper End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="hs-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        
                    </div>
                    <div class="col-lg-10">
                        <div class="ht-widget">
                            <ul>
                            <img src="sistema/imagens/favicon (2).ico" type="image/x-icon">
                                <li><a href="./sistema/index.php"> 
                                <button type="button" class="btn btn-dark">Login</button>
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="canvas-open">
                    <span class="icon_menu"></span>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->




    

<style type="text/css">
    .alerta{
      background-color: #1d9670; color:#FFF; padding:15px; font-family: Arial; text-align:center; position:fixed; bottom:0; width:100%; opacity: 80%; z-index: 100;
    }

     .alerta.hide{
       display:none !important;
    }

    .link-alerta{
      color:#f2f2f2; 
    }

    .link-alerta:hover{
      text-decoration: underline;
      color:#FFF;
    }

    .botao-aceitar{
      background-color: #e3e3e3; padding:7px; margin-left: 15px; border-radius: 5px; border: none; margin-top:3px;
    }

    .botao-aceitar:hover{
      background-color: #f7f7f7;
      text-decoration: none;

    }

  </style>

<div class="alerta hide">
  Chamada de atendimento NTI -  <a class="link-alerta" title="Ver as políticas de privacidade" data-toggle="modal" href="#modalTermosCondicoes"" >SETRABES.</a>
  <a class="botao-aceitar text-dark" href="#">Aceitar</a>
</div>


<script>
        if (!localStorage.meuCookie) {
            document.querySelector(".alerta").classList.remove('hide');
        }

        const acceptCookies = () => {
            document.querySelector(".alerta").classList.add('hide');
            localStorage.setItem("meuCookie", "accept");
        };

        const btnCookies = document.querySelector(".botao-aceitar");

        btnCookies.addEventListener('click', acceptCookies);
    </script>
