<!-- Inherits base HTML  -->
<?php $this->layout("/../template/base.view", ["title" => $post_title]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/post.view.css"); ?>">
<?php $this->stop(); ?>

<div class="post-container">

</div> <!-- .post-container -->
