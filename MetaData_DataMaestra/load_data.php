<?php  
 //load_data.php  
 $connect = mysqli_connect("127.0.0.1:3307", "root", "", "cursos_cunati");  
 $output = ''; 
 $output_2 = ''; 
 if(isset($_POST["curso_id"]))  
 {  
      if($_POST["curso_id"] != '')  
      {  
           $sql = "SELECT * FROM grupo_horario_aux WHERE curso_id = '".$_POST["curso_id"]."'";  
      }  
      else  
      {  
           $sql = "SELECT * FROM grupo_horario_aux";  
      }  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output = $row["grupo_horario"];
           $output_2 = $row["cupos"];  
      }  
      echo $output; 
      echo $output_2; 
 }  
 ?> 