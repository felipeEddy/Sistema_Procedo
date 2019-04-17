<?php
		include 'conexao.php';

		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$result = mysqli_query($conexao, "SELECT * FROM usuario WHERE email ='$email'") or die (mysqli_error());
		if(mysqli_num_rows($result) > 0){
			echo 1;
		}
		else{
			echo 0;
		}
		mysqli_close($conexao);
?>