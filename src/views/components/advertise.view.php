<!-- Inherits base HTML  -->
<?php $this->layout("/../template/base.view", ["title" => "Anuncie"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/advertise.view.css"); ?>">
<?php $this->stop(); ?>

<div class="advertise-container">

    <header class="advertise-header">

        <h2 class="advertise-header-title">Anuncie</h2> <!-- .support-header-title -->
    </header> <!-- .support-header -->

    <div class="advertise-options">

        <p>TODO</p>
    </div> <!-- .support-options -->
</div> <!-- .support-container -->
