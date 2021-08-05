<?php

require_once "Conexao.php";

class Controller{
    
    public function cadastro($nome, $email, $senha, $senhaConf){

        try{
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":email", $email);

            $stmt->execute();

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($dados) > 0) {
                setcookie('data_verification', 'E-mail já cadastrado.', time()+5);
                header('location: Cadastro.php');
            } else { 
                    $senha = password_hash($senha, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (name,email,password) VALUES (?,?,?)";
                    $stmt = Conexao::getConexao()->prepare($sql);
                    $stmt->bindValue(1, $nome);
                    $stmt->bindValue(2, $email);
                    $stmt->bindValue(3, $senha);

                    $stmt->execute();
                    setcookie('data_verification', 'Cadastro realizado com sucesso. Faça login!', time()+5);
                    header('location: Index.php');
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function logar($email, $senha){
        try{
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute([$email]);

            if($stmt->rowCount() == 1){
                $dataFull = $stmt->fetch();
    
                if(password_verify($senha, $dataFull['password'])){
                    session_start();
                    $_SESSION['id'] = $dataFull['id'];
                    $_SESSION['nome'] = $dataFull['name'];
                    $_SESSION['email'] = $dataFull['email'];

                    header("location: PaginaPrivada.php");

                } else {
                    setcookie('data_verification', 'Senha incorreta. Tente novamente!', time()+5);
                    header('location: Index.php');
                }
            } else { 
                setcookie('data_verification', 'E-mail incorreto. Tente novamente!', time()+5);
                header('location: Index.php');
            }
        }catch(PDOException $e){
            //echo $e->getMessage();
            setcookie('data_verification', 'Algo deu errado. Tente novamente!', time()+5);
            header('location: Index.php');
        }
        
    }
}
