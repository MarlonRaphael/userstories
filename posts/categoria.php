<!DOCTYPE html>
<html>
<head>

    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar() {
        window.scrollTo(0, 1);
    } </script>
    <!-- //for-mobile-apps -->
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="../js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
    <!-- animation-effect -->
    <link href="../css/animate.min.css" rel="stylesheet">
    <script src="../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
    <link href='//fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
          rel='stylesheet' type='text/css'>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="../js/move-top.js"></script>
    <script type="text/javascript" src="../js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <!-- start-smooth-scrolling -->
</head>

<body>
<!-- banner -->
<div class="banner-figures">
    <div class="banner1">
        <div class="container banner-drop">
            <div class="header header1">
                <div class="header-right header-right1">
                    <nav>
                        <ul>
                          <li>
                              <a href="../index.php"><i class="glyphicon glyphicon-home" aria-hidden="true"></i><span>Início</span></a>
                          </li>
                          <li>
                              <a href="../encomendas.php"><i class="glyphicon glyphicon-shopping-cart"
                                                           aria-hidden="true"></i><span>Encomendas</span></a>
                          </li>
                          <li class="active">
                              <a href="../noticias.php"><i class="glyphicon glyphicon-globe"
                                                         aria-hidden="true"></i><span>Notícias</span></a>
                          </li>
                          <li>
                              <a href="../contato.html"><i class="glyphicon glyphicon-envelope"
                                                        aria-hidden="true"></i><span>Contato</span></a>
                          </li>
                          <li>
                              <a href="../sobre.html"><i class="glyphicon glyphicon-exclamation-sign"
                                                      aria-hidden="true"></i><span>Sobre</span></a>
                          </li>
                        </ul>
                    </nav>
<!--                    <div class="menu-icon animated wow zoomIn" data-wow-duration="1000ms" data-wow-delay="800ms">-->
<!--                        <span></span></div>-->
                </div>
                <div class="clearfix"></div>
            </div>
<!--            <div class="logo animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="500ms">-->
<!--                <span>Familia</span>Muczinski-->
<!--                <h1><a href="index.php"><img src="images/logob.png"/></a></h1>-->
<!--            </div>-->
            <div class="social-icons animated wow bounceInDown" data-wow-duration="1000ms" data-wow-delay="800ms">
              <ul>
                  <!--<li><a href="#" class="twitter"></a></li>
                  <li><a href="#" class="google"></a></li>-->
                  <li><a href="https://www.facebook.com/Familiamuczinski/" class="facebook" target="_blank"></a></li>

              </ul>
            </div>
        </div>
<!--    </div>-->
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

