<?php  

session_start();
include('../include/connect.php');
if(isset($_SESSION['first_name']) and $_SESSION['job']!='student'){
    $error=" ";
    $errorfile=" ";
       
    if(isset($_POST['submit'])){
        $stage=$_POST['stage'];
        $number=$_POST['number'];
        $name=$_POST['name'];
        $department=$_SESSION['department'];
        $teacher=$_SESSION['first_name']." ".$_SESSION['last_name'];
        $filename=$_FILES['file']['name'];
        $filesize=$_FILES['file']['size'];
        $filetmpname=$_FILES['file']['tmp_name'];
        $filetype=$_FILES['file']['type'];
        
         //file varible
        
        $fileExtensionallowed=array('pdf');
        // array of types 

        $fileExtension=explode('.',$filename);
        $fileExtension=end($fileExtension);
        $fileExtension=strtolower($fileExtension);
        $file=rand(10000,5000000)-rand(1,9000).rand(10,90).'.'.$fileExtension;
        //take the type and geniretor name
         
       echo $name;
        if(empty(trim($name)) ||empty(trim($filename)) || empty(trim($stage))  || empty(trim($number)))
        {
        
         $error="empty dont allowed";

        }
        //check if feild null
         else{
         if(in_array($fileExtension,$fileExtensionallowed))
         {
           if($filesize>80000000 ){
             $errorfile="file size to big";
           }
           else{

            move_uploaded_file($filetmpname,'C:\xampp\htdocs\project\myproject\services\lectures\\'.$file);
            
           
           $insert="insert into lectures (name,department,stage,teacher,number,file) values ('$name','$department','$stage','$teacher','$number','$file')";
           $insert=$db->prepare($insert);
           $insert->execute();
           header('../index.php');
           if($insert){move_uploaded_file($filetmpname,'C:\xampp\htdocs\project\myproject\asset\eduford_img\\'.$file);
           } 
           
           
           

            }
         }//end if that type is in array 
        else{
          $errorfile="type not allowed";
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
<form class="" action="addlectures.php" method="POST" enctype="multipart/form-data">
<label class="error"><?php echo $error;?></label>

  <!-- Receiving name -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="name"  class="form-control" name="name" />
        <label class="form-label" >Lectures name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text"  class="form-control" name="teacher" readonly placeholder="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>" />
        <label class="form-label" >name</label>
      </div>
    </div>
  </div>
 <!-- email and department -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="number"  class="form-control" name="number" />
        <label class="form-label" >number of Lectures</label>
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
              <input type="file" class="form-control" name="file" accept="application/pdf">
              <label class="form-label"  >upload your file</label>
              <label class="form label error"><?php echo $errorfile;?></label>

            </div>
        </div>
        <div class="col">
        <div class="form-outline mb-4">
    <input class="form-control"   type="number" min="1" max="4" name="stage">
    <label class="form-label"  >stage</label>
  </div>
        
        
        </div>
    </div>
    <label class="error"><?php echo $errorfile;?></label>


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