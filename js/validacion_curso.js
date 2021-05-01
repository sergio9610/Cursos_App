$(document).ready(function(){  
    $('#curso').change(function(){  
         var curso_id = $(this).val();  
         $.ajax({  
              url:"load_data.php",  
              method:"POST",  
              data:{curso_id:curso_id},  
              success:function(data){  
                   $('#show_grupo').html(data);  
              }  
         });  
    });  
});


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
