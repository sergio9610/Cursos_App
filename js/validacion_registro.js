function validar(){
	var cedula, nombres, apellidos, correo, password, password2, ciudad, barrio, terminos, expresion;

	cedula = document.getElementById("cedula").value;
	nombres = document.getElementById("nombres").value;
	apellidos = document.getElementById("apellidos").value;
	correo = document.getElementById("correo").value;
	password = document.getElementById("password").value;
	password2 = document.getElementById("password2").value;
	barrio = document.getElementById("barrio").value;
	terminos = document.getElementById("terminos").checked;
	ciudad = document.getElementById("ciudad").value;
	
	exp_correo = /\w+@\w+\.+[a-z]/;
	exp_apellidos = /[a-z]+\s+[a-z]+$/;

	if(cedula === "" || nombres === "" || apellidos === "" || correo === "" || password === "" || password2 === "" || ciudad === "" || barrio === ""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	else if(isNaN(cedula)){
        alert("Número de Identificación no admitido");
		return false;
    }
	else if(cedula.length<10){
		alert("Número de Identificación no admitido");
		return false;
	}
	else if(nombres.length>30){
		alert("Solo se aceptan 30 caracteres");
		return false;
	}
	else if(apellidos.length>30){
		alert("Solo se aceptan 30 caracteres");
		return false;
	}
	else if(!exp_apellidos.test(apellidos)){
        alert("Debe ingresar sus dos apellidos");
        return false;
    }
	else if(correo.length>30){
		alert("El Correo es muy largo. Solo se aceptan 30 caracteres");
		return false;
	}
	else if(!exp_correo.test(correo)){
		alert("El correo no es válido");
		return false;
	}
	else if(password.length<6){
		alert("La Contraseña es muy corta. Debe tener mínimo 6 caracteres");
		return false;
	}
	else if(password.length>20){
		alert("La Contraseña es muy larga. Se aceptan 20 caracteres");
		return false;
	}
	else if(password2.length>20){
		alert("La Confirmación de la Contraseña es muy larga. Solo se aceptan 20 caracteres");
		return false;
	}

	else if(password !== password2){
		alert("La confirmación de la contraseña no coincide con la contraseña escrita");
		return false;
	}
	else if(!terminos){
		alert("Todos los campos son obligatorios");
		return false;
	}
} 
