function validar(){
	var curso, sede, horario;

	curso = document.getElementById("curso").value;
	sede = document.getElementById("sede").value;
	horario = document.getElementById("horario").value;
	
	
	if(curso === "" || sede === "" || horario === ""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	
    
} 
