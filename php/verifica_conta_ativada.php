<?php
$data = json_decode(file_get_contents("php://input"));

 // Verifica se o login foi enviado na requisição
if (isset($data->email) && isset($data->senha)) {
    $email = $data->email;
    include "conexao.php";

    // Consulta SQL para verificar se o login existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($con, $sql);

    $usuario = $resultado->fetch_assoc();

    if($usuario['conta_ativada'] == 1){
        $contaAtivada = true;
    } else {
        $contaAtivada = false;
    }
   
    
    echo json_encode(["contaAtivada" => $contaAtivada]);
}
?>