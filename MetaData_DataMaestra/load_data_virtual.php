<?php  
 //load_data.php  
 $connect = mysqli_connect("127.0.0.1:3307", "root", "", "cursos_cunati");  
 $output = '';  
 if(isset($_POST["curso_id"]))  
 {  
      if($_POST["curso_id"] != '')  
      {  
           $sql = "SELECT * FROM grupo_horario_virtual_aux WHERE curso_id = '".$_POST["curso_id"]."'";  
      }  
      else  
      {  
           $sql = "SELECT * FROM grupo_horario_virtual_aux";  
      }  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
          $output .= '<h5>Horario</h5>'.'<p>'.$row["grupo_horario"].'</p>';
     }  
      echo $output;  
 }  
 ?> 