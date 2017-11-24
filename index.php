<!DOCTYPE html>
<html>
<head>
    <title>Panificadora & Confeitaria - Familia Muczinski</title>
    <!-- Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Mobile Apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
    <!-- //Efeito da animação -->
    <link href="css/animate.min.css" rel="stylesheet">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //Efeito da animação -->
    <link href='//fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
</head>
<body>
<!-- banner -->
<div class="banner-figures">
    <div class="banner">
        <div class="container banner-drop">
            <div class="header">
                <div class="header-right">
                    <nav>
                        <ul>
                            <li class="active">
                                <a href="index.php"><i class="glyphicon glyphicon-home" aria-hidden="true"></i><span>Início</span></a>
                            </li>
                            <li>
                                <a href="encomendas.php"><i class="glyphicon glyphicon-shopping-cart"
                                                            aria-hidden="true"></i><span>Encomendas</span></a>
                            </li>
                            <li>
                                <a href="noticias.php"><i class="glyphicon glyphicon-globe"
                                                          aria-hidden="true"></i><span>Notícias</span></a>
                            </li>
                            <li>
                                <a href="contato.html"><i class="glyphicon glyphicon-envelope"
                                                          aria-hidden="true"></i><span>Contato</span></a>
                            </li>
                            <li>
                                <a href="sobre.html"><i class="glyphicon glyphicon-exclamation-sign"
                                                        aria-hidden="true"></i><span>Sobre</span></a>
                            </li>
                        </ul>
                    </nav>
<!--                    <div class="menu-icon animated wow zoomIn" data-wow-duration="1000ms" data-wow-delay="800ms">-->
<!--                        <span></span></div>-->
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="logo animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h1><a href="index.php"><img src="images/logob.png"/></a></h1>
            </div>
