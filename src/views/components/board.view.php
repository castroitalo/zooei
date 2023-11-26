<!-- Inherits base HTML  -->
<?php $this->layout("/../templates/base.view", ["title" => $board_title]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/board.view.css"); ?>">
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/posts-list.view.css"); ?>">
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

    <!-- Insert posts list -->
    <?php $this->insert("/../templates/posts-list.view", ["posts" => $board_posts]); ?>

    <div class="paginator">

        <a href="<?= ($board_page - 1) < 0 ? get_url("/{$board_uri}?page={$board_page}") : get_url("/{$board_uri}?page=" . $board_page - 1); ?>" class="paginator-option">&#10096; Anterior</a> <!-- .paginator-option -->
        <a href="<?= get_url("/{$board_uri}?page=" . $board_page + 1); ?>" class="paginator-option">Próximo &#10097;</a> <!-- .paginator-option -->
    </div> <!-- .paginator -->
</div> <!-- .board-container -->

<!-- Importing scripts -->
<?php $this->start("scripts"); ?>
<script src="<?= get_url("/assets/js/components/board.view.js"); ?>"></script>
<?php $this->stop(); ?>
