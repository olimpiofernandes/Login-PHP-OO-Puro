<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Olímpio Fernandes">
    <title>Sistema de Cadastro e Login</title>
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>
    <div id="corpo-center" style="margin-top: 8vh;">

        <h1> Cadastro</h1>

        <?php
            require_once "Controller.php";

            if( isset($_POST['btn-cadastrar']) ){
                
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];

                if (empty($nome) || empty($email) || empty($senha)) {
                    setcookie('data_verification', 'Preencha todos os campos!', time()+5);
                }
                $cadastrar = new Controller();
                $cadastrar-> cadastro($nome,$email,$senha,$senhaConf);
            }else{
                
            }
            
        ?>
        <?php
            if(isset($_COOKIE['data_verification'])){
                echo '<label class="font-alerts">'. $_COOKIE['data_verification'] .'</label><br/>' ;
            }
        ?>
        <form action="" method="post">
            <input type="text" name="nome" placeholder="Nome" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="senha" placeholder="Senha" required="">
            <button type="submit" name="btn-cadastrar"> Cadastrar </button>
            <a href="index.php"> Já possuo conta. <strong> Entrar.</strong></a>
        </form>
    </div>
</body>

</html>