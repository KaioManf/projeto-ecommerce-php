<?php
    // Validação de dados
    $usuario = isset($_POST['txtUsuario']) ? $_POST['txtUsuario'] : '';
    $senha = isset($_POST['txtSenha']) ? $_POST['txtSenha'] : '';

    if (empty($usuario) || empty($senha)) {
        header('LOCATION: ../login.php');
        exit;
    } 

    // Se passou pela validação, continua a partir daqui

    // Conexão com Banco de Dados
    require_once 'class/BancoDeDados.php';
    $bd = new BancoDeDados;
    $bd->conectar();
    $sql = 'SELECT * FROM usuarios WHERE usuario=? AND senha=?';
    $params = [$usuario, $senha];
    $dados = $bd->buscarRegistro($sql, $params);

    // Verificar se a consulta no BD retornou pelo menos um linha
    if (is_array($dados)) {
		session_start();
		$_SESSION['id_usuario'] = $dados['id_usuario'];
		$_SESSION['nome'] = $dados['nome'];
		$_SESSION['logado'] = TRUE;

        header('LOCATION: ../sistema.php');
    } else {
        echo '<script> 
                alert("Usuário ou senha inválidos. Verifique!");
                window.location = "../login.php";
        </script>';
    }