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
        <title>Cadastro de Cliente</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta http-equiv="Content-Language" content="pt-br">
    </head>
    <body class="w3-blue">
        <header class="w3-container">
            <h1><b>Cadastro de Clientes!</b></h1>
            <h4>Preencha os dados abaixo corretamente.</h4><br>
        </header>
        <div class="w3-container" style="width:70%">
            <form id="formCliente">
                <input type="hidden" id="operacao" name="operacao" value="cadCliente">
                <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="nome" name="nome" placeholder="Nome"><br>
                <input class="w3-input w3-round-xxlarge" width="70%" tpe="text" id="email" name="email" placeholder="E-mail"><br>
                <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="cnpj" name="cnpj" placeholder="CNPJ"><br>
                <input class="w3-input w3-round-xxlarge" width="70%" type="text" id="telefone" name="telefone" placeholder="Telefone"><br>
                <span>Origem do Cliente: </span><br>
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
                </select><br>
                <select class="w3-input w3-round-xxlarge" width="70%" id="cidades" name="cidades">
                    <option disabled selected value>Selecione uma Cidade</option>
                </select><br>
                <input type="hidden" val="" id="uf" name="uf">
                <span>Situação: </span><br>
                <input type="radio" id="rdAtivo" name="situacao" value="ativo">Ativo
                <input type="radio" id="rdInativo" name="situacao" value="inativo">Inativo<br><br>
                <p class="w3-left"><a href="menu.php">Voltar</a></p>
                <button class="w3-button w3-round w3-teal w3-round-xxlarge w3-right" type="submit" id="btnCadastrar">Cadastrar</button>
            </form>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){

                    $('#formCliente').submit(function(event){
                        event.preventDefault();
                        if(testarCampos(true)){
                            var valores = $(this).serialize();
                            $.ajax({
                                url: "cadastrar.php",
                                type: "post",
                                data: valores,
                                complete: function(){
                                },
                                success: function(resultado){
                                    if(resultado == 1){
                                        alert("Cadastro Realizado com Sucesso");
                                        window.location.href = 'menu.php';
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
