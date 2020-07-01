<?php
session_start();
include_once('includes/mysql.php');
?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Gerencial Ferreira S.I - Controle de Cliente e Cobranças</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="style/css/style.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>

<body class="bg-light">
    <?php include_once('nav-bar.php'); ?>
    <?php if(isset($_SESSION['usuNome'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $_SESSION['usuNome']; ?></strong> - Bem vindo ao Gerencial da Ferreira S.I
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>