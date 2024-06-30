<?php
    
    include("conexion.php");

      $id=$_GET['id'];

        $objeto->query("delete from usuario where id=$id");


           header("location:admin.php");
     
?>