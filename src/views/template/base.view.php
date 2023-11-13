<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Importing fonts (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Importing styles files -->
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/reset.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/colors.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/buttons.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/display.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/input.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/style.css"); ?>">
    <?= $this->section("styles"); ?>

    <!-- Setting up favicon -->
    <link rel="shortcut icon" href="<?= get_url("/favicon.ico"); ?>" type="image/x-icon">

    <title>Zooei - <?= $this->e($title); ?></title>
</head>

<body class="body">

    <div class="main">

        <header class="header">

            <img src="<?= get_url("/assets/images/icon.png"); ?>" alt="www.zooei.com.br" class="header-icon"> <!-- .header-icon -->

            <br>

            <a href="<?= get_url("/"); ?>">

                <img src="<?= get_url("/assets/images/logo.png"); ?>" alt="www.zooei.com.br" class="header-logo"> <!-- .header-logo -->
            </a>
        </header> <!-- .header -->

        <section class="content">

            <?= $this->section("content"); ?>
        </section> <!-- .content -->
    </div> <!-- .main -->

    <!-- Importing scripts files -->
    <script src="<?= get_url("/assets/js/jQuery/jquery-3.7.1.js"); ?>"></script>
    <?= $this->section("scripts"); ?>
</body> <!-- .body -->

</html>
