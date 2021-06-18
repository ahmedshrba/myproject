<?php  

session_start();
include('../include/connect.php');
if(isset($_SESSION['first_name'])){
    $error=" ";
    $errorimage=" ";
       
    if(isset($_POST['submit'])){
        $stage=$_POST['stage'];
        $receiving=$_POST['recipient']; 
        $email=$_SESSION['email'];
        $department=$_SESSION['department'];
        $name=$_SESSION['first_name']." ".$_SESSION['last_name'];
        $imagename=$_FILES['image']['name'];
        $imagesize=$_FILES['image']['size'];
        $imagetmpname=$_FILES['image']['tmp_name'];
        $imagetype=$_FILES['image']['type'];
         //image varible
        
        $imageExtensionallowed=array('jpg','gif','png','jpeg');
        // array of types 

        $imageExtension=explode('.',$imagename);
        $imageExtension=end($imageExtension);
        $imageExtension=strtolower($imageExtension);
        $image=rand(10000,5000000)-rand(1,9000).rand(10,90).'.'.$imageExtension;
        //take the type and geniretor name
         

        if(empty(trim($receiving)) ||empty(trim($imagename)) || empty(trim($stage)))
        {
        
         $error="empty dont allowed";

        }
        //check if feild null
         else{
         if(in_array($imageExtension,$imageExtensionallowed))
         {
           if($imagesize>32000000 ){
             $errorimage="image size to big";
           }
           else{

            move_uploaded_file($imagetmpname,'C:\xampp\htdocs\project\myproject\asset\confirmation\\'.$image);
            
            $receiving=trim($receiving);
            
          
           $receiving=preg_replace('/[^A-Za-z0-9\-]/', '', $receiving);
    
    
           $receiving=strip_tags($receiving);       
           $receiving=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$receiving);
           $receiving=preg_replace("~'~",'',$receiving);
            
           $select="SELECT *FROM accounts WHERE department='$department' AND job_title='AHDepartment'";
           $select=$db->prepare($select);
           $select->execute();
           $select=$select->fetch(PDO::FETCH_ASSOC);
           $selectemail= $select['email'];
           
           mail($selectemail,"confirmation","hhhhh","From: a@gmail.com");
       
           
           $insert="insert into confirmation (receiving,name,image,stage,department,email) values ('$receiving','$name','$image','$stage','$department','$email')";
           $insert=$db->prepare($insert);
           $insert->execute();
           if($insert){move_uploaded_file($imagetmpname,'C:\xampp\htdocs\project\myproject\asset\eduford_img\\'.$image);
           } 
           echo $selectemail;

           }
         }//end if that type is in array 
        else{
          $errorimage="type not allowed";
        }//end of else that type of img not in array of type

         }// end else that the inputs not empty
          

    }// end if submit






}//end if login
else{
    header("location:../index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form class="" action="askconfirmation.php" method="POST" enctype="multipart/form-data">
<label class="error"><?php echo $error;?></label>

  <!-- Receiving name -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="text"  class="form-control" name="recipient" />
        <label class="form-label" >Receiving party</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text"  class="form-control" name="name" readonly placeholder="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>" />
        <label class="form-label" >name</label>
      </div>
    </div>
  </div>
 <!-- email and department -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="email"  class="form-control" name="email" readonly placeholder="<?php echo $_SESSION['email'];?>"/>
        <label class="form-label" >Your Email</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text"  class="form-control" name="department" readonly placeholder="<?php echo $_SESSION['department'];?>" />
        <label class="form-label" >department</label>
      </div>
    </div>
  </div>


 <!-- file img -->
    <div class="row">
        <div class="col">
            <div class="form-outline mb-4">
              <input type="file" class="form-control" name="image">
              <label class="form-label"  >upload your picture</label>
              <label class="form label error"><?php echo $errorimage;?></label>

            </div>
        </div>
        <div class="col">
        <div class="form-outline mb-4">
    <input class="form-control"   type="number" min="1" max="4" name="stage">
    <label class="form-label"  >stage</label>
  </div>
        
        
        </div>
    </div>
    <label class="error"><?php echo $errorimage;?></label>


  <!-- articale content -->
  

  

  <!-- Submit button -->
  <button type="submit" name="submit" class="btn  btn-block mb-2">Post</button>
</form>

</body>
</html>




<style>
  body{
    background-color: #EFF0F7;
  }
  button{
    background-color: #9EAAFF;
    color: white;
  }
  form{
    background-color: #E6E8F5;
    -webkit-box-shadow: 0px 10px 13px -7px #000000, 50px 50px 50px 50px rgba(230,232,245,0); 
box-shadow: 0px 10px 13px -7px #000000, 50px 50px 50px 50px rgba(230,232,245,0);
    width: 50%;
    margin: 0 auto;
    margin-top: 2%;
    padding: 20px;
  }
  .form-control:valid{
    background-color: #D1D5ED;
    color: #5E69B2;
  }
  .error{
    color: red;
    border-radius: 10%;
    padding: 5px;
    font-size: 20px;
    
  }
  @media(max-width:700px){
    form{
      width:100%
    }
  }
</style>