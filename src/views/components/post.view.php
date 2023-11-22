<!-- Inherits base HTML  -->
<?php $this->layout("/../templates/base.view", ["title" => "Post"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/post.view.css"); ?>">
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/posts-list.view.css"); ?>">
<?php $this->stop(); ?>

<div class="post-container">

    <div class="post">

        <?php if (!is_null($post->post_image)) : ?>

            <img src="<?= get_url("/assets/images/posts-images/" . $post->post_image); ?>" alt="post-image" class="post-image"> <!-- .post-image -->
        <?php endif; ?>

        <p class="post-created-at">Criado em: <?= $post->post_created_at?></p> <!-- .post-created-at -->
        <p class="post-text"><?= $post->post_text; ?></p> <!-- .post-text -->
    </div> <!-- .post -->

    <!-- New comment post form -->
    <?php $this->insert("/../templates/new-post-form.view", ["get_key" => "parent", "get_value" => $post->post_owner]); ?>

    <!-- Listing all post's comments -->
    <?php $this->insert("/../templates/posts-list.view", ["posts" => $comments]); ?>

    <div class="paginator">

        <a href="<?= ($post_page - 1) < 0 ? get_url("/post?owner={$post_owner}&page={$post_page}") : get_url("/post?owner={$post_owner}&page=" . $post_page - 1); ?>" class="paginator-option">&#10096; Anterior</a> <!-- .paginator-option -->
        <a href="<?= get_url("/post?owner={$post_owner}&page=" . $post_page + 1); ?>" class="paginator-option">Próximo &#10097;</a> <!-- .paginator-option -->
    </div> <!-- .paginator -->
</div> <!-- .post-container -->

<!-- Importing scripts -->
<?php $this->start("scripts"); ?>
<script src="<?= get_url("/assets/js/post.view.js"); ?>"></script>
<?php $this->stop(); ?>
