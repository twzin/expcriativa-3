<?php
    session_start();
    
    // 1 hora = 3600 segundos
    $expiraSessao = 3600;
    
    // Verifica se a sessão está ativa
    if(isset($_SESSION['email'], $_SESSION['senha'])) {
        // Verifica se a última atividade da sessão foi há mais de 1 hora
        if(isset($_SESSION['tempoLogado']) && (time() - $_SESSION['tempoLogado'] > $expiraSessao)) {
            session_unset();
            session_destroy();
            // echo json_encode(["sessaoExpirada" => true]);
            exit; 
        }
    
        // Atualiza o tempo da última atividade da sessão
        $_SESSION['tempoLogado'] = time();
    } else {
        echo json_encode(["sessaoAtiva" => false]);
        session_unset();
        session_destroy();
        exit; 
    }

?>