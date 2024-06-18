<?php

    $token = $_GET["token"];

    $token_hash = hash("sha256", $token);

    include 'conexao.php';

    $result = mysqli_query($con, "SELECT * FROM usuarios
            WHERE reset_token_hash = '$token_hash'");

    $user = $result->fetch_assoc();

    if ($user === null) {
        die("token nao encontrado");
    }

?>


<html>
   <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="../js/index.js"></script>
    <title>Nova Senha</title>
   </head> 
   <body>
    <div class ="background">

        <div class="form-geral">
            <!-- <form id="formNovaSenha"> -->
                <form method="post" action="reset-senha.php">
                <h1>Cadastrar nova senha</h1>
                <input type="hidden" name="token" value="<?=htmlspecialchars($token) ?>">
                <div>
                    <label for="senha">Nova senha</label>
                    <input type="password" name="nova_senha" id="nova_senha" placeholder="Senha">   
                </div>
                <div>
                    <label for="senha">Repita senha</label>
                    <input type="password" placeholder="Senha">   
                </div>
                <h2></h2>
                <button>Recuperar</button>
                <!-- <button type="submit" onclick="novaSenha()">Cadastrar</button> -->
            </form>
        </div>        
   </body>
</html>