<?php

// Ao usuario sair irei redirecionar a pagina index
session_start();
unset($_SESSION['cLogin']);
header("Location: ./");
?>