<?php $this->layout("/template/base.view", ["title" => "Home"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/home.view.css"); ?>">
<?php $this->stop(); ?>

<section class="boards-container">

    <header class="boards-header">

        <h2 class="boards-headers-title">QUADROS</h2> <!-- .boards-headers-title -->
    </header> <!-- .boards-header -->

    <div class="board-list">

        <ul class="board-categories interests">

            <header class="categories-header">
                <h3 class="categories-header-title">Interesses</h3> <!-- .categories-header-title -->
            </header> <!-- .categories-header -->

            <?php foreach (get_interest_board_categories() as $interestCategory) : ?>
                <li class="category"><a href="<?= get_url($interestCategory->board_interests_uri) ?>"><?= $interestCategory->board_interests_title; ?></a></li> <!-- .category -->
            <?php endforeach; ?>
        </ul> <!-- .board-categories .interests -->

        <ul class="board-categories states">

            <header class="categories-header">
                <h3 class="categories-header-title">Brasil</h3> <!-- .categories-header-title -->
            </header> <!-- .categories-header -->

            <?php foreach (get_states_board_categories() as $statesCategory) : ?>
                <li class="category"><a href="<?= get_url($statesCategory->board_states_uri) ?>"><?= $statesCategory->board_states_title; ?></a></li> <!-- .category -->
            <?php endforeach; ?>
        </ul> <!-- .board-categories .states -->
    </div> <!-- .board-list -->
</section> <!-- .boards -->
