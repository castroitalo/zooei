<!-- Inherits base HTML  -->
<?php $this->layout("/template/base.view", ["title" => "Início"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/home.view.css"); ?>">
<?php $this->stop(); ?>

<section class="home-container">

    <div class="home-options">

        <ul class="options-container">
            <li class="option"><a href="<?= get_url("/"); ?>">Página Inicial</a></li> <!-- .option -->
            <li class="option"><a href="<?= get_url("/rules"); ?>" target="_blank">Regras</a></li> <!-- .option -->
            <li class="option"><a href="https://github.com/devcastroitalo/zooei" target="_blank">Contribua</a></li> <!-- .option -->
            <li class="option"><a href="/support" target="_blank">Apoie</a></li> <!-- .option -->
            <li class="option"><a href="/advertise" target="_blank">Anuncie</a></li> <!-- .option -->
        </ul> <!-- .options-container -->
    </div> <!-- .home-options -->

    <div class="board-list">

        <ul class="board-categories interests">

            <header class="categories-header">
                <h3 class="categories-header-title">Interesses</h3> <!-- .categories-header-title -->
            </header> <!-- .categories-header -->

            <?php foreach (get_interests_boards() as $interestCategory) : ?>
                <li class="category"><a href="<?= get_url($interestCategory->board_uri) ?>"><?= $interestCategory->board_title; ?></a></li> <!-- .category -->
            <?php endforeach; ?>
        </ul> <!-- .board-categories .interests -->

        <ul class="board-categories states">

            <header class="categories-header">
                <h3 class="categories-header-title">Brasil</h3> <!-- .categories-header-title -->
            </header> <!-- .categories-header -->

            <?php foreach (get_states_boards() as $statesCategory) : ?>
                <li class="category"><a href="<?= get_url($statesCategory->board_uri) ?>"><?= $statesCategory->board_title; ?></a></li> <!-- .category -->
            <?php endforeach; ?>
        </ul> <!-- .board-categories .states -->
    </div> <!-- .board-list -->

    <div class="disclaimer-container <?= accept_dack(); ?>">

        <div class="disclaimer-modal">

            <header class="disclaimer-header">
                <h2 class="disclaimer-header-title">Isenção de responsabilidade</h2> <!-- .disclaimer-header-title -->
            </header> <!-- .disclaimer-header -->

            <p class="disclaimer-warning">Para acessar <a href="<?= get_url("/"); ?>">zooei.com.br</a> você concorda com as seguintes afirmações:</p> <!-- .disclaimer-warning -->

            <ul class="disclaimer-topics">
                <li class="topic">- Você tem mais de 18 anos de idade.</li> <!-- .topic -->
                <li class="topic">- Você concorda com todas as <a href="<?= get_url("/rules"); ?>" target="_blank">Regras</a> do site.</li> <!-- .topic -->
            </ul> <!-- .disclaimer-topics -->

            <button type="button" class="btn disclaimer-accept-button">Aceito</button> <!-- .btn .disclaimer-accept-button -->
        </div> <!-- .disclaimer-modal -->
    </div> <!-- .disclaimer-container .invisible .visible -->
</section> <!-- .boards -->

<!-- Importing scripts -->
<?php $this->start("scripts"); ?>
<script src="<?= get_url("/assets/js/home.view.js"); ?>"></script>
<?php $this->stop(); ?>
