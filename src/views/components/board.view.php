<!-- Inherits base HTML  -->
<?php $this->layout("/../templates/base.view", ["title" => $board_title]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/board.view.css"); ?>">
<?php $this->stop(); ?>

<div class="board-container">

    <header class="board-header">

        <h2 class="board-header-title"><?= $board_title; ?></h2> <!-- .board-header-title -->
    </header> <!-- .board-header -->

    <!-- Render flash is there is one -->
    <?php if (has_session_key("flash_message")) : ?>
        <?= get_flash_message(); ?>
    <?php endif; ?>

    <!-- Insert new post form -->
    <?php $this->insert("/../templates/new-post-form.view", ["get_key" => "board", "get_value" => $board_uri]); ?>

    <ul class="posts-list">

        <?php foreach ($board_posts as $post) : ?>

            <li class="post">

                <img src="<?= get_url("/assets/images/posts-images/" . $post->post_image); ?>" alt="post-image" class="post-image"> <!-- .post-image -->

                <div class="post-info">

                    <h3 class="post-owner">&#10551; <a href="<?= get_url("/post?owner=" . $post->post_owner); ?>" target="_blank">Ir para o post.</a></h3> <!-- .post-owner -->

                    <p class="post-created-at">Criado em: <?= $post->post_created_at; ?></p> <!-- .post-created-at -->
                    <p class="post-text"><?= limit_words($post->post_text, 100); ?></p> <!-- .post-text -->
                </div> <!-- .post-info -->
            </li> <!-- .post -->
        <?php endforeach; ?>
    </ul> <!-- .posts-list -->
</div> <!-- .board-container -->

<!-- Importing scripts -->
<?php $this->start("scripts"); ?>
<script src="<?= get_url("/assets/js/board.view.js"); ?>"></script>
<?php $this->stop(); ?>
