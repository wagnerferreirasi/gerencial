<?php
session_start();
include_once 'mysql.php';

if(isset($_POST['gerar-os'])){
    
    $idCliente = $_POST['selCLiente'];
    $dataOS = $_POST['dataOS'];
    $listaCheckbox = $_POST['service'];
    $valores = implode(",", $listaCheckbox);
    $valores = $valores;
    $dataCadOS = date('Y-m-d H:i:s');
    $infoADC = $_POST['infoADC'];

    # formata os dados para fornar o numero da OS
    $nID = str_pad($idCliente, 5, "0", STR_PAD_LEFT);
    $dataNOS = explode("-", $dataOS);
    $nOS = implode("", $dataNOS);

    $numOS = "FE".$nOS."-".$nID;

    $sql = "INSERT INTO tbos (osId, osNumero, cliId, osData, osServicos, osInfo, osCadData) VALUES (NULL, '$numOS', '$idCliente', '$dataOS', '$valores', '$infoADC', '$dataCadOS')";

    echo $sql;


} else {
    $_SESSION['erros'] = "O.S não Gerada, revide os dados!";
    header('location: ../gerar-os.php');
}