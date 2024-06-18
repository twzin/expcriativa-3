<?php
function gerarSenha($tamanho = 10) {
    // Caracteres possíveis para a senha
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}|:<>?-=[];,./';

    // Obtém o comprimento total dos caracteres possíveis
    $totalCaracteres = strlen($caracteres);

    // Inicializa a senha como uma string vazia
    $senha = '';

    // Loop para gerar a senha aleatória
    for ($i = 0; $i < $tamanho; $i++) {
        // Escolhe um caractere aleatório do conjunto de caracteres
        $senha .= $caracteres[rand(0, $totalCaracteres - 1)];
    }

    return $senha;
}

// Define o comprimento da senha que você deseja gerar
$tamanhoSenha = 12;

// Chama a função para gerar a senha
$Fanrui = gerarSenha($tamanhoSenha);
?>
