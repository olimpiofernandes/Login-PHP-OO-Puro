<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Olímpio Fernandes">
    <title>Sistema de Cadastro e Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div id="corpo-center">

        <h1>Login</h1>

    <?php
        require_once "Controller.php";

        if( isset($_POST['btn-entrar']) ){

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            if (empty($email) && empty($senha)) {
                setcookie('data_verification', 'Preencha todos os campos!', time()+5);
            }

            $logar = new Controller();
            $logar-> logar($email,$senha);
        }
    ?>
    <?php
        if(isset($_COOKIE['data_verification'])){
            echo '<label class="font-alerts">'. $_COOKIE['data_verification'] .'</label><br/>' ;
        }
    ?>

    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required="">
        <input type="password" name="senha" placeholder="Senha" required="">
        <button type="submit" name="btn-entrar"> Entrar </button>
        <a href="cadastro.php"> Ainda não e inscrito ? <strong>Cadastre-se agora!!</strong> </a>
    </form>
    </div>
</body>

</html>