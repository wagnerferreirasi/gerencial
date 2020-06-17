<?php
//seta os dados da conexao
$host		="localhost";
$user		="root";
$pass		="root";
$db			="dbgerencial";

//executa a conexao
$conn = mysqli_connect($host, $user, $pass, $db) or trigger_error(mysqli_error($conn),E_USER_ERROR);
mysqli_set_charset($conn, "utf8");