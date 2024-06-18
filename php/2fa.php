<?php
    session_start();

    $data = json_decode(file_get_contents("php://input"));

    // Verifica se o login foi enviado na requisição
   if (isset($data->codigo)) {
       $codigo = $data->codigo;

       include "conexao.php";

        $verificaAtivacao = "SELECT * FROM usuarios WHERE codigoSMS = ?";
        $stmt = mysqli_prepare($con, $verificaAtivacao);
        mysqli_stmt_bind_param($stmt, "s", $codigo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $codigoExiste = $resultado->num_rows > 0;

        $usuario = $resultado->fetch_assoc();

        if ($resultado->num_rows < 1) {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
        }
           
        echo json_encode(["codigoExiste" => $codigoExiste]);

        $email = $usuario['email'];

        mysqli_query($con, "UPDATE usuarios SET codigoSMS = 1
        WHERE email = '$email'");
        
}

?>