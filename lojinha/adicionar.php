<?php

session_start();

include('conexao.php');
include('funcoes.php');
include('validalogin.php');
include('validaadmingerente.php');



$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$login = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$selectcpf = "SELECT cpf FROM
usuario WHERE cpf = '$cpf'";
$querycpf = mysqli_query($conexao, $selectcpf);
$dadocpf = mysqli_fetch_row($querycpf);
$selectlogin = "SELECT login FROM
login WHERE Login = '$login'";
$querylogin = mysqli_query($conexao, $selectlogin);
$dadologin = mysqli_fetch_row($querylogin);

if ($nome <> NULL){
    if (($dadocpf == NULL) && ($dadologin == NULL)) {
    $insertusuario = "INSERT INTO usuario (nome, cpf, telefone)
    VALUES ('$nome', '$cpf','$telefone')"; $queryusuario = mysqli_query($conexao, $insertusuario);
    $senhacriptografada = criptografar($senha);
    $insertlogin = "INSERT INTO login ( cpf, login, senha, nivel )
    VALUES ('$cpf', '$login', '$senhacriptografada', 3)";
    $querylogin = mysqli_query($conexao, $insertlogin);
    echo '<script>alert("Usuário cadastrado com sucesso!");
    window.location="adicionar.php";
    </script>';
    }   else { 
    echo '<script>alert("cpf e/ou login já cadastrados no sistema");
    window.location="adicionar.php";
    </script>';
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>Adicionar Usuário</h1> 
        <form id="form-add" action="#" method="POST">
        NOME: <input type="text" name="nome"><br>
        CPF: <input type="text" name="cpf"><br>
        TELEFONE: <input type="text" name="telefone"><br>
        LOGIN: <input type="text" name="login"><br>
        SENHA: <input type="password" name="senha"><br>
        <input type="submit" name="cadastrar" value="Cadastrar">
</center>
</form>

</body>
</html>