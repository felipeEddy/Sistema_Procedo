<?php
    session_start();
    $logado = $_SESSION['email'];
    $nome = $_SESSION['nome'];
    if(!isset($logado)){
        header('Location: ../index.html');
    }
    include 'conexao.php';
    $cod = isset($_GET['codigo']) ? $_GET['codigo'] : null;
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;

    if($tipo == 'usuario'){
        $dados = mysqli_query($conexao, "SELECT * FROM usuario WHERE cod = '$cod'") or die(mysqli_error($conexao));
        $linha = mysqli_fetch_assoc($dados);
        $senha = md5($linha['senha']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edição de Usuário</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta http-equiv="Content-Language" content="pt-br">
    </head>
    <body class="w3-blue">
    <header class="w3-container">
        <h1><b>Editor de Usuários!</b></h1>
        <h4>Preencha os dados abaixo corretamente.</h4><br>
    </header>
    <div class="w3-container" style="width:70%">
        <form id="formCadastro">
            <input type="hidden" id="operacao" name="operacao" value="editUsuario">
            <input type="hidden" id="emailExiste" name="teste" value="neutro">
            <input type="hidden" name="codigo" value="<? echo $linha['cod'];?>">
            <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="nome" name="nome" value="<? echo $linha['nome'];?>"><br>
            <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="email" name="email" value="<? echo $linha['email'];?>"><br>
            <input class="w3-input w3-round-xxlarge" width="70%" type="password" id="senha1" name="senha1" placeholder="Senha" ">
            <div class="w3-container w3-margin">
                <label>Segurança da senha:</label><meter value="0" id="mtSenha" max="100"></meter>
            </div>
            <input class="w3-input w3-round-xxlarge" width="70%" type="password" id="senha2" name="senha2" placeholder="Confirme a Senha"><br>
            <div class="w3-container w3-margin">
                <label>Gênero:</label>
                <input type="radio" id="genero1" name="genero" value="m">Masculino
                <input type="radio" id="genero2" name="genero" value="f"> Feminino
            </div>
            <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="telefone" name="telefone" value="<? echo $linha['telefone'];?>"><br>
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
            </select><span>Anterior: <?echo $linha['uf']?></span><br>
            <select class="w3-input w3-round-xxlarge" id="cidades" name="cidades">
                <option disabled selected value>Selecione uma Cidade</option>
            </select><span>Anterior: <?echo $linha['cidade']?></span><br>
            <input type="hidden" val="" id="uf" name="uf">
            <p class="w3-left"><a href="menu.php">Voltar</a></p>
            <button class="w3-button w3-round w3-teal w3-round-xxlarge w3-right w3-margin-left" type="submit">Editar</button>
            <a href="excluir.php?excluir=usuario&codigo=<? echo $linha['cod'];?>" class="w3-button w3-round w3-teal w3-round-xxlarge w3-right">Excluir</a>
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
                        url: "processa_edita.php",
                        type: "post",
                        data: valores,
                        success: function(resultado){
                            if(resultado == 1){
                                alert("Edição Realizada com Sucesso");
                                window.location.href = 'menu.php';
                            }else{
                                alert("Erro ao Editar!");
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
<?  }
    else if($tipo == 'cliente'){
        $dados = mysqli_query($conexao, "SELECT * FROM cliente WHERE cod = '$cod'") or die(mysqli_error($conexao));
        $linha = mysqli_fetch_assoc($dados);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edição de Cliente</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta http-equiv="Content-Language" content="pt-br">
</head>
<body class="w3-blue">
<header class="w3-container">
    <h1><b>Edição de Clientes!</b></h1>
    <h4>Preencha os dados abaixo corretamente.</h4><br>
</header>
<div class="w3-container" style="width:70%">
    <form id="formCliente">
        <input type="hidden" id="operacao" name="operacao" value="editCliente">
        <input type="hidden" name="codigo" value="<? echo $linha['cod'];?>">
        <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="nome" name="nome" value="<?echo $linha['nome'];?>"><br>
        <input class="w3-input w3-round-xxlarge" width="70%" tpe="text" id="email" name="email" value="<?echo $linha['email'];?>"><br>
        <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="cnpj" name="cnpj" value="<?echo $linha['cnpj'];?>"><br>
        <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="telefone" name="telefone" value="<?echo $linha['telefone'];?>"><br>
        <span>Origem do Cliente: </span><span>Anterior: <?echo $linha['origem']?></span><br>
        <input type="radio" id="origem1" name="origem" value="Site">Site
        <input class="w3-margin-left" type="radio" id="origem2" name="origem" value="Boca a Boca">Boca a Boca
        <input class="w3-margin-left" type="radio" id="origem3" name="origem" value="Facebook">Facebook
        <input class="w3-margin-left" type="radio" id="origem4" name="origem" value="Indicação">Indicação  <br><br>
        <select class="w3-input w3-round-xxlarge" width="70%" id="estados" name="estados">
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
        </select><span>Anterior: <?echo $linha['uf']?></span><br>
        <select class="w3-input w3-round-xxlarge" width="70%" id="cidades" name="cidades">
            <option disabled selected value>Selecione uma Cidade</option>
        </select><span>Anterior: <?echo $linha['cidade']?></span><br><br>
        <input type="hidden" val="" id="uf" name="uf">
        <span>Situação </span><span>Anterior: <?echo $linha['situacao']?></span><br>
        <input type="radio" id="rdAtivo" name="situacao" value="ativo">Ativo
        <input type="radio" id="rdInativo" name="situacao" value="inativo">Inativo<br><br>
        <p class="w3-left"><a href="menu.php">Voltar</a></p>
        <button class="w3-button w3-round w3-teal w3-round-xxlarge w3-right w3-margin-left" type="submit" id="btnCadastrar">Editar</button>
        <a href="excluir.php?excluir=cliente&codigo=<? echo $linha['cod'];?>" class="w3-button w3-round w3-teal w3-round-xxlarge w3-right">Excluir</a>
    </form>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#formCliente').submit(function(event){
                event.preventDefault();
                if(testarCampos(true)){
                    var valores = $(this).serialize();
                    $.ajax({
                        url: "processa_edita.php",
                        type: "post",
                        data: valores,
                        success: function(resultado){
                            if(resultado == 1){
                                alert("Edição Realizada com Sucesso!");
                                window.location = 'menu.php';
                            }
                        }
                    });
                }
            });

            function testarCampos(call){
                if(call) {
                    var cont = true;
                    var email = $('#email').val();
                    $('input').each(function () {
                        if ($.trim($(this).val()) == '') {
                            alert("Informe todos os campos!");
                            $(this).focus();
                            cont = false;
                            return false;
                        }
                    });
                    if (!email.trim().match(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i)) {
                        alert("Informe um E-mail válido!");
                        $('#email').focus();
                        cont = false;
                        return false;
                    }
                    if (cont) {
                        return true;
                    }
                }
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

        });
    </script>
</body>
</html>
<?php
    }
?>
