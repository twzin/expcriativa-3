<?php

// $token_ativacao = bin2hex(random_bytes(16));
// $token_ativacao_hash = hash("sha256", $token_ativacao);

$emailCriptografado = $_POST["email"];
$usuarioCriptografado = $_POST["usuario"];
$telefoneCriptografado = $_POST['telefone'];
$senhacr = $_POST["senha"];
$chaveAEScr = $_POST["chaveAES"];
$IV64 = $_POST["IV"];

$iv = base64_decode($IV64);

$AESDecode64 = base64_decode($chaveAEScr);
$chavePriv = openssl_pkey_get_private("file://openssl/privada.pem");

$decrypted = "";
openssl_private_decrypt($AESDecode64, $decrypted, $chavePriv);
$chaveAES = base64_decode($decrypted);

$email = openssl_decrypt($emailCriptografado, 'aes-256-cbc', $chaveAES, OPENSSL_RAW_DATA, $iv);
// $usuario = openssl_decrypt($usuarioCriptografado, 'AES-256-CBC', $chaveAES, OPENSSL_ZERO_PADDING, $ivString);
// $senha = openssl_decrypt($senhacr, 'AES-256-CBC', $chaveAES, OPENSSL_ZERO_PADDING, $ivString);

// $codigoTemp = '1';

// include "conexao.php";

// mysqli_query($con, "INSERT INTO usuarios(email, usuario, senha, conta_ativada)
//                     VALUES ('$email', '$usuario', '$senha', '$token_ativacao_hash')");

// Usando prepared statement para inserir os dados no banco de dados
// $stmt = $con->prepare("INSERT INTO usuarios(email, usuario, telefone, senha, conta_ativada, codigoSMS) VALUES (?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("ssssss", $email, $usuario, $telefone, $senha, $token_ativacao_hash, $codigoTemp);
// $stmt->execute();
// $stmt->close();

// if ($con->affected_rows) {
    
//     $mail = include("config_email.php");

//     $mail->setFrom("projetoindependentden@gmail.com");
//     $mail->addAddress($_POST["email"]);
//     $mail->Subject = "Ativacao de conta";
//     $mail->Body = <<<END

//     Clique <a href="http://localhost/theindependentden-master2/php/ativar_conta.php?token=$token_ativacao">aqui</a>
//     para ativar sua conta.

//     END;

//     try{
//         $mail->send();
//     } catch (Exception $e){
//         echo "Erro ao enviar email: {$mail->ErrorInfo}";
//     }
// }
?>
