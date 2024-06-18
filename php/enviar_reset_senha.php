<?php

    $email = $_POST["email"];

    $token = bin2hex(random_bytes(16));

    $token_hash = hash("sha256", $token);

    include "conexao.php";

    mysqli_query($con, "UPDATE usuarios
                        SET reset_token_hash = '$token_hash'
                        WHERE email = '$email'");

    if ($con->affected_rows) {
        
        $mail = include("config_email.php");

        $mail->setFrom("projetoindependentden@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Recuperacao de Senha";
        $mail->Body = <<<END

        Clique <a href="http://localhost/theindependentden-master2/php/novasenha.php?token=$token">aqui</a>
        para resetar sua senha

        END;

        try{
            $mail->send();
        } catch (Exception $e){
            echo "Erro ao enviar email: {$mail->ErrorInfo}";
        }


    }

    echo "Mensagem enviada"

?>