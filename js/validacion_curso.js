$(document).ready(function(){  
    $('#curso').change(function(){  
         var curso_id = $(this).val();  
         $.ajax({  
              url:"load_data.php",  
              method:"POST",  
              data:{curso_id:curso_id},  
              success:function(data){  
                   $('#show_grupo').html(data); 
                   //$('#show_cupos').html(data);  

              }  
         });  
    });  
});

$(document).ready(function(){  
     $('#curso').change(function(){  
          var curso_id = $(this).val();  
          $.ajax({  
               url:"load_data_2.php",  
               method:"POST",  
               data:{curso_id:curso_id},  
               success:function(data){  
                    $('#show_cupos').html(data);  
               }  
          });  
     });  
 });
 

function validar(){
	var ocupacion, correo, sede, curso;

     ocupacion = document.getElementById("ocupacion").value;
     correo = document.getElementById("correo").value;
     sede = document.getElementById("sede").value;
	curso = document.getElementById("curso").value;
	
	if(ocupacion === "" || correo === "" || sede === "" || curso === ""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	
    
} 
