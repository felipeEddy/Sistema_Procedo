<?php
    include 'conexao.php';
    if($_GET['excluir'] == 'usuario'){
        $cod = $_GET['codigo'];
        if(mysqli_query($conexao, "DELETE FROM usuario WHERE cod='$cod'")){
            echo "<html><body><script type='text/javascript'>alert('Exclusão realizada com sucesso!')</script></body></html>";
            header('Location: menu.php');
        }
        mysqli_close($conexao);
    }
    if($_GET['excluir'] == 'cliente'){
        $cod = $_GET['codigo'];
        if(mysqli_query($conexao, "DELETE FROM cliente WHERE cod='$cod'")){
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
            header('Location: menu.php');
        }
        mysqli_close($conexao);
    }
