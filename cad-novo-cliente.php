<?php
session_start();
include_once 'includes/mysql.php';
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#clEndereco").val("");
                $("#clBairro").val("");
                $("#clCidade").val("");
                $("#clUF").val("");
            }

            //Quando o campo cep perde o foco.
            $("#clCEP").blur(function () {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#clEndereco").val("...");
                        $("#clBairro").val("...");
                        $("#clCidade").val("...");
                        $("#clUF").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (
                            dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#clEndereco").val(dados.logradouro);
                                $("#clBairro").val(dados.bairro);
                                $("#clCidade").val(dados.localidade);
                                $("#clUF").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
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
                <i class="fa fa-group mx-2" aria-hidden="true"></i>CADASTRO DE CLIENTES
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="includes/valida-cad-cliente.php" method="POST" role="form">
                    <div class="form-group row">
                        <label for="clCNPJ" class="col-sm-2 col-form-label">CPF / CNPJ <strong>*</strong></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="clCNPJ" id="clCNPJ">
                        </div>
                        <label for="clIE" class="col-sm-1 col-form-label">RG / I.E <strong>*</strong></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="clIE" id="clIE">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clRazao" class="col-sm-2 col-form-label">Razão Social</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="clRazao" id="clRazao">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clFantasia" class="col-sm-2 col-form-label">Nome Fantasia</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="clFantasia" id="clFantasia">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clNome" class="col-sm-2 col-form-label">Nome Responsável <strong>*</strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="clNome" id="clNome">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clEmail" class="col-sm-2 col-form-label">E-mail <strong>*</strong></label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="clEmail" id="clEmail">
                        </div>
                        <label for="clTelefone" class="col-sm-1 col-form-label">Fone <strong>*</strong></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="clTelefone" id="clTelefone">
                        </div>
                        <label for="clRamal" class="col-sm-1 col-form-label">Ramal</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="clRamal" id="clRamal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clCEP" class="col-sm-2 col-form-label">CEP <strong>*</strong></label>
                        <div class="col-sm-2">
                            <input type="text" value="" class="form-control" name="clCEP" id="clCEP">
                        </div>
                        <label for="clEndereco" class="col-sm-1 col-form-label">Endereço</label>
                        <div class="col-sm-5">
                            <input type="text" value="" class="form-control" name="clEndereco" id="clEndereco">
                        </div>
                        <label for="clEndNum" class="col-sm-1 col-form-label">Número</label>
                        <div class="col-sm-1">
                            <input type="text" value="" class="form-control" name="clEndNum" id="clEndNum">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clEndComp" class="col-sm-2 col-form-label">Complemento</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="clEndComp" id="clEndComp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clBairro" class="col-sm-2 col-form-label">Bairro</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="clBairro" id="clBairro">
                        </div>
                        <label for="clCidade" class="col-sm-1 col-form-label">Cidade</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="clCidade" id="clCidade">
                        </div>
                        <label for="clUF" class="col-sm-1 col-form-label">UF</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="clUF" id="clUF">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <button type="submit" id="enviar-cad-cliente" name="enviar-cad-cliente" class="btn mt-3 col-sm-6 btn-info btn-lg">ENVIAR CADASTRO</button>
                    </div>
                </form>
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