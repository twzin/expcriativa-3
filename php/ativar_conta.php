<?php

    $token = $_GET["token"];

    $token_hash = hash("sha256", $token);

    include "conexao.php";

    $result = mysqli_query($con, "SELECT * FROM usuarios WHERE conta_ativada = '$token_hash'");

    $user = $result->fetch_assoc();

    if ($user === null) {
        die("token not found");
    }

    $id =  $user["idusuarios"];

    mysqli_query($con, "UPDATE usuarios SET conta_ativada = 1
                        WHERE idusuarios = '$id'");

?>


<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <title>Cadastro e Login</title>
</head>
<body>
    <div class="background">
        <div class ="form-geral">
            <div>
                <form>
                    <h1>Conta Ativada!</h1>
                    <h2>Faça <a href="http://localhost/theindependentden-master2/login.html">login</a></h2>
                </form>
            </div>
    </div>
</body>
</html>