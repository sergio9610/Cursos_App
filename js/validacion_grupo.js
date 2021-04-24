function validarGrupo(){
	var curso, sede, 
	curso = document.getElementById("curso").value;
	sede = document.getElementById("sede").value;
	
	
	if(curso === "" || sede === ""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	
    
} 
