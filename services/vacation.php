<?php

include('../include/connect.php');
 session_start();

 if(isset($_POST['submit']))
     {
         $department=$_SESSION['department'];
         $first_name=$_SESSION['first_name'];
         $last_name=$_SESSION['last_name'];
         $job=$_SESSION['job'];
         $email=$_SESSION['email'];
         $exam=$_POST['exam'];
         $vacsick=$_POST['vacsick'];
         $date =$_POST['date'];
         $duration=$_POST['duration'];
         //named of inputs

         $vacation_sql="INSERT INTO vacation (first_name,last_name,department,job,exam,illness,duration,date,email)
         
         VALUES('$first_name','$last_name','$department','$job','$exam','$vacsick','$duration','$date','$email')";
         $vacation=$db->prepare($vacation_sql);
         $vacation->execute();
      if($job!='Dean'){
        $email_to_department="SELECT *FROM accounts WHERE department='$department' and job_title='SADean' or job_title='HOdepartment' or job_title='AHDepartment'";
        $email_to_department=$db->prepare($email_to_department);
        $email_to_department->execute();
        $email_to_department=$email_to_department->fetchAll();
        foreach($email_to_department as $email){
            $message="hellow ". $email['first_name']." new vacation ";
            mail($email['email'],"vacation",$message,"From: a@gmail.com");

        }
         
        header('location:../index.php');
      }
      else{
        
        $email_to_department="SELECT *FROM accounts WHERE department='$department' and job_title='SADean'";
        $email_to_department=$db->prepare($email_to_department);
        $email_to_department->execute();
        $email_to_department=$email_to_department->fetch(PDO::FETCH_ASSOC);
        $message="hellow ". $email_to_department['first_name']." iam the dean i have vacation tomoro ";
        mail($email_to_department['email'],"vacation",$message,"From: a@gmail.com");

      }
    }


 ?>

   <?php

   if(isset($_SESSION['first_name'])){
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
   <link rel="stylesheet" href="asset/dashboardstyle.css">
    <title>vacation</title>
</head>
<body>
<form action="vacation.php" class="col-md-6" method="POST">
  <div class="row">
      <div class="form-group col-md-6">
        <label for="" class="col-md-12 col-xs-12">first name</label>
        <input type="text" name="" id="" class="form-control"  placeholder="<?php echo $_SESSION['first_name'];  ?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="" class="col-md-12 col-xs-12">last name</label>
        <input type="text" name="" id="" class="form-control" placeholder="<?php echo $_SESSION['last_name'];  ?>" readonly>
      </div>

  </div>
  <!-- row of name -->
  <div class="row">
      <div class="form-group col-md-6">
        <label for="" class="col-md-12 col-xs-12">Department</label>
        <input type="text" name="" id="" class="form-control  " placeholder="<?php echo $_SESSION['department'];  ?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="" class="col-md-12 col-xs-12">job</label>
        <input type="text" name="" id="" class="form-control" placeholder="<?php echo $_SESSION['job'];  ?>" readonly>
      </div>
      
  </div>
  <!-- row of department and job -->
  
  <div class="row">
      <div class="col-md-6">
          <p>Is there an exam on vacation date ?</p>
      </div>
      <div class="form-check-inline col-md-2">
          <label class="form-check-label " >
              <input type="radio" class="form-check-input" name="exam" value="0" checked>&nbsp;no
          </label>
      </div>
       <div class="form-check-inline col-md-2">
             <label class="form-check-label">
                 <input type="radio" class="form-check-input" name="exam" value="1">&nbsp;yes
             </label>
       </div>
 </div>
 <!-- exam check box -->
 <div class="row">
      <div class="col-md-6">
          <p>do you have vacation sick ?</p>
      </div>
      <div class="form-check-inline col-md-2">
          <label class="form-check-label">
              <input type="radio" class="form-check-input " value="0" name="vacsick" checked>&nbsp;no
          </label>
      </div>
       <div class="form-check-inline col-md-2">
             <label class="form-check-label">
                 <input type="radio" class="form-check-input" value="1" name="vacsick">&nbsp;yes
             </label>
       </div>
 </div>
 <!-- vacation sick  -->
 
 
 
 <div class="row">
   <p class="col-md-6">How long is the vacation?</p>
  <div class="col-md-4 number">
    <input class="form-control" type="number" max="30" name="duration" required>
  </div>
</div>
<!-- duration -->
 
 <div class="row">
      <div class="date">
        <label for="" class="col-md-12 col-xs-12">Date of vacation</label>
        <input type="date" name="date" id="" class="form-control "
         value="<?php echo date('Y-m-d') ?>"
         min="<?php echo date('Y-m-d') ?>"
         
         > 
         <!-- end of input -->
      </div>
 </div>
 
 <!-- vaction date -->

  <div class="submit">
    <input type="submit" name="submit" class="btn  col-md-12 col-xs-12"  value="send">
  </div>

</form>
</body>
</html>





<?php
   }
   else{
       header('location:../account/login.php');
   }
?>

<style>
body{
    background-color: #E1DADA;
}
label{
    text-align: center;
}

.submit{
    text-align: center;
    width: 50%;
    margin: 0 auto;
      
}
form{color: #2C2B2B	;
    background-color: 8E8989	;
    padding: 50PX;
    border-radius:5% ;
   margin-left: 50%;
   transform: translateX(-50%);
   margin-top:70px;
   transform:translateY(-50%,-50%) ;
   box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}
.date{
    
    width: 50%;
    margin: 0 auto;
    margin-bottom: 4%;
}
.number{
    float: left;
}
.btn{
    background-color: #6D5F5F;
    color:white;
    font-size: 20px;
}
.btn:hover{
    background-color: #000080;
    color:white;
}
@media(max-width:700px){
      label,p{
          font-size: 12px;
      }
      form{
        margin-top:10px;
   transform:translateY(-50%,-50%) ;
      }
}
.form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #420D09;
            opacity: 1; /* Firefox */
}

.form-control:-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #420D09;
}

.form-control::-ms-input-placeholder { /* Microsoft Edge */
    color: #420D09;
 }

</style>

