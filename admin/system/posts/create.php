<div class="content form_create">
    <article>
        <header>
            <h1>Criar Post:</h1>
        </header>
        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '0' : '1');
            $post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null);
            unset($post['SendPostForm']);
            require('_models/AdminPost.class.php');
            $cadastra = new AdminPost;
            $cadastra->ExeCreate($post);

            echo $post['post_category'];


            if ($cadastra->getResult()):

                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;
                header('Location: painel.php?exe=posts/update&create=true&postid=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;

        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="post_cover"/>
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title"
                       value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>"/>
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content"
                          rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?php
                    if (isset($post['post_date'])): echo $post['post_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>"/>
                </label>
            <div class="clear"></div><br>
            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm"/>
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm"/>

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->
