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
    <title>Cadastro de Usuário</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta http-equiv="Content-Language" content="pt-br">
</head>
<body class="w3-blue">
<header class="w3-container">
    <h1><b>Cadastro de Usuários!</b></h1>
    <h4>Preencha os dados abaixo corretamente.</h4><br>
</header>
<div class="w3-container" style="width:70%">
    <form id="formCadastro">
        <input type="hidden" id="operacao" name="operacao" value="cadUsuario">
        <input type="hidden" id="emailExiste" name="teste" value="neutro">
        <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="nome" name="nome" placeholder="Nome"><br>
        <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="email" name="email" placeholder="E-mail"><br>
        <input class="w3-input w3-round-xxlarge" width="70%" type="password" id="senha1" name="senha1" placeholder="Senha">
        <div class="w3-container w3-margin">
            <label>Segurança da senha:</label><meter value="0" id="mtSenha" max="100"></meter>
        </div>
        <input class="w3-input w3-round-xxlarge" width="70%" type="password" id="senha2" name="senha2" placeholder="Confirme sua Senha"><br>
        <div class="w3-container w3-margin">
            <label>Gênero:</label>
            <input type="radio" id="genero1" name="genero" value="m" checked>Masculino
            <input type="radio" id="genero2" name="genero" value="f"> Feminino
        </div>
        <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="telefone" name="telefone" placeholder="Telefone"><br>
        <select class="w3-input w3-round-xxlarge" id="estados" name="estados">
            <option disabled selected value>Selecione um Estado</option>
            <option value="12">Acre</option>
            <option value="27">Alagoas</option>
            <option value="16">Amapá</option>
            <option value="13">Amazonas</option>
            <option value="29">Bahia</option>
            <option value="23">Ceará</option>
            <option value="53">Distrito Federal</option>
            <option value="32">Espírito Santo</option>
            <option value="52">Goiás</option>
            <option value="21">Maranhão</option>
            <option value="51">Mato Grosso</option>
            <option value="50">Mato Grosso do Sul</option>
            <option value="31">Minas Gerais</option>
            <option value="15">Pará</option>
            <option value="25">Paraíba</option>
            <option value="41">Paraná</option>
            <option value="26">Pernambuco</option>
            <option value="22">Piauí</option>
            <option value="33">Rio de Janeiro</option>
            <option value="24">Rio Grande do Norte</option>
            <option value="43">Rio Grande do Sul</option>
            <option value="11">Rondônia</option>
            <option value="14">Roraima</option>
            <option value="42">Santa Catarina</option>
            <option value="35">São Paulo</option>
            <option value="28">Sergipe</option>
            <option value="17">Tocantins</option>
        </select><br>
        <select class="w3-input w3-round-xxlarge" id="cidades" name="cidades">
            <option disabled selected value>Selecione uma Cidade</option>
        </select><br>
        <input type="hidden" val="" id="uf" name="uf">
        <p class="w3-left"><a href="menu.php">Voltar</a></p>
        <button class="w3-button w3-round w3-teal w3-round-xxlarge w3-right" type="submit" id="btnCadastrar">Cadastrar</button>
    </form>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="../js/complexify.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#email').keypress(function(){
            testarEmail();
        });

        $('#email').blur(function(){
            testarEmail();
        });

        $('#formCadastro').submit(function(event){
            event.preventDefault();
            if(testarCampos()){
                var valores = $(this).serialize();
                $.ajax({
                    url: "cadastrar.php",
                    type: "post",
                    data: valores,
                    success: function(resultado){
                        if(resultado == 1){
                            alert("Cadastro Realizado com Sucesso");
                            window.location.href = 'menu.php';
                        }
                    }
                });
            }
        });

        function testarCampos(){
            var cont = true;
            var email = $('#email').val();
            $('input').each(function(){
                if($.trim($(this).val()) == ''){
                    alert("Informe todos os campos!");
                    $(this).focus();
                    cont = false;
                    return false;
                }
            });
            if($('#senha1').val() != $('#senha2').val()){
                alert("Senhas Diferentes!");
                $('senha2').focus();
                cont = false;
                return false;
            }
            else if (!email.trim().match(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i)){
                alert("Informe um E-mail válido!");
                $('#email').focus();
                cont = false;
                return false;
            }
            if(cont){
                return true;
            }
        }

        function testarEmail(){
            var email = $('#email').val();
            $.ajax({
                url: 'testeEmail.php',
                type:'post',
                data: 'email=' + email,
                success: function(result) {
                    if (result != "0") {
                        $('#emailExiste').val('sim');
                    }else{
                        $('#emailExiste').val('nao');
                    }
                }
            });
        }

        $('#estados').change(function(){
            $.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+$('#estados').val()+'/municipios',
                function(data){
                    $('#cidades').empty();
                    $('#cidades').append("<option disabled selected value>Selecione uma Cidade</option>");
                    for(x in data){
                        $('#cidades').append("<option val='"+data[x].nome+"'>"+data[x].nome+"</option>");
                    }
                });
        });

        $('#estados').change(function(){
            $.get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/" + $('#estados').val(),
                function(data){
                    $('#uf').val(data.sigla);
                });
        });

        $(function () {
            $("#senha1").complexify({}, function (valid, complexity) {
                $("#mtSenha").val(complexity);
            });
        });



    });
</script>
</body>
</html>

