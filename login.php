<?php

include("include/connect.php");


if(isset($_POST['submit'])){

    $user_name=$_POST['user_name'];
    $password=$_POST['password'];


    $user_name=strip_tags($user_name);
    $user_name=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$user_name);
    $user_name=preg_replace("~'~", '',$user_name);

    $password=strip_tags($password);
    $password=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$password);
    $password=preg_replace("~'~", '',$password);
      // remove tags and '

$login="SELECT * FROM accounts WHERE user_name='$user_name' and password='$password'";

    $login=$db->prepare($login);
    $login->execute();
     $count=$login->rowCount();
    if($count>0){

    $account=$login->fetch(PDO::FETCH_ASSOC);
    session_start();
     
    $_SESSION['fisrt_name']=$account['first_name'];

     header('location:index.php');


       }


}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <form class="form-signin" method="POST" action="login.php">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="text" class="form-control" name="user_name" placeholder="Email Address" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
    
      <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="login">   
    </form>
  </div>

</body>
</html>


<style>
 body{
     background-color: #eee;
 }
.wrapper {
  margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.1);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 30px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type=text] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type=password] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>