<?php 
$error="";
include('../include/connect.php');
session_start();
$style="";
if(!isset($_SESSION['first_name'])){
    header("location:../index.php");
}

if(isset($_POST['submit'])){
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $email=strip_tags($email);
    $email=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$email);
    $email=preg_replace("~'~", '',$email);

    $password=strip_tags($password);
    $password=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$password);
    $password=preg_replace("~'~", '',$password);
    if(empty(trim($email)) ||empty(trim($password)) )
    {
    
     $error="no empty feild accepts";

    }
    elseif(strlen($password)<8){
        $error="password cant be less than 8";
    }
    else{
        
        $check_email = "SELECT * FROM accounts WHERE email='$email'";
        //sql statment
        $check_email=$db->prepare($check_email);
        //prepare statment

        $check_email->execute();
        //execute command

        $check_email=$check_email->rowCount();
       // rowcount 

       if($check_email>0){
           $error ="the email already use";
       }
       else{
        $_SESSION['check']= rand(10000,50000);;
        $_SESSION['newemail']=$_POST['email'];
        $_SESSION['newpassword']=$_POST['password'];
        mail($_SESSION['email'],"check","this check number :".$_SESSION['check'],"from:dfffd");
        ?>
        
        <form action="account.php" method="POST" class="checkform">
        <div class='error' > <?php if(!empty($error))echo $error?></div>

         <h3 style="text-align:center;color:#000080">check you email </h3>
        <div class="form-group">
        <input type="number" name="number" class="form-control checknumber" placeholder="Enter the number you received in the email">
        <input type="submit" name="submitcheck" value="check" class="form-control checkinput input" >
        </div>
        </form>
        <?php
       $style="display:none";
       }
       // check if eamil used before
      
        
    

  }
  }
  if(isset($_POST['submitcheck'])){
    $id=$_SESSION['id'];
    if($_SESSION['check']==$_POST['number']){
        $password=md5($_SESSION['newpassword']);
        $email=$_SESSION['newemail'];
       $sql="UPDATE accounts SET password='$password' , email='$email' WHERE id=$id";
       $sql=$db->prepare($sql);
       $sql->execute();
       header('location:logout.php');

    }
    else{
        $error="the number not correct try again";?>
          
          <form action="account.php" method="POST" class="checkform">
        <div class='error' > <?php if(!empty($error))echo $error?></div>

         <h3 style="text-align:center;color:#000080">check you email </h3>
        <div class="form-group">
        <input type="number" name="number" class="form-control checknumber" placeholder="Enter the number you received in the email">
        <input type="submit" name="submitcheck" value="check" class="form-control checkinput input" >
        </div>
        </form>
        <?php
       $style="display:none";
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
    <form action="account.php" method="POST" style="<?php echo $style?>" >
    <div class='error' > <?php if(!empty($error))echo $error?></div>

      
     
       <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly value="<?php echo $_SESSION['first_name'];?>">
                                </div>
               </div>
               <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly value="<?php echo $_SESSION['last_name'];?>">
                                </div>
                   </div>
       <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label" >User Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly value="<?php echo $_SESSION['user_name'];?>">
                                </div>
           </div>
        
            
               <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label" >Email</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'];?>" >
                                </div>
               </div>
               <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control" name="password">
                                </div>
           </div>
                
             <input type="submit" class="form-control input" name="submit" value="update" >
    </form>
</body>
</html>




<style>
body{
    background-color:#E1DADA;
}
  form{
      width: 60%;
      margin: 0 auto;
      margin-top: 10%;
      min-height: 60vh;
      background-color:8E8989;
      display: flex;
      flex-direction: column;
      justify-content: center;
      box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;  }
.control-label,.form-control {
       color:#2C2B2B	;
      margin-top: 20px;
  }
  .input{
      width: 20%;

      margin: 0 auto;
      margin-top: 5%;
  }
  .input:hover{
      background-color: green;
      color: white;

  }

    .error{
    padding: 10px;
    font-size: 30px; 
    text-align: center; 
    color:  red;
    background-color: #fff;

}
.checkform{
    width: 50%;
    background-color:8E8989;
    display: flex;
    color:#2C2B2B ;
    flex-direction: column;    
}
.checkinput{
  width: 20%;
  margin: 0 auto;

}
.checknumber{
    width: 50%;
    margin: 0 auto;
    margin-bottom: 3%;
}
@media (max-width:700px){
    .checkform{
        width: 80%;
    }
    .checkinput{
  width: 50%;

  margin: 0 auto;

}
}
</style>