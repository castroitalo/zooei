<!-- Inherits base HTML  -->
<?php $this->layout("/../templates/base.view", ["title" => "Apoie"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/support.view.css"); ?>">
<?php $this->stop(); ?>

<div class="support-container">

    <header class="support-header">

        <h2 class="support-header-title">Apoie</h2> <!-- .support-header-title -->
    </header> <!-- .support-header -->

    <div class="support-options">

        <h3>Caso você puder e quiser, ajude o site a se manter doando para a chave pix:</h3>

        <br>

        <p class="pix-key"><?= $pix_key; ?></p>
    </div> <!-- .support-options -->
</div> <!-- .support-container -->
