<?php

    session_start();
    $_SESSION['email'];
    $_SESSION['senha'];
    $_SESSION['nome'];

    if(isset($_POST['sair'])){
        session_destroy();
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['nome']);
        $_SESSION['email'] = null;
        $_SESSION['senha'] = null;
        $_SESSION['nome'] = null;
        session_commit();
    }

?>