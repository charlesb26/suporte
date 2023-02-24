<?php 
include_once("sistema/conexao.php");
 ?>

<!-- Footer Section Begin -->
<!-- gene
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="fs-about">
                        <div class="fs-logo">
                            <a href="#">
                                <img src="sistema/imagens/logo.png" alt="">
                            </a>
                        </div>
                        <p>Em qual lugar você imagina morar? Para facilitar a aquisição da sua casa própria, consulte-nos e encontraremos por aqui o imóvel ideal para você.</p>

                      <?php if(@$_GET['id'] == null){ ?>
                        <div class="fs-social">
                            <a target="_blank" href="https://www.facebook.com/profile.php?id=100081455408642"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $tel_sistema ?>"> <i class="fa fa-whatsapp"></i></a>
                        </div>
                    <?php }else{ ?>
                        <div class="mt-2">
                            <a target="_blank" href="https://www.facebook.com/profile.php?id=100081455408642"><i class="fa fa-facebook text-light mr-2"></i></a>
                            <a href="#"><i class="fa fa-twitter text-light mr-2"></i></a>
                            <a href="#"><i class="fa fa-youtube-play text-light mr-2"></i></a>
                            <a href="#"><i class="fa fa-instagram text-light mr-2"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p text-light mr-2"></i></a>
                            <a target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $tel_sistema ?>"> <i class="fa fa-whatsapp text-light mr-2"></i></a>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="fs-widget">
                        <h5>Links</h5>
                        <ul>
                            <li><a href="contatos.php">Contatos</a></li>
                            <li><a href="imoveis.php">Imóveis</a></li>
                            <li><a href="corretores.php">Corretores</a></li>
                            <li><a href="sobre.php">Sobre</a></li>
                            <li><a href="index.php">Home</a></li>
                            <li><a target="_blank" href="sistema">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="fs-widget">
                        <h5>Buscar Imóvel</h5>
                        <p>Digite o ID do Imóvel</p>
                        <form action="imovel-detalhes.php" method="get" class="subscribe-form">
                            <input type="text" name="id" placeholder="Id ou Código">
                            <button type="submit" class="site-btn">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright-text">
                <p></p>
            </div>
        </div>
    </footer>
gene -->
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.richtext.min.js"></script>
    <script src="js/image-uploader.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>