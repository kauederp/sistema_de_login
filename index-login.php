<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>sistema de Login</title>
	<meta name="description" content="Um simples sistema de login usando php">
  	<meta name="keywords" content="HTML, CSS, JavaScript, PHP, login, data">
  	<meta name="author" content="Kauê Delgado Pereira">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>

		<nav class="col-12">
			<h3 id="header-title">Sistema de Login</h3>
			<ul class="col-12">
				<li><button id="btnEntrar" class="col-2 opicao">entrar</button></li>
			</ul>
		</nav>
	</header>
	<main id="main" class="col-10">
	<?php

			function useRegex($input) {
   				$regex = '/^[a-zA-Z0-9]+$/i';
    			return preg_match($regex, $input);
			}
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['password'] = $_POST['password'];


			$email = $_SESSION['email'];
			$password = $_SESSION['password'];

			if(useRegex($password)){
				$password=md5($password);
				$registerIsMd5=true;
			}
			
			$_SESSION['emailLogin'] = $_POST['emailLogin'];
			$_SESSION['passwordLogin'] = $_POST['passwordLogin'];

			$emailLogin = $_SESSION['emailLogin'];
			$passwordLogin = $_SESSION['passwordLogin'] ;
			if(useRegex($passwordLogin)){
				$passwordLogin=md5($passwordLogin);
				$loginIsMd5=true;
			}
			
			
			
			$registro = fopen('registro.txt','a');
			if($registro==false){
				die("<h1>acesso impossível</h1>");
			}
			
			$conteudo = file('registro.txt') ;


			foreach($conteudo as $linha){
				$linha = trim($linha);
				$valor = explode('|',$linha);
				//var_dump($valor);
				for($i=0;$i<count($valor);$i++){
					if("$emailLogin$passwordLogin"=="$valor[$i]" and $loginIsMd5==true){
						//echo $valor[i];
						echo "<div id='logSucess' class='col-12'><h1> LOGADO COM SUCESSO</h1></div>";
						break;
					}else if(!"$emailLogin$passwordLogin"=="$valor[$i]" and isset($_POST['emailLogin'])){
						echo "<div id='logFailure' class='col-12'><h2>ERRO! email ou senha incorretos tente novamente </h2></div>";
						break;
						
					}
				}
			}	

			if($registerIsMd5==true and isset($_POST['enviarRegistro']) and $_POST['email']!=""){
				fwrite($registro,"$email$password|");
				fclose($registro);
				header("location: index-login.php");
			}



		?>
		
		<div id="registro" class="col-12">
			<h1>registro</h1>
			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
				<label for="email" class="label">email:</label>
				<input id="inputEmail" class="col-9 input" type="email" name="email">
				<label for="password" class="label">senha:</label>
				<input id="password" class="col-9 input" type="password" name="password" pattern="^[a-zA-Z0-9]+$">
				<!--(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}-->
				<input class="col-5 enviar" id="enviarRegistro" type="submit" name="enviarRegistro" value="enviar">
			</form>
		</div>
		<div id="login" class="col-12">
			<h1>login</h1>
			<form id="formLogin" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
				<label for="emailLogin" class="label">email:</label>
				<input id="inputEmailLogin" class="col-9 input" type="email" name="emailLogin">
				<label for="passwordLogin" class="label">senha:</label>
				<input id="passwordLogin" class="col-9 input" type="password" name="passwordLogin" pattern="^[a-zA-Z0-9]+$">
				<input class="col-5 enviar" id="enviarLogin" type="submit" name="enviarLogin" value="enviar">
			</form>
		</div>
	</main>
	 <footer id="footer">
  		<p>Kauê Delgado Pereira © <a href="mailto:kaue-dpereira1@educar.rs.gov.br">email</a></p>
	</footer>
	<script type="text/javascript" src="script/script.js"></script>
</body>
</html>