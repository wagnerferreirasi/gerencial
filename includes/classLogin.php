<?php
session_start();

require_once 'mysql.php';

class Login{
    private $email;
    private $senha;

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($e){
        $email =  filter_var($e, FILTER_SANITIZE_EMAIL);
        $this->email = $email;
    }
    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($s){
        $this->senha = $s;
    }

    public function Logar(){
        if($this->email == "wagner@ferreirasi.tk" and $this->senha == "123456"):
            echo "Logado com sucesso!";
        else:
            echo "Dados inválidos!";
        endif;
    }
}

$logar = new login();
$logar->setEmail("wagner@ferreirasi.tk");
$logar->setSenha("123456");
$logar->logar();

echo "<BR>";
echo $logar->getEmail();

?>