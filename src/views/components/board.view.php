<!-- Inherits base HTML  -->
<?php $this->layout("/../template/base.view", ["title" => $board_title]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/board.view.css"); ?>">
<?php $this->stop(); ?>

<div class="board-container">

    <header class="board-header">

        <h2 class="board-header-title"><?= $board_title; ?></h2> <!-- .board-header-title -->
    </header> <!-- .board-header -->

    <form action="<?= get_url("/newpost?board={$board_uri}"); ?>" method="POST" enctype="multipart/form-data" class="new-post-form">

        <textarea name="post_text" id="post-text" cols="30" rows="10" required placeholder="Seu texto aqui..." class="textarea post-text"></textarea> <!-- .textarea .post-text -->

        <input type="file" name="post_image" id="board-text" required accept="image/*" class="post-image"> <!-- .post-image -->

        <button type="submit" class="btn btn-green btn-create-post">Criar tópico</button> <!-- .btn .btn-green .btn-create-post -->
    </form> <!-- .new-post-form -->

    <ul class="posts-lists">

        <?php for ($i = 0; $i < 10; ++$i) : ?>
            <li class="post">

                <img src="<?= get_url("/assets/images/post_image_example.jpg"); ?>" alt="post-image" class="post-image"> <!-- .post-image -->

                <div class="post-info">

                    <h3 class="post-owner">&#x27A4; <a href="#">Ir para o post.</a></h3> <!-- .post-owner -->

                    <p class="post-created-at">99/99/999 - 99:99</p> <!-- .post-created-at -->
                    <p class="post-text"><?= limit_words("Vestibulum efficitur congue justo. Morbi ultrices tincidunt urna id dictum. Suspendisse rhoncus eros id ex pretium mattis a a dolor. Morbi faucibus ultrices leo, at tempor turpis aliquet in. Donec sollicitudin posuere euismod. Nunc scelerisque convallis lobortis. Nulla euismod nisi dui, sit amet tempus massa convallis id. Integer et blandit libero, non lacinia ligula. Donec vulputate ex in mollis gravida. Phasellus semper, enim id feugiat consequat, lacus ante malesuada lacus, non vestibulum urna odio efficitur nunc. Aenean semper eu justo dictum malesuada. Integer lacus elit, mollis eget libero et, faucibus varius eros. Curabitur dapibus odio eros, quis aliquam turpis sollicitudin eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut dapibus enim. Vestibulum efficitur congue justo. Morbi ultrices tincidunt urna id dictum. Suspendisse rhoncus eros id ex pretium mattis a a dolor. Morbi faucibus ultrices leo, at tempor turpis aliquet in. Donec sollicitudin posuere euismod. Nunc scelerisque convallis lobortis. Nulla euismod nisi dui, sit amet tempus massa convallis id. Integer et blandit libero, non lacinia ligula. Donec vulputate ex in mollis gravida. Phasellus semper, enim id feugiat consequat, lacus ante malesuada lacus, non vestibulum urna odio efficitur nunc. Aenean semper eu justo dictum malesuada. Integer lacus elit, mollis eget libero et, faucibus varius eros. Curabitur dapibus odio eros, quis aliquam turpis sollicitudin eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut dapibus enim.", 100); ?></p> <!-- .post-text -->
                </div> <!-- .post-info -->
            </li> <!-- .post -->
        <?php endfor; ?>
    </ul> <!-- .posts-lists -->
</div> <!-- .board-container -->

<!-- Importing scripts -->
<?php $this->start("scripts"); ?>
<script src="<?= get_url("/assets/js/board.view.js"); ?>"></script>
<?php $this->stop(); ?>
