<?php 
	session_start();
	include("config.php");
	$msg = 0;
	//se existir um botão chamado "entrar: "
	if(isset($_POST['entrar'])){
		//passando o conteúdo dos inputs para as variáveis
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		//verificando se os inputs estão vazios
		if(empty($email) or empty($pass)){
			//imprime essa mensagem caso estejam vazios
			$_SESSION['msg'] = "<h6 style='color: red'>Preencha todos os campos!</h6><br><hr>";
		//senao
		}else{
			//consulta e resultado da consulta do db
			$sql = "SELECT cli_email FROM clientes WHERE cli_email = '$email'";
			$resultado = mysqli_query($conn, $sql);
			 if (mysqli_num_rows($resultado)>0) {
            //criptografia de senha no formato md5
            $pass = md5($pass);
            $sql = "SELECT * FROM clientes WHERE cli_email = '$email' AND cli_pass = '$pass'";
            $resultado = mysqli_query($conn, $sql);
            //se a quantidade de linhas for igual a 1 significa que temos um registo de login, então será feita a autenticação e o usuário será redirecionado para a pagina principal
            if(mysqli_num_rows($resultado) == 1){
                $dados = mysqli_fetch_array($resultado);
                $_SESSION['logado'] = true;
                $_SESSION['usuario_id'] = $dados['cli_cod'];
                header('Location: home.php');
            //mensagem de erro dizendo usuário inválido
            }else{
                $_SESSION['msg2'] = "<h6 style='color: red'>Usuário inválido!</h6><br><hr>";
            }
        //mensagem de erro dizendo usuário inválido
        }else{
            $_SESSION['msg3'] = "<h6 style='color: red'>Usuário inválido!</h6><br><hr>";
        }

		}

	}

	$msg = 1;


 ?>


 <!DOCTYPE html>

<html>
<head>
	<style type="text/css">

		#divprin{
			margin-top: 20%;
		}

	</style>
	<title>Tela de LOGIN - CRUD</title>
</head>
<body>

	<center>
		<div id="divprin" style="position: relative;">
			<h2>Tela de login - CRUD</h2>
			<div>

				<?php 
                                        //verificando se há uma sessao chamada "msg"
                                        if(isset($_SESSION['msg'])){
                                        //impressao do conteudo da sessao
                                        echo $_SESSION['msg'];
                                        //destruição da sessao
                                        unset($_SESSION['msg']);
                                        }
                                        //verificando se ha uma sessao chamada "msg2"
                                        if(isset($_SESSION['msg2'])){
                                        //imprimindo conteudo da sessao
                                        echo $_SESSION['msg2'];
                                        //destruição da sessao
                                        unset($_SESSION['msg2']);
                                        }
                                        //verificando se uma uma sessao chamada "msg3"
                                        if(isset($_SESSION['msg3'])){
                                        //impressao do conteudo da sessao
                                        echo $_SESSION['msg3'];
                                        //destruição da sessao
                                        unset($_SESSION['msg3']);
                                        }

                                     ?>
				
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					
					<div>
						<label>Email: <input type="email" name="email" placeholder="Digite seu e-mail..."></label>
					</div>
					<br>
					<div>
						<label>Senha: <input type="password" name="pass" placeholder="Digite suas senha..."></label>
					</div>
					<br>
					<p>Ainda não tem uma conta? Cadastre-se <a href="cadastro.php">AQUI!</a></p>
					<button name="entrar" type="submit">Entrar</button>

				</form>

			</div>
		</div>
	</center>

</body>
</html>