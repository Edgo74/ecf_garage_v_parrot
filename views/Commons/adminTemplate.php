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
    <link rel="stylesheet" href="<?= URL ?>public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL ?>public/CSS/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php if (!empty($page_css)) : ?>
        <link rel="stylesheet" href="<?= URL ?>public/CSS/<?= $page_css ?>">
    <?php endif; ?>
</head>

<body class="sb-nav-fixed">
    <?= $page_content ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <?php if (!empty($page_javascript)) : ?>
        <script src="<?= URL ?>public/bootstrap/js/bootstrap.js"></script>
        <script src="<?= URL ?>public/JavaScript/<?= $page_javascript ?>"></script>
    <?php endif; ?>
</body>

</html>