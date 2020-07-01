<?php
session_start();
include_once 'mysql.php';

if(isset($_POST['enviar-cad-cliente'])){
    $clCNPJ = $_POST['clCNPJ'];
    $clIE = $_POST['clIE'];
    $clRazao = $_POST['clRazao'];
    $clFantasia = $_POST['clFantasia'];
    $clNome = $_POST['clNome'];
    $clEmail = $_POST['clEmail'];
    $clTelefone = $_POST['clTelefone'];
    $clRamal = $_POST['clRamal'];
    $clCEP = $_POST['clCEP'];
    $clEndereco = $_POST['clEndereco'];
    $clEndNum = $_POST['clEndNum'];
    $clEndComp = $_POST['clEndComp'];
    $clBairro = $_POST['clBairro'];
    $clCidade = $_POST['clCidade'];
    $clUF = $_POST['clUF'];
    $clDataCad = date('Y-m-d');
    $clAtivo = "S";

    // Protect from injection
$clCNPJ = mysqli_real_escape_string($conn, $clCNPJ);

// Check database to see if email is already subscribed

$sql="SELECT clId FROM tbclientes WHERE clCNPJ='$clCNPJ'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

if($result->num_rows === 1)
{
$_SESSION['Alert1'] =  "Empresa já Cadastrada!";
header("Location: ../cad-novo-cliente.php");
}else{
$sql = "INSERT INTO tbclientes (clId, clCNPJ, clIE, clRazao, clFantasia, clNome, clEmail, clTelefone, clRamal, clCEP, clEndereco, clEndNum, clEndComp, clBairro, clCidade, clUF, clDataCad, clAtivo)
VALUES (NULL, '$clCNPJ', '$clIE', '$clRazao', '$clFantasia', '$clNome', '$clEmail', '$clTelefone', '$clRamal', '$clCEP', '$clEndereco', '$clEndNum', '$clEndComp', '$clBairro', '$clCidade', '$clUF', '$clDataCad', '$clAtivo')";

if (mysqli_query($conn, $sql) === TRUE) {
    $_SESSION['Alert2'] = "Empresa Cadastrada com Sucesso!";
    header("Location: ../cad-novo-cliente.php");
} else {
    $_SESSION['Alert3'] = "Erro ao inserir registro no banco de dados <br> ERRO: " . $sql . "<br>" . mysqli_error($conn);
    header("Location: ../cad-novo-cliente.php");
}

$conn->close();  
}
}

?>