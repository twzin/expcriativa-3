<?php
session_start();

    // use Infobip\Configuration;
    // use Infobip\Api\SmsApi;
    // use Infobip\Model\SmsDestination;
    // use Infobip\Model\SmsTextualMessage;
    // use Infobip\Model\SmsAdvancedTextualRequest;


$data = json_decode(file_get_contents("php://input"));

//  // Verifica se o login foi enviado na requisição
if (isset($data->email) && isset($data->chave) && ($data->senha) && ($data->iv)) {
    $emailcr = $data->email;
    $chaveAEScr = $data->chave;
    $senha = $data->senha;
    $iv64 = $data->iv;
    $iv = base64_decode($iv64);
    
    $chavePriv = "openssl/privada.pem";

    $chaveAES = "";

    openssl_private_decrypt(base64_decode($chaveAEScr), $chaveAES, file_get_contents($chavePriv), OPENSSL_PKCS1_PADDING);

    $email = openssl_decrypt($emailcr, 'AES-256-CBC', $chaveAES, OPENSSL_RAW_DATA, $iv);
    // $usuario = openssl_decrypt($usuarioCriptografado, 'AES-256-CBC', $chaveAES, OPENSSL_ZERO_PADDING, $ivString);
    // $senha = openssl_decrypt($senhacr, 'AES-256-CBC', $chaveAES, OPENSSL_ZERO_PADDING, $ivString);

//     include "conexao.php";

//     // // Consulta SQL para verificar se o login existe
//     // $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
//     // $resultado = mysqli_query($con, $sql);

//     // $usuario = $resultado->fetch_assoc();

//     // $verificaAtivacao = "SELECT * FROM usuarios WHERE email = '$email' and conta_ativada = '1'";
//     // $resultado2 = mysqli_query($con, $verificaAtivacao);

//     // Consulta SQL para verificar se o login existe
//     $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
//     $stmt = mysqli_prepare($con, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
//     mysqli_stmt_execute($stmt);
//     $resultado = mysqli_stmt_get_result($stmt);

//     $usuario = $resultado->fetch_assoc();

//     // Consulta para verificar se a conta está ativada
//     $verificaAtivacao = "SELECT * FROM usuarios WHERE email = ? AND conta_ativada = '1'";
//     $stmt2 = mysqli_prepare($con, $verificaAtivacao);
//     mysqli_stmt_bind_param($stmt2, "s", $email);
//     mysqli_stmt_execute($stmt2);
//     $resultado2 = mysqli_stmt_get_result($stmt2);

    
//     // Se a consulta retornar algum resultado, manda o login
//     $loginExiste = $resultado->num_rows > 0;   
//     $contaAtivada = $resultado2->num_rows > 0;
    
//     if ($loginExiste && $contaAtivada) {
//         // Inicia a sessão e armazena o email do usuário na sessão
//         $_SESSION['email'] = $email;
//         $_SESSION['senha'] = $senha;

//         $telefone = "+55" . formatarTelefone($usuario['telefone']);

//         $codigo = '';
    
//         for ($i = 0; $i < 5; $i++){
//             $codigo .= rand(0, 9);
//         }
    
//         // cadastra o código de 2FA no banco
//         $codigoSMS = "UPDATE usuarios SET codigoSMS = ? WHERE email = '$email'";
//         $stmt3 = mysqli_prepare($con, $codigoSMS);
//         mysqli_stmt_bind_param($stmt3, "s", $codigo);
//         mysqli_stmt_execute($stmt3);
//         $resultado3 = mysqli_stmt_get_result($stmt3);
    
//         enviarSMS($telefone, $codigo);
//     }

//     $response = [
//         "loginExiste" => $loginExiste,
//         "contaAtivada" => $contaAtivada
//         // "codigo" => $codigo
//         // "telefone" => $telefone
//     ];
    

//     // if ($resultado2->num_rows > 0){
//         //     echo json_encode($response);
//         // } else {
//             //     echo json_encode(["loginExiste" => $loginExiste]);
//             // }
            
//     echo json_encode($response);
// }
        
// function formatarTelefone($telefone) {
//     // Remove parênteses e espaços do telefone
//     $telefoneFormatado = str_replace(array("(", ")", " ", "-"), "", $telefone);
//     return $telefoneFormatado;
// }

// function enviarSMS($telefone, $codigo){
    
//     require_once("api.php");
//     require_once("GeraSenha.php");
//     require_once("vendor/vendor.php");
//     require __DIR__ . "/vendor/autoload.php";
    
//     $base_url = "xlz6xl.api.infobip.com";
//     $api_key = $doido;

//     $configuration = new Configuration(host: $base_url, apiKey: $api_key);

//     $api = new SmsApi(config: $configuration);

//     $destination = new SmsDestination(to: $telefone);

//     $message = new SmsTextualMessage(
//         destinations: [$destination],
//         text: $codigo,
//         from: "indie"
//     );

//     $request = new SmsAdvancedTextualRequest(messages: [$message]);

//     $response = $api->sendSmsMessage($request);

}
?>
