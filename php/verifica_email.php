<?php
 $data = json_decode(file_get_contents("php://input"));

 // Verifica se o email foi enviado na requisição
if (isset($data->email) && isset($data->telefone)) {
    $email = $data->email;
    $telefone = $data->telefone;

    // $chavePriv = "rsa_1024_priv.pem";

    // $email = "";
    // $telefone = "";

    // openssl_private_decrypt(base64_decode($emailcr), $email, file_get_contents($chavePriv), OPENSSL_PKCS1_PADDING);
    // openssl_private_decrypt(base64_decode($telefonecr), $telefone, file_get_contents($chavePriv), OPENSSL_PKCS1_PADDING);

    include "conexao.php";

    // Consulta SQL para verificar se o email já está cadastrado
    $sql = "SELECT email FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($con, $sql);

    $sql2 = "SELECT email FROM usuarios WHERE telefone = '$telefone'";
    $resultado2 = mysqli_query($con, $sql2);

    // Se a consulta retornar algum resultado, o email já2 está cadastrado
    $emailExists = $resultado->num_rows > 0;
    $telefoneExists = $resultado2->num_rows > 0;

    $response= [
        "emailExists" => $emailExists,
        "telefoneExists" => $telefoneExists
    ];

    // Retorna a resposta em formato JSON
    // header('Content-Type: application/json');
    echo json_encode($response);

}
?>