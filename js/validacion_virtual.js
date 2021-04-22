function validar(){
	var curso, sede, horario;

	curso = document.getElementById("curso").value;
	horario = document.getElementById("horario").value;
	
	
	if(curso === "" || horario === ""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	
    
} 
