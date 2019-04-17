<?php 
	include 'conexao.php';
	$operacao = isset($_POST['operacao']) ? $_POST['operacao'] : null;
	
	if($operacao == 'cadUsuario'){
		$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$senha = isset($_POST['senha1']) ? md5($_POST['senha1']) : null;
		$genero = isset($_POST['genero']) ? $_POST['genero'] : null;
		$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
		$uf = isset($_POST['uf']) ? $_POST['uf'] : null;
		$cidade = isset($_POST['cidades']) ? $_POST['cidades'] : null;

		if(mysqli_query($conexao, "INSERT INTO usuario VALUES('DEFAULT', '$nome', '$email', '$senha', '$genero', '$telefone',
		'$uf', '$cidade', '1')")){
			echo 1;
		}
		else{
			echo 0;
		}
		mysqli_close($conexao);
	}

    if($operacao == 'cadCliente') {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : null;
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
        $origem = isset($_POST['origem']) ? $_POST['origem'] : null;
        $uf = isset($_POST['uf']) ? $_POST['uf'] : null;
        $cidade = isset($_POST['cidades']) ? $_POST['cidades'] : null;
        $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : null;
        $obs = null;

        if (mysqli_query($conexao, "INSERT INTO cliente VALUES('DEFAULT', '$nome', '$email', '$cnpj', '$telefone', '$origem',
            '$uf', '$cidade', '$situacao', '$obs')")) {
            echo 1;
        } else {
            echo 0;
        }
        mysqli_close($conexao);
    }

?>