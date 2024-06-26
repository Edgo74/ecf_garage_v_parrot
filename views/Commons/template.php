<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description ?>">
    <?php if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    ?>
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>" />
    <title><?= $page_title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />
    <link rel="stylesheet" href="<?= URL ?>public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL ?>public/CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php if (!empty($page_css)) : ?>
        <link rel="stylesheet" href="<?= URL ?>public/CSS/<?= $page_css ?>">
    <?php endif; ?>
</head>

<body class="d-flex flex-column vh-100">
    <?php require("views/Commons/header.php") ?>

    <?php
    if (!empty($_SESSION['alert'])) {
        echo "<div id = 'alert-container'class='container'>";
        foreach ($_SESSION['alert'] as $alert) {
            echo "<div id = 'cross' class='alert alert-fixed d-flex justify-content-between align-items-center " . $alert['type'] . "' role='alert'>
                " . $alert['message'] . "<i id = 'crossicon'class='fas fa-times'></i>" . "
              </div>";
        }
        echo "</div>";
        unset($_SESSION['alert']);
    }
    ?>

    <?= $page_content ?>
    <?php require("views/Commons/footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/bootstrap/js/bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="<?= URL ?>public/JavaScript/main.js"></script>
    <?php if (!empty($page_javascript)) : ?>
        <?php foreach ($page_javascript as $fichier_javascript) : ?>
            <script src="<?= URL ?>public/JavaScript/<?= $fichier_javascript ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- 100% privacy-first analytics -->
    <script async defer src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
    <noscript><img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" /></noscript>
</body>

</html>