<?php
	session_start();
	$logado = $_SESSION['email'];
	$nome = $_SESSION['nome'];
	if(!isset($logado)){
		header('Location: ../index.html');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Menu Inicial</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta http-equiv="Content-Language" content="pt-br">
	</head>
	<body>
        <header class="w3-blue" style="height:30%">
            <h1>Bem Vindo, <?echo $nome?>!</h1>
        </header>
        <div class="w3-bar w3-light-gray">
		    <button class="w3-bar-item w3-button w3-mobile" id="btnListarCli">Lista de Clientes</button>
		    <button class="w3-bar-item w3-button w3-mobile" id="btnCadCliente">Cadastrar Cliente</button>
		    <button class="w3-bar-item w3-button w3-mobile" id="btnListarUsu">Listar Usuários</button>
		    <button class="w3-bar-item w3-button w3-mobile" id="btnCadUsuario">Cadastrar Usuário</button>
            <button class="w3-bar-item w3-button w3-mobile w3-right" id="btnSair">Logout</button>
        </div>
        <ul class="w3-col l5 m6 s12 w3-ul w3-card w3-margin" id="liUsuarios"><li class="w3-teal">Lista dos Usuários</li></ul>
        <ul class="w3-col l5 m6 s12 w3-ul w3-card w3-margin" id="liClientes"><li class="w3-red">Lista dos Clientes</li></ul>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){

			    $('ul').hide();
			    liUsu = false;
			    liCli = false;

			    $('#btnListarUsu').click(function(){
			        if(!liUsu) {
                        $('#liUsuarios').empty();
                        $('#liUsuarios').append('<li class="w3-teal">Lista dos Usuários</li>');
                        $.ajax({
                            url: 'seletor.php',
                            type: 'post',
                            data: 'listar=usu',
                            success: function (results) {
                                $('#liUsuarios').show();
                                $('#liUsuarios').append(results);
                            }
                        });
                        liUsu = true;
                    }
			        else{
			            $('#liUsuarios').hide();
			            liUsu = false;
                    }
                });

                $('#btnListarCli').click(function(){
                    if(!liCli) {
                        $('#liClientes').empty();
                        $('#liClientes').append('<li class="w3-red">Lista dos Clientes</li>');
                        $.ajax({
                            url: 'seletor.php',
                            type: 'post',
                            data: 'listar=cli',
                            success: function (results) {
                                $('#liClientes').show();
                                $('#liClientes').append(results);
                            }
                        });
                        liCli = true;
                    }
                    else{
                        $('#liClientes').hide();
                        liCli = false;
                    }
                });

                $('#btnCadUsuario').click(function(){
                    window.location.href = 'cadastroUsuario.php';
                });

                $('#btnCadCliente').click(function(){
                    window.location.href = 'cadastroCliente.php';
                });

				$('#btnSair').click(function(){
					$.ajax({
                        url: 'logout.php',
                        type: 'post',
                        data: 'sair=sair',
                        success: function(){
                            alert('Sessão encerrada, volte logo!');
                            window.location.href='../index.html';
                        }
                    });
				});

			});
		</script>
	</body>
</html>