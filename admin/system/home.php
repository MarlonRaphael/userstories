<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<div class="content home">

    <section>

        <h1>Posts:</h1><br>

        <?php

        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager('painel.php?exe=posts/index&page=');
        $Pager->ExePager($getPage, 10);

        $readPosts = new Read;
        $readPosts->ExeRead("posts", "ORDER BY post_status ASC, post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
        if ($readPosts->getResult()):
            foreach ($readPosts->getResult() as $post):
                $posti++;
                extract($post);
                $post_date = date('d/m/Y', strtotime($post_date));
                echo "
                    <div class='card' style='margin: 50px 0;'>
                      <div class='card-body'>
                        <h4 class='card-title'>{$post_title} - {$post_date}</h4>
                        <p class='card-text'>
                            {$post_content}
                        </p>
                      </div>
                    </div>
                ";
            endforeach;

        else:
            $Pager->ReturnPage();
            WSErro("Desculpe, ainda não existem posts cadastrados!", WS_INFOR);
        endif;
        ?>

        <div class="clear"></div>
    </section>
    <div class="clear"></div>
</div>
