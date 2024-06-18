<?php
session_start(); // Inicia a sessão

// Verifica se a sessão está definida e não está vazia
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    echo json_encode(["autenticado" => false]);
    exit();
} else {
    echo json_encode(["autenticado" => true, "email" => $_SESSION['email']]);
}
?>
