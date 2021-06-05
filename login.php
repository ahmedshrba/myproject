<?php

include('connect.php');
     
$user=$db->query("SELECT * FROM accounts")->fetch();
  if(!$user){
      echo"ggg";
  }
  else{
    session_start();

$_SESSION['name']=$user['first_name'];
header('location:index.php');


  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    
</body>
</html>