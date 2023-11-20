<!-- Inherits base HTML  -->
<?php $this->layout("/../templates/base.view", ["title" => "404"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/not-found.view.css"); ?>">
<?php $this->stop(); ?>

<div class="not-found-container">

    <div class="not-found-header">
        
        <h2 class="not-found-header-title">404 - Page Not Found</h2> <!-- .not-found-header-title -->
    </div> <!-- .not-found-header -->
</div> <!-- .not-found-container -->
