<form action="<?= get_url("/newpost?{$get_key}={$get_value}"); ?>" method="POST" enctype="multipart/form-data" class="new-post-form">

    <textarea name="post_text" id="post-text" cols="30" rows="10" required placeholder="Seu texto aqui..." class="textarea post-text"></textarea> <!-- .textarea .post-text -->

    <input type="file" name="post_image" id="board-image" required accept="image/*" class="post-image"> <!-- .post-image -->

    <button type="submit" class="btn btn-green btn-create-post">Criar tópico</button> <!-- .btn .btn-green .btn-create-post -->
</form> <!-- .new-post-form -->
