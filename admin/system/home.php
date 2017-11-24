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
                    <div class='post'>
                        <h1 class='title'>{$post_title} - {$post_date}</h1>
                        <div class='content'>
                            {$post_content}
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
