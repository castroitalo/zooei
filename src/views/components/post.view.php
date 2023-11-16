<!-- Inherits base HTML  -->
<?php $this->layout("/../template/base.view", ["title" => $post_title]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/post.view.css"); ?>">
<?php $this->stop(); ?>

<div class="post-container">

    <div class="post">

        <img src="<?= get_url("/assets/images/posts-images/" . $post_data->post_image); ?>" alt="post-image" class="post-image"> <!-- .post-image -->

        <div class="post-content">

            <p class="post-created-at">Criado em: <?= $post_data->post_created_at; ?></p> <!-- .post-created-at -->
            <p class="post-text"><?= $post_data->post_text; ?></p> <!-- .post-text -->
        </div> <!-- .post-info -->
    </div> <!-- .post -->


    <form action="<?= get_url("/newcomment?parent={$post_data->post_owner}"); ?>" method="POST" enctype="multipart/form-data" class="new-comment-form">

        <textarea name="comment_text" id="comment-text" cols="30" rows="10" required placeholder="Seu comentário aqui..." class="textarea comment-text"></textarea> <!-- .textarea .comment-text -->

        <input type="file" name="comment_image" id="comment-text" accept="image/*" class="comment-image"> <!-- .comment-image -->

        <button type="submit" class="btn btn-green btn-create-comment">Criar comentário</button> <!-- .btn .btn-green .btn-create-comment -->
    </form> <!-- .new-comment-form -->
</div> <!-- .post-container -->
