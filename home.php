<?php 
session_start();
include("config.php");
//pegando id
$id = $_SESSION['usuario_id'];
//fazendo consulta para pegar id do usuario e armazenar no array "$dados"
$sql = "SELECT * FROM clientes WHERE cli_cod = '$id'";
$resultado = mysqli_query($conn, $sql);
$dados = mysqli_fetch_array($resultado);

$consulta = "SELECT * FROM clientes";
$result = mysqli_query($conn, $consulta);

// se na variável $result, no segundo parâmetro eu colocar o variável $sql, eu consigo 
//exibir somente os dados do usuário logado, dessa forma:
//$consulta = "SELECT * FROM clientes";
//$result = mysqli_query($conn, $sql);


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Início</title>
</head>
<body>

<center>
	<div style="position: relative;">

		<h2>Listagem de Clientes</h2>
		Você está logado como <?php echo $dados['cli_nome']; ?>
		<br>
		<table border="1"> 
        <tr> 
          <td>Código</td> 
          <td>Nome</td> 
          <td>E-mail</td> 
          <td>Ação</td>
        </tr> 
        <?php while($dado = $result->fetch_assoc()) { ?> 
        <tr> 
          <td><?php echo $dado['cli_cod']; ?></td>
          <td><?php echo $dado['cli_nome']; ?></td> 
          <td><?php echo $dado['cli_email']; ?></td>
          <td> 
            <a href="editar.php?codigo=<?php echo $dado['cli_cod']; ?> "><img src="http://alunos.arioliveira.com/editar.png" width="16"> </a> | 
            <a href="javascript: if(confirm('Confirmar')) location.href = ' excluir.php?codigo=<?php echo $dado['cli_cod']; ?>';"><img src="http://alunos.arioliveira.com/excluir.png" width="16"></a> 
          </td> 
        </tr> 
        <?php } ?> 
      </table> 



	
	</div>
</center>

</body>
</html>