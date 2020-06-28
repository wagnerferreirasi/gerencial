<?php 
session_start();
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
    <div class="card card-login border-0 shadow text-center">
        <img class="card-img-top" src="assets/logo-horizontal.png" alt="logo Ferreira S.I">
        <div class="card-body">
        <?php
        if(isset($_SESSION['erros'])):
        ?>
        <div class="alert alert-danger small alert-dismissible fade show" role="alert">
            <strong>ERROR:</strong> <?php echo $_SESSION['erros']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php 
        endif;
        unset($_SESSION['erros']);
        ?>
            <form method="POST" action="includes/processaLogin.php">
                <div class="form-group text-left">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
                </div>
                <div class="form-group text-left">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" name="btn-login" class="btn btn-info mt-4 mb-4">Entrar</button>
            </form>
        </div>
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>