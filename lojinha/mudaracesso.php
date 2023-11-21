<?php

session_start();

include('validaadmin.php');
include('conexao.php');
include('validalogin.php');


$select = "SELECT nome,descricao,usuario.cpf 
           FROM usuario
           INNER JOIN login ON login.cpf = usuario.cpf
           INNER JOIN nivel ON nivel.id = nivel";

$query = mysqli_query($conexao, $select);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <center>
        <form name="mudatipo" action="mudatipo.php" method="POST">
            <table border="1px">
                <tr>
                    <td>nome</td>
                    <td>tipo de acesso</td>
                    <td>novo tipo de acesso</td>
                    <td>alterar</td>
                </tr>
                <?php
                while ($linha = mysqli_fetch_row($query)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $linha[0] ?>
                        </td>
                        <td>
                            <?php echo $linha[1] ?>
                        </td>
                        <td><select name="nivel">
                                <option value="1">administrador</option>
                                <option value="2">gerente</option>
                                <option value="3">usuario</option>
                            </select></td>
                        <td><input type="submit" name="alterar" value="alterar">
                            <input type="hidden" name="cpf" value="<?php echo $linha[2] ?>">
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </center>

</body>

</html>