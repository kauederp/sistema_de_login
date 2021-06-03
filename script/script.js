var btn = document.getElementById("btnEntrar");

var registro = document.getElementById("registro");

var login = document.getElementById("login");

var fundo = document.getElementById("main");






btn.onclick = function () {
	if(login.style.display != "block"){
		console.log("esconde")
		login.style.display = "block";
		registro.style.display = "none";
		login.style.backgroundColor = "rgba(140, 140, 140, 0.6)";
		btn.style.backgroundColor = "black";
		btn.innerText = "registre-se";
		btn.style.width = '30%';
	}else if(login.style.display != "none"){
		btn.style.backgroundColor = "rgb(0, 140, 140)";
		btn.innerText = "entrar";
		registro.style.display = "block";
		login.style.display = "none";
		console.log("mostra")
	}
}

