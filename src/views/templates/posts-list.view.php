<ul class="posts-list">

    <?php foreach ($posts as $post) : ?>

        <li class="post">

            <?php if ($post->post_image): ?>

                <img src="<?= get_url("/assets/images/posts-images/" . $post->post_image); ?>" alt="post-image" class="post-image"> <!-- .post-image -->
            <?php endif; ?>

            <div class="post-info">

                <h3 class="post-owner">&#10551; <a href="<?= get_url("/post?owner=" . $post->post_owner); ?>" target="_blank">Ir para o post.</a></h3> <!-- .post-owner -->

                <p class="post-created-at">Criado em: <?= $post->post_created_at; ?></p> <!-- .post-created-at -->
                <p class="post-text"><?= limit_words($post->post_text, 100); ?></p> <!-- .post-text -->
            </div> <!-- .post-info -->
        </li> <!-- .post -->
    <?php endforeach; ?>
</ul> <!-- .posts-list -->
