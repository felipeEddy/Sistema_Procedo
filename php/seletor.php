<?php
    include 'conexao.php';

    session_start();
    $logado = $_SESSION['email'];
    $nome = $_SESSION['nome'];
    if(!isset($logado)){
     header('Location: ../index.html');
    }

    if(isset($_POST['listar'])){

        if($_POST['listar'] == 'usu') {
            $dados = mysqli_query($conexao, "SELECT * FROM usuario ORDER BY nome") or die(mysqli_error($conexao));
            $linha = mysqli_fetch_assoc($dados);
            $total = mysqli_num_rows($dados);

            if ($total > 0) {
                do {
                    echo "<li class='w3-bar w3-hover-teal'>
                         <span onclick='$(this).parent().hide();' class='w3-bar-item w3-button w3-large w3-right'>X</span>
                         <a href='editar.php?codigo=" . $linha['cod'] . "&tipo=usuario' class='w3-bar-item w3-button w3-right'>Editar</a>
                         <span><b>" . $linha['nome'] . "</b></span><br>
                         <span>" . $linha['email'] . "</span><br>
                         <span>" . $linha['cidade'] . " - " . $linha['uf'] . "</span><br>
                         <span>Telefone: " . $linha['telefone'] . "</span>
                      </li>";
                } while ($linha = $dados->fetch_assoc());

            }
        }

        else if($_POST['listar'] == 'cli') {
            $dados = mysqli_query($conexao, "SELECT * FROM cliente ORDER BY nome") or die(mysqli_error($conexao));
            $linha = mysqli_fetch_assoc($dados);
            $total = mysqli_num_rows($dados);

            if ($total > 0) {
                do {
                    echo "<li class='w3-bar w3-hover-red'>
                         <span onclick='$(this).parent().hide();' class='w3-bar-item w3-button w3-xlarge w3-right'>X</span>
                         <a href='editar.php?codigo=" . $linha['cod'] . "&tipo=cliente' class='w3-bar-item w3-button w3-right'>Editar</a>
                         <span><b>" . $linha['nome'] . "</b></span><br>
                         <span>CNPJ: " . $linha['cnpj'] . "</span><br>
                         <span>" . $linha['cidade'] . " - " . $linha['uf'] . "</span><br>
                         <span>Telefone: " . $linha['telefone'] . "</span><br>
                         <span>" . $linha['email'] . "</span>
                      </li>";
                } while ($linha = $dados->fetch_assoc());

            }
        }
    }


?>
