<?php
session_start();

if (isset($_POST['btn-login'])) {
    require_once 'mysql.php';
    $email = mysqli_escape_string($conn, $_POST['email']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
    
    if(empty($email) or empty($senha)):
        header('location: ../index.php');
        $_SESSION['erros'] = "Preencha seu Login e Senha!";
    else:
        $sql = "SELECT usuLogin FROM tbusuarios WHERE usuLogin = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0):
            $sql = "SELECT * FROM tbusuarios WHERE usuLogin = '$email' AND usuSenha = '$senha'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 1):
                $dados = mysqli_fetch_assoc($result);
                $_SESSION['logado'] = true;
                $_SESSION['usuId'] = $dados['usuId'];
                $_SESSION['usuNome'] = $dados['usuNome'];
                $_SESSION['usuEmail'] = $dados['usuLogin'];
                header('location: ../main.php');
            else:
                header('location: ../index.php');
                $_SESSION['erros'] = "Usuário e Senha não conferem!";
            endif;
        else:
            header('location: ../index.php');
            $_SESSION['erros'] = "Login não encontrato!";
        endif;
    endif;
} 
else {
    header('location: ../index.php');
    $_SESSION['erros'] = "Faça login novamente!";
}
$conn->close();  
?>