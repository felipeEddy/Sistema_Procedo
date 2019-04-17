<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bancoDados = "procedo";
    // Criando a conexão com o banco de dados
    $conexao = mysqli_connect($servidor, $usuario, $senha, $bancoDados);
    // Checando a conexão com o banco de dados
    if (mysqli_connect_errno()){
        echo "Falha ao conectar com Servidor! ".mysqli_connect_error();
    }
?>