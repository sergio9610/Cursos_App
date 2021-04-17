<?php

class Database extends PDO{
    public function __construct(){
        try{
            parent::__construct('mysql:host=127.0.0.1:3307; dbname=cursos_cunati','root','');
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $ex){
            echo $ex . '<br>';
            die('Error al conectar a la base de datos. ');
        }
    }
}