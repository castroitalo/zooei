<!-- Inherits base HTML  -->
<?php $this->layout("/../template/base.view", ["title" => "Regras"]); ?>

<!-- Importing styles -->
<?php $this->start("styles"); ?>
<link rel="stylesheet" href="<?= get_url("/assets/styles/components/rules.view.css"); ?>">
<?php $this->stop(); ?>

<div class="rules-container">

    <header class="rules-header">
        <h2 class="rules-header-title">Regras</h2> <!-- .rules-header-title -->
    </header> <!-- .rules-header -->

    <ol class="rules-list">
        <li class="rule">0 - Ter mais de 18 anos. Este site contém material orientado para adultos e cujo conteúdo é inapropriado para menores de idade.</li> <!-- .rule -->
        <li class="rule">1 - Você não vai postar ou pedir nenhuma informação pessoal sobre ninguém.</li> <!-- .rule -->
        <li class="rule">2 - Qualquer conteúdo não seguro para o trabalho (NSFW) será removido pela administração e o usuário será temporariamente banido.</li> <!-- .rule -->
        <li class="rule">3 - Você não vai postar, discutir, pedir ou fornecer nada que viole qualquer lei brasileira.</li> <!-- .rule -->
        <li class="rule">4 - Tentar burlar um ban temporário resultará em um banimento permanente.</li> <!-- .rule -->
        <li class="rule">5 - Spam resultará em banimento temporário.</li> <!-- .rule -->
        <li class="rule">6 - Todo conteúdo postado deve ser realacionado com o quadro usado para divulgação do mesmo.</li> <!-- .rule -->
    </ol> <!-- .rules-list -->
</div> <!-- .rules-container -->
