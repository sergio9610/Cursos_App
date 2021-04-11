<?php  

$conexion = mysqli_connect("127.0.0.1:3307", "root", "", "cursos_cunati");
if(!$conexion){
	echo "Error al conectar a la base de datos";
	print("<br>");
}
else{
	echo "Conectado a la base de datos";
	print("<br>");
}


?>