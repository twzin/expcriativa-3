<?php
$certificadoPath = 'openssl/certificado.crt';


if (file_exists($certificadoPath)) {
    $certificadoConteudo = file_get_contents($certificadoPath);

    $certificadoBase64 = base64_encode($certificadoConteudo);

    $dadosCertificado = [
        'conteudoBase64' => $certificadoBase64
    ];

    // header('Content-Type: application/json');
    echo json_encode($dadosCertificado);
} else {
    echo json_encode(['erro' => 'Certificado não encontrado']);
}
?>
