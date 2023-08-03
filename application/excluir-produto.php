<?php
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if(empty($id)){
        echo
        "<script>
            alert('ID do Produto não encontrado!');
            window.location = '../sistema.php?tela=produtos';
        </script>";
        exit;
    }

    require_once 'class/BancoDeDados.php';
    $bd = new BancoDeDados();
    $bd->conectar();
    $sql = "DELETE FROM produtos WHERE id_produto = ?";
    $bd->deletarRegistro($sql, array($id));

    echo
        "<script>
            alert('Produto excluído com sucesso!');
            window.location = '../sistema.php?tela=produtos';
        </script>";
?>