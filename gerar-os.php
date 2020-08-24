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
<?php


?>
<div class="container">
    <div class="row my-5">
        <div class="col-sm-12 h1 text-center my-5 text-info">
            <i class="fa fa-file-text mx-2" aria-hidden="true"></i>GERAR O.S
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
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
                <form action="includes/cad-nova-os.php" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="selCLiente">CLIENTE</label>
                            <select class="custom-select" name="selCLiente" id="selCLiente">
                                <option selected>Selecione um Cliente</option>
                                <?php 
                                    $sql = "SELECT * FROM tbclientes WHERE clAtivo = 'S'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) == 0):
                                ?>
                                <option value="">NENHUM CLIENTE ENCONTRADO</option>
                                <?php
                                    else:
                                        while ($dados = mysqli_fetch_assoc($result)):
                                        $idCliente = $dados['clId'];
                                        $razaoSocial = $dados['clRazao'];
                                ?>
                                <option value="<?php echo $idCliente; ?>"><?php echo strtoupper($razaoSocial); ?></option>
                                <?php
                                        endwhile;
                                        $dados++;
                                    endif;
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="dataOS">DATA</label>
                            <div class="col-sm-1-6">
                                <input type="date" class="form-control" name="dataOS" id="dataOS" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p class="ml-3">SELECIONE OS SERVIÇOS REALIZADOS <a class="btn btn-info btn-sm" href="http://" role="button target="_blank">Novo</a></p>
                        <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <?php 
                                    $sql = "SELECT * FROM tbservicos WHERE sevAtivo = 'S'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) == 0):
                                ?>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="service" id="service" value="NULL"> NENHUM SERVIÇO DISPONÍVEL
                                </label>
                                <?php
                                    else:
                                        while ($dados = mysqli_fetch_assoc($result)):
                                        $sevId = $dados['sevId'];
                                        $sevTitulo = $dados['sevTitulo'];
                                ?>
                                <label class="form-check-label ml-3">
                                    <input class="form-check-input" type="checkbox" name="service[]" id="service[]" value="<?php echo $sevId; ?>"> <?php echo $sevTitulo; ?>
                                </label>
                                <?php
                                        endwhile;
                                        $dados++;
                                    endif;
                                    $conn->close(); 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="infoADC">INFORMAÇÕES ADICIONAIS</label>
                                <textarea class="form-control" name="infoADC" id="infoADC" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <input name="gerar-os" id="gerar-os" class="btn btn-lg btn-info" type="submit" value="GERAR">
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>