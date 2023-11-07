<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Importing fonts (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Importing styles files -->
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/reset.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/imports/colors.css"); ?>">
    <link rel="stylesheet" href="<?= get_url("/assets/styles/style.css"); ?>">
    <?= $this->section("styles"); ?>

    <!-- Setting up favicon -->
    <link rel="shortcut icon" href="<?= get_url("/favicon.ico"); ?>" type="image/x-icon">

    <title>Zooei - <?= $this->e($title); ?></title>
</head>

<body>
    <?= $this->section("content"); ?>

    <!-- Importing scripts files -->
    <script src="<?= get_url("/assets/js/jQuery/jquery-3.7.1.js"); ?>"></script>
    <script src="<?= get_url("/assets/js/index.js"); ?>"></script>
    <?= $this->section("scripts"); ?>
</body>

</html>