<!--            <div class="social-icons animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="800ms">-->
<!--                <ul>-->
<!--                    <li><a href="#" class="twitter"></a></li>-->
<!--                    <li><a href="https://www.facebook.com/Familiamuczinski/" class="facebook" target="_blank"></a></li>-->
<!--                    <li><a href="#" class="google"></a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
<!--    <script>-->
<!--        (function ($) {-->
<!--            $(".menu-icon").on("click", function () {-->
<!--                $(this).toggleClass("open");-->
<!--                $(".container").toggleClass("nav-open");-->
<!--                $("nav ul li").toggleClass("animate");-->
<!--            });-->
<!---->
<!--        })(jQuery);-->
<!--    </script>-->
</div>
<!-- //banner -->
<!-- banner-bottom -->
<div class="banner-bottom animated wow lightSpeedIn" data-wow-duration="1500ms" data-wow-delay="800ms">
    <ul id="flexiselDemo1">
        <?php

        require('_app/Config.inc.php');
        $read = new Read;
        $read->ExeRead('posts', " WHERE post_status='1' ", "");
        $readcat = new Read;
        $readcat->ExeRead('categoria', " ", "");
        $countPost = 0;
        //Imprimir na aba-populares
        foreach ($read->getResult() as $post) {
            extract($post);
            if ($countPost == 0) {
                $iSub = "";
            } else if ($countPost == 4) {
                $countPost = 0;
                $iSub = "";
            } else {
                $iSub = $countPost;
            }

            echo "<li>";
            echo "<div class=\"item item-sub$iSub\">";
            echo "<div class=\"item1\">";
            echo "<i class=\"glyphicon glyphicon-cutlery\" aria-hidden=\"true\"></i>";
            //Categoria
            if ($post_category != null) {
                foreach ($readcat->getResult() as $category) {
                    extract($category);
                    if ($category_id == $post_category) {
                        echo "<h3>$category_name</h3>";
                    }
                }
            } else {
                echo "<h3>Bread Time</h3>";
            }

            echo "</div>";
            echo "<div class=\"p-mask\">";
            echo "<h4>$post_title</h4>";
            echo "<p>" . substr($post_content, 0, 50) . "...</p>";
            echo "<div class=\"social-icons\">";
            echo "<ul>";
            echo "<li><a href=\"posts/post.php?id=$post_id\" class=\"label label-default\">Ver Post</a></li>";
            //echo "<li><a href=\"https://www.facebook.com/Familiamuczinski/\" class=\"facebook\" target=\"_blank\"></a></li>";
            echo "</ul></div></div></div>";
            echo "</li>";

            //Post Count
            $countPost++;
        }


        ?>

    </ul>
    <script type="text/javascript">
        $(window).load(function () {
            $("#flexiselDemo1").flexisel({
                visibleItems: 4,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

        });
    </script>
    <script type="text/javascript" src="js/jquery.flexisel.js"></script>
</div>
<!-- //banner-bottom -->
<!-- banner-bottom-grids -->
<div class="banner-bottom-grids">
    <div class="col-md-7 banner-bottom-grid-left animated wow fadeInLeft" data-wow-duration="1000ms"
         data-wow-delay="500ms">
        <img src="images/logobt.png" alt=" " class="img-responsive" style="height:300px; weight:600px;"/>

        <h2>Baixe nosso <span>aplicativo</span></h2><br/>

        <h4>Seja notificado assim que novas fornadas de paes sairem!</h4><br/>


        <div class="more">
            <img src="images/logoplay.png"/>
        </div>
    </div>
    <div class="col-md-5 banner-bottom-grid animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
        <img src="images/muczinski1.jpg" alt=" " class="img-responsive"/>

        <div class="banner-bottom-grid1">
            <div class="banner-bottom-grid1-pos animated wow fadeInUpBig" data-wow-duration="1000ms"
                 data-wow-delay="500ms">
                <h3>Aceitamos Encomendas <br/> Bolos <br/> Doces <br/> Salgados <br/> Coffee Breaks</h3>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="banner-bottom-grids">
    <div class="col-md-4 banner-bottom-grid-sub animated wow fadeInLeft" data-wow-duration="1000ms"
         data-wow-delay="500ms">

    </div>
    <div class="col-md-8 banner-bottom-grid-left1 animated wow fadeInLeft" data-wow-duration="1000ms"
         data-wow-delay="1000ms">

    </div>
    <div class="clearfix"></div>
</div>
<!-- //Banner - inferior -->
<!-- Rodapé - top -->
<div class="footer-top animated wow zoomInDown" data-wow-duration="1000ms" data-wow-delay="800ms">
    <div class="container">
        <h3>Entre em contato conosco <span>(41) 3044-0442</span></h3>
        <!-- Abaixo existia informações da pagina-->
        <p><span> </span></p>

        <div class="more">
            <a href="contato.html">Contato</a>
        </div>
        <!-- Imagem do Footer removida.
        <div class="footer-top-image">
            <img src="images/1.png" alt=" " class="img-responsive" />
        </div>-->
    </div>
</div>
<!-- //footer-top -->
<!-- footer -->
<div class="footer-copy animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="800ms">
    <div class="container">
        <div class="footer-copy-grids">
            <div class="col-md-3 footer-copy-grid">
                <h3>Sobre <span>Muczinski</span></h3>
                <img src="images/17.jpg" alt=" " class="img-responsive"/>

                <p style="text-align: justify">Inaugurada em 2010, A Panificadora e Confeitaria Família Muczinski é um
                    exemplo de empresa familiar
                    que deu certo!
                    Com um amplo mix de bolos, doces, salgados, kit festa e coffee break... <a href="sobre.html">
                        Continue lendo.</a></p>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Produtos <span>populares</span></h3>

                <div class="footer-copy-grids">
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/1.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/3.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="footer-copy-grids">
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/4.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/5.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="#"><img src="images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Contato<span>.</span></h3>

                <form>
                    <input type="text" value="Nome" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Name';}" required="">
                    <input type="email" value="E-mail" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <textarea type="text" onfocus="this.value = '';"
                              onblur="if (this.value == '') {this.value = 'Message...';}"
                              required="">Mensagem...</textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Navegação</h3>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="encomendas2.php">Encomendas</a></li>
                    <li><a href="noticias.php">Notícias</a></li>
                    <li><a href="contato.html">Contato</a></li>
                    <li><a href="sobre.html">Sobre</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="footer animated wow bounce" data-wow-duration="1000ms" data-wow-delay="800ms">
    <div class="container">
        <p>© 2016 Familia Muczinski. Todos os direitos reservados.</p>
    </div>
</div>
<!-- //Rodapé -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
</body>
</html>
