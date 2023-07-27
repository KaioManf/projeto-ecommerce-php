<?php 
	// Encerrar sessão
	session_start();
	session_destroy();

	// Destrói super variável SESSION
	unset($_SESSION);

	// Redireciona o usuário para o index
	header('location: ../index.php');