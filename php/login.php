<?php
	if(isset($_POST['email'])==true && empty($_POST['email'])==false && isset($_POST['senha'])==true && empty($_POST['senha'])==false){
		include 'conexao.php';
		$email = trim($_POST['email']);
		$senha = md5($_POST['senha']);
		$resultado = mysqli_query($conexao, "SELECT * FROM usuario WHERE email='".$email."' AND senha='".$senha."'") or die (mysqli_error());
		$nome = mysqli_fetch_assoc($resultado);
		if(mysqli_num_rows($resultado) > 0 ){
			echo 1;
			if(!isset($_SESSION)){
				session_start();
				$_SESSION['nome'] = $nome['nome'];
				$_SESSION['email']=$email; 		
				$_SESSION['senha']=$senha;
			}
		}
		else{
			echo 0;
		}
		mysqli_close($conexao);
	}
?>