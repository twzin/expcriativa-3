<?php

    $token = $_POST["token"];
    $token_hash = hash("sha256", $token);

    include ("conexao.php");

    $result = mysqli_query($con, "SELECT * FROM usuarios
            WHERE reset_token_hash = '$token_hash'");

    $user = $result->fetch_assoc();

    if ($user === null) {
        die("token nao encontrado");
    }

    $senha = $_POST["nova_senha"];
    $id = $user["idusuarios"];

    $senhaHash = md5($senha);

    $stmt = mysqli_query($con, "UPDATE usuarios SET senha = '$senhaHash',
                reset_token_hash = 1
            WHERE idusuarios = '$id'");

    echo "Senha trocada com sucesso!";
?>