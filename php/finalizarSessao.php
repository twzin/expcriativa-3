<?php
session_start();

unset($_SESSION['email']);
unset($_SESSION['senha']);

echo json_encode(["sessaoAtiva" => false]);

?>