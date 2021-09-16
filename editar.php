<?php
include("config.php");
$codigo = $_GET['codigo'];
if(isset($_POST['nome'])) {
	$codigocliente = $_POST['codigocliente'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
 
 $consulta = "UPDATE clientes set cli_nome = '$nome', cli_email = '$email'
 where cli_cod = $codigocliente";
 $resultado = mysqli_query($conn, $consulta);
 header("Location: home.php");
}


$consulta3 = "SELECT * FROM clientes WHERE cli_cod = $codigo";
$resultado3 = mysqli_query($conn, $consulta3);
$dados = mysqli_fetch_array($resultado3);

?>

<center>
<h3>Editar Clientes</h3>
 	<form action="?" method="POST">

 	      Código:<br><input type="text" name="codigocliente"   value="<?php echo $dados['cli_cod']; ?>" READONLY STYLE="pointer-events: none;background: #ccc;"><br>

        Nome:<br><input type="text" class="form-control" name="nome" value="<?php echo $dados['cli_nome']; ?>"><br>
      
        E-mail:<br><input type="text" class="form-control" name="email" value="<?php echo $dados['cli_email']; ?>"><br><br>

       <button type="submit" class="btn btn-primary">Salvar</button>

  </form>
</center>