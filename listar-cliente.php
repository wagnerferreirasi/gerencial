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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $("#filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#listaCliente tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</head>

<body class="bg-light">
<?php include_once('nav-bar.php'); ?>

<div class="container">
    <div class="row my-5">
        <?php if(isset($_SESSION['Alert1'])){ ?>
        <div class="alert col-sm-12 alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Alert1']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } 
        unset($_SESSION['Alert1']);?>
        <?php if(isset($_SESSION['Alert2'])){ ?>
        <div class="alert col-sm-12 alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Alert2']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } 
        unset($_SESSION['Alert2']);?>
        <?php if(isset($_SESSION['Alert3'])){ ?>
        <div class="alert col-sm-12 alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['Alert3']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } 
        unset($_SESSION['Alert3']);?>
        <div class="col-sm-12 h1 text-center my-5 text-info">
            <i class="fa fa-search mx-2" aria-hidden="true"></i>LISTA DE CLIENTES
        </div>
    </div>
    <div class="row mb-3 text-info">
        <form class="form-inline">
            <div class="form-group col-sm-12">
                <label for="filter" class="lead mr-3"><i class="fa fa-search mr-2" aria-hidden="true"></i><strong>BUSCAR CLIENTE:</strong></label>
                <input type="text" name="filter" id="filter" class="col-sm-12 form-control" placeholder="Nome / Razão Social / CPF / CNPJ">
            </div>
        </form>
    </div>
    <div class="row">
        
        <table class="table table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>CPF / CNPJ</th>
                    <th class="text-center">EDITAR</th>
                    <th class="text-center">DELETAR</th>
                </tr>
            </thead>
            <tbody id="listaCliente">
                <?php
                    $sql = "SELECT * FROM tbclientes ORDER BY clId DESC";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) == 0):
                ?>
                <div class="alert col-sm-12 alert-danger alert-dismissible fade show" role="alert">
                    SEM REGISTROS NO SISTEMA
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                    else:
                        while ($dados = mysqli_fetch_assoc($result)):
                            $idCliente = $dados['clId'];
                            $razaoSocial = $dados['clRazao'];
                            $cpfCNPJ = $dados['clCNPJ'];
                            $responsavel = $dados['clNome'];
                ?>
                <tr>
                    <td scope="row"><strong><?php echo $idCliente; ?></strong></td>
                    <td><?php echo strtoupper($razaoSocial); ?></td>
                    <td><?php echo $cpfCNPJ; ?></td>
                    <td class="text-center text-info"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i>
</td>
                    <td class="text-center text-info"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></td>
                </tr>
                <?php 
                        endwhile;
                        $dados++;
                    endif;
                    $conn->close();  
                ?>
            </tbody>
        </table>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>