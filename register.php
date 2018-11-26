<?php
    $db = new PDO('sqlite:news.db');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $conf = $_POST['conf'];
    $stmt = $db->prepare('SELECT * FROM User where username=?');
    $users = $stmt->execute(array($name));

    
    if($name == "" || $name == null){
        echo"<script language='javascript' type='text/javascript'>alert('username field must not be empty');window.location.href='register.html';</script>";
    }
    else if($pass != $conf){
        echo"<script language='javascript' type='text/javascript'>alert('the value of password is different');window.location.href='register.html';</script>";
    }

    else{
      if(empty($users)){

        $stmt2 = db->prepare('INSERT INTO Users VALUES (?,?,?,?)');
        $stmt2->execute(array($name, sha1($pass), $email, 19));
         
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='register.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='register.html'</script>";
        }
 
      }
      else{
        echo"<script language='javascript' type='text/javascript'>alert('That username already exists');window.location.href='register.html';</script>";
        die();
      }
    }

?>