<!-- Inherits base HTML  -->
<?php $this->layout("/template/base.view", ["title" => $boardTitle]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/board.view.css"); ?>">
<?php $this->stop(); ?>

<h1><?= $boardTitle; ?></h1>
