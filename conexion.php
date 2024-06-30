<?php
try{
    $objeto=new PDO('mysql:host=localhost; dbname=adsi', 'root','');
    $objeto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $objeto->exec("SET CHARACTER SET  utf8");
    echo '';

}catch(Exception $e){
      Die('error' . $e->GetMessage());

}

?>
