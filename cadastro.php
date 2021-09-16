<?php 
	session_start();
	include("config.php");

	//pegando info dos inputs e fazendo consulta sql
if (isset($_POST['cadastrar'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$pass = md5($_POST['pass']);
	$sql = "INSERT INTO clientes (cli_nome, cli_email, cli_pass) VALUES ('$nome', '$email', '$pass')";
	$result = mysqli_query($conn, $sql);
	//verificando se os inputs estão vazios, se estiverem, imprimo uma mensagem de erro pedindo para o usuário preencher todos os campos necessários. Caso todos os inputs estiverem preenchidos, o código segue para o else, que mostrará uma mensagem que o usuário foi cadastrado com sucesso.
	if(empty($nome)or empty($email) or empty($pass)){
		$_SESSION['msg'] = "<h6 style = 'color: red'>Preencha todos os campos</h6>";
	}else{
		$_SESSION['msg2'] = "<h6 style = 'color: green'>Usuário cadastrado com sucesso, faça login!</h6>";
	}

}
 ?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#divprin{
			margin-top: 15%;
		}
	</style>
	<title>Cadastro</title>
</head>
<body>

<center>
	<div id="divprin" style="position: relative;">
		<h2>Tela de login - CRUD</h2>
		<div>

			<?php 
												//verificando se existe uma sessao chamada "msg"
												if(isset($_SESSION['msg'])){
													//impressão conteudo da sessão "msg"
													echo $_SESSION['msg'];
													//destruicao da sessao
													unset($_SESSION['msg']);
												}
												//verificado se ha uma sessao chamada "msg2"
												if(isset($_SESSION['msg2'])){
													//impressao do conteudo da sessao
													echo $_SESSION['msg2'];
													//destruição da sessao
													unset($_SESSION['msg2']);
												}
                                             ?>
			<form action="cadastro.php" method="POST">
				<div>
					<label>Nome: <input type="nome" name="nome" placeholder="Digite seu nome..."></label>
				</div>
				<br>
				<div>
					<label>Email: <input type="email" name="email" placeholder="Digite seu e-mail..."></label>
				</div>
				<br>
				<div>
					<label>Senha: <input type="password" name="pass" placeholder="Digite suas senha..."></label>
				</div>
				<br>
				<p>Já tem uma conta?<a href="index.php"> Faça login!</a></p>
				<button name="cadastrar" type="submit">Cadastrar-se</button>

			</form>
		</div>
	</div>
</center>

</body>
</html>