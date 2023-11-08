<?php $this->layout("/template/base.view", ["title" => "Home"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/home.view.css"); ?>">
<?php $this->stop(); ?>

<section class="boards">

    <section class="boards-list">

        <header class="boards-header">

            <h2 class="boards-headers-title">QUADROS</h2>
        </header> <!-- .boards-header -->

        <section class="boards-list">

            <ul class="interests">

            </ul> <!-- .interests -->

            <ul class="states">

            </ul> <!-- .states -->
        </section> <!-- .boards-list -->
    </section> <!-- .boards-list -->
</section> <!-- .boards -->