<div class="blog">
  <div class="container">
    <div class="animated wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">



    <?php
          require('../_app/Config.inc.php');
          require('../admin/_models/AdminPost.class.php');
          $read = new Read;
          $readaut = new Read;
          $readcat = new Read;
          $readaut->ExeRead('usuarios', " ", "");
          $readcat->ExeRead('categoria', " ", "");

          //Get do paginação
          if (isset($_GET["page"])) {
            $pageID = $_GET["page"]+'';
          }
          else {
            $pageID = 1;
          }

          $catID = isset($_GET["catid"]) ? $_GET["catid"] : '';

          //Limit da leitura do BD
          $bdLimit = $pageID*3;
          $read->ExeRead("posts", "WHERE post_status='1' and post_category='$catID' ORDER BY post_date DESC LIMIT ".$bdLimit);
          //Estabelecendo o Limit de posts
          $pageLimit = $bdLimit - 3;

          $i = 0;
          $filt_qublinha = array(chr(13));
          $filt_char = array("<br>");

          $ccPosts=0;

          echo "<div class=\"row\"><div class=\"col-lg-12\">";
          echo "<h1 class=\"page-header\">Posts por Categoria: ";
          echo "</h1></div></div>";

          foreach ($read->getResult() as $post) {
              extract($post);

          if ($ccPosts >= $pageLimit){
                $i = 1;

                //Contabiliza Visualização
                //$post['post_views']+=1;
                //Salva no banco a visualização
                //$Update = new Update;
                //$Update->ExeUpdate("posts", $post, "WHERE post_id = :id", "id=$post_id");


                //Titulo
                if ($post_category != null){
                 foreach ($readcat->getResult() as $category) {
                   extract($category);
                   if ($category_id == $post_category){
                     echo "<title>$category_name</title>";
                   }
                 }
               }
               else {
                   echo "<title>Categoria Desconhecida</title>";
               }

                echo "<div class=\"row\"><div class=\"col-lg-12\">";
                echo "<h2 class=\"page-header\">$post_title";

                //Categoria como subtitulo
                /*if ($post_category != null){
                 foreach ($readcat->getResult() as $category) {
                   extract($category);
                   if ($category_id == $post_category){
                     echo "<small>  Categoria: $category_name</small>";
                   }
                 }
               }
               else {
                   echo "<small>  Categoria Desconhecida!</small>";
               }
                 */
                echo "</h2></div></div>";
                //Fim--Titulo

                //Corpo
                echo "<div class=\"row\"><div class=\"col-md-8\">";

                //Imagem
                echo "<img class=\"img-responsive\" src=\"http://breadtime.esy.es/breadtime/uploads/$post_cover\" alt=\"\"></div>";

                //Descrição
                echo "<div class=\"col-md-4\">";
                echo "<h3>Descrição: </h3>";
                echo "<p>".str_replace($filt_qublinha,$filt_char,$post_content)."</p><br>";

                //Categoria
                if ($post_category != null){
                 foreach ($readcat->getResult() as $category) {
                   extract($category);
                   if ($category_id == $post_category){
                     echo "<h4>Categoria: <small>$category_name</small></h4>";
                   }
                 }
               }
               else {
                   echo "<h4>Categoria: <small>Categoria Desconhecida</small></h4>";
               }

                //Autor
                if ($post_author != null){
                  foreach ($readaut->getResult() as $user) {
                    extract($user);
                    if ($user_id == $post_author){
                      echo "<h4>Autor: <small>$user_name.</small></h4>";
                    }
                }
                }
                else{
                  echo "<h4>Autor: <small>Autor Desconhecido.</small></h4>";
                }
                //Data Post
                echo "<h4>Data: <small>".date('d/m/Y', strtotime($post_date)).".</small></h4>";
                //Views Post
                echo "<h4>Views: <small>$post_views</small></h4>";
                echo "<a href=\"../noticias.php\"><span class=\"label label-primary\">Voltar</span></a>";
                echo "</div></div><br>";
                //fim--corpo
              }
              $ccPosts++;
          }
          if ($i!=1) {
            echo "<title>Post Inexistente!</title>";
            echo "<h1 class=\"page-header\">Post Inexistente!</h1>";
          }


     ?>
     <nav>
         <ul class="pagination paging animated wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="500ms">
           <?php


             //Numero de Posts
             $readAllPosts = new Read;
             $readAllPosts->ExeRead("posts", " WHERE post_status='1' and post_category='$catID'");
             $numPosts = count($readAllPosts->getResult());
             //Declarando limite de paginas em cima dos posts.
             $limitPagePost = ceil($numPosts/3);

             //Gerando botoes de paginas
             if ($catID > 0) {
               if ($pageID > 1) {
                 $lastPage = $pageID-1;
                 echo "<li>";
                 echo "<a href=\"../posts/categoria.php?catid=$catID&page=$lastPage\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a>";
                 echo "</li>";
               }

               for ($i=1; $i <= $limitPagePost; $i++) {
                 echo "<li><a href=\"../posts/categoria.php?catid=$catID&page=$i\">$i</a></li>";
               }

               if ($pageID != $limitPagePost) {
                 $nextPage = $pageID+1;
                 echo "<li>";
                 echo "<a href=\"../posts/categoria.php?catid=$catID&page=$nextPage\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>";
                 echo "</li>";
               }
             }

           ?>
         </ul>
     </nav>


        <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //noticias -->
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
            <img src="../images/1.png" alt=" " class="img-responsive" />
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
                <img src="../images/muczinski1.jpg" alt=" " class="img-responsive"/>

                <p>Inaugurada em 2010, A Panificadora e Confeitaria Família Muczinski é um exemplo de empresa familiar
                    que deu certo!
                    Com um amplo mix de bolos, doces, salgados, kit festa e coffee break... <a href="sobre.html">
                        Continue lendo.</a></p>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Contato <span>.</span></h3>

                <form>
                    <input type="text" value="Name" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Name';}" required="">
                    <input type="email" value="Email" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <textarea type="text" onfocus="this.value = '';"
                              onblur="if (this.value == '') {this.value = 'Message...';}"
                              required="">Mensagem...</textarea>
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Produtos <span>populares</span></h3>

                <div class="footer-copy-grids">
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="single.html"><img src="../images/1.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="single.html"><img src="../images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="single.html"><img src="../images/3.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="footer-copy-grids">
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="single.html"><img src="../images/4.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="single.html"><img src="../images/5.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="col-xs-4 footer-copy-grid1">
                        <a href="single.html"><img src="../images/2.jpg" alt=" " class="img-responsive"/></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-3 footer-copy-grid">
                <h3>Navegação</h3>
                <ul>
                  <li><a href="index.php">Início</a></li>
                  <li><a href="encomendas.php">Encomendas</a></li>
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
<!-- //footer -->
<!-- here stars scrolling icon -->
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
<!-- //here ends scrolling icon -->
</body>
</html>
