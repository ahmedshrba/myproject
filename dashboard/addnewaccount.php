<?php

require('../include/connect.php');
session_start();
$error="";//message errors 

if(isset($_POST['submit'])){
//after submit    
           $first_name=$_POST['first_name'];
           $last_name=$_POST['last_name'];
           $password=$_POST['password'];
           $email=$_POST['email'];
           $job=$_POST['job'];
           $department=$_POST['department'];           
           $brithday=$_POST['brithday'];
    if(empty(trim($first_name)) ||empty(trim($last_name)) || empty(trim($password)))
        {
        
         $error="no empty feild accepts";

        }
        //check if feild null

    else
      {// if feild not null
        
       $first_name=trim($first_name);
       $last_name=trim($last_name);
       $email=trim($email);
       //white space from start and end


       $first_name=preg_replace('/[^A-Za-z0-9\-]/', '', $first_name);
        $last_name=preg_replace('/[^A-Za-z0-9\-]/', '', $last_name);

       //remove spicial char
       $first_name=strip_tags($first_name);       
       $first_name=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$first_name);
       $first_name=preg_replace("~'~",'',$first_name);
        
       
       $last_name=strip_tags($last_name);
       $last_name=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$last_name);
       $last_name=preg_replace("~'~", '',$last_name);

       $password=strip_tags($password);
       $password=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$password);
       $password=preg_replace("~'~", '',$password);


       $email=strip_tags($email);
       $email=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$email);
       $email=preg_replace("~'~", '',$email);
        
       // remove tags and '


       if(strlen($first_name)<3 || strlen($last_name)<3 ||strlen($password)<8 )
          {
           $error="the fisrt or last name dont accept than 3 and password munt be >7";
          }
          // lenth of first name and last name
        elseif(preg_match('~[0-9]+~', $first_name) || preg_match('~[0-9]+~', $last_name)){
        $error ="first name and last name cant accepts numbers";
        }
        // check if first name or last name contins numbers
        else
          {
              //if all feild ok we will check if already used eamil  

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
             // check if eamil used before
             

             // beging of insert data
             else{
                $user_name="cm_".$first_name."_".rand();
                $password=md5($password);
                

                $insert = "INSERT INTO accounts (first_name, last_name, email,password,user_name,job_title,department,brithday)
                        VALUES ('$first_name',
                           '$last_name',
                           '$email',
                           '$password',
                           '$user_name',
                           '$job',
                           '$department',
                           '$brithday'
                        )";
                
                $insert=$db->prepare($insert);
                $insert->execute();
            
                header('location:../dashboard/addnewaccount.php');


             } // end of insert blok

             

          }//end of the else that checked email and insrting data  
          
      
     }// end of else that started  if feild not null

}// end the main if that started when click submit


?>

<?php

if(isset($_SESSION['first_name']) and $_SESSION['job']!='student' and $_SESSION['job']!='Teacher'){?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/addnewaccountstyle.css">
</head>
<body>
    <div class="maindiv">
        <form method="POST" action="addnewaccount.php">
           
            <div class='error' ><?php echo $error;?></div>
           
            <div class="group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" required >
            </div>
            <div class="group">
                <label for="Last_name">Last_Name</label>
                <input type="text" name="last_name" required>
            </div>
           
            <div class="group">
                <label for="email">Email</label>
                <input type="email" name="email" required >
            </div>
            
            <div class="group">
                <label for="password">Passowrd</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="group">
                <label for="job">Job Title</label>
                <select required name="job" id="job" onclick="check()">
                <option>HOdepartment</option>
                    <option>SADean</option>
                    <option>Dean</option>
                    <option>AHDepartment</option>
                    <option>Teacher</option>
                    <option>student</option>
                </select>
            </div>
            <div class="group">
                <label for="department" id="departmentid">Department</label>
                <select required name="department" id="department">
                    <option>Computer Science</option>
                   <option>multimedia</option>
                </select>
            </div>
            <div class="group">
                <label for="brithday">Brithday</label>
                <input type="date" name="brithday" value="1980-01-01"  min="1900-01-01"  required >
            </div>
            
            <input class="btn" name="submit" type="submit" value="sign up" style="width:20%;padding:10px;margin:20px;font-size:20px">

        </form>
    </div>
</body>
</html> 



<script>

    function check(){
        $job=document.getElementById('job');
        $department=document.getElementById("department");
        $departmentid=document.getElementById("departmentid");

        if($job.value=="Dean" || $job.value=="SADean"){
            $department.style.display="none";
            $departmentid.style.display="none";

        }
        else{
            $department.style.display="block";
            $departmentid.style.display="block";

        }
    }

</script>
<?php }

else{
    header('location:../index.php');
}

?>