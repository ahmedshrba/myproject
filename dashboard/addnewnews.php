<?php


session_start();
   include('../include/connect.php');  

// ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
// ini_set('display_errors', 0); // disable error display
// ini_set('log_errors', 0); // disable error logging

   if(isset($_SESSION['job']) and $_SESSION['job']!='student')
      {
   
  
        $errorimage="";
        $error="";
    if(isset($_POST['submit'])){
        $title=$_POST['title'];
        $news=$_POST['news'];
        $date=Date('Y/m/d');
        
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
         

        if(empty(trim($title)) ||empty(trim($imagename)) || empty(trim($news)))
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

            move_uploaded_file($imagetmpname,'C:\xampp\htdocs\project\myproject\asset\eduford_img\\'.$image);
            $title=trim($title);
            $news=trim($news);
            
           $title=preg_replace('/[^A-Za-z0-9\-]/', '', $title);
           $news=preg_replace('/[^A-Za-z0-9\-]/', '', $news);
    
    
           $title=strip_tags($title);       
           $title=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$title);
           $title=preg_replace("~'~",'',$title);
            
           
           $news=strip_tags($news);       
           $news=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$news);
           $news=preg_replace("~'~",'',$news);
           
           $insert="insert into news (title,date,image,content) values ('$title','$date','$image','$news')";
           $insert=$db->prepare($insert);
           $insert->execute();
           move_uploaded_file($imagetmpname,'C:\xampp\htdocs\project\myproject\asset\eduford_img\\'.$image);
            header('location:addnewnews.php');           

           }
         }//end if that type is in array 
        else{
          $errorimage="type not allowed";
        }//end of else that type of img not in array of type

         }// end else that the inputs not empty
          

    }// end if submit
  }//if login
  else{
    header('location:../index.php');
   }//if not login


?>
   






   




   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Add New News</title>
</head>
<body>
<form method="POST" action="addnewnews.php" enctype="multipart/form-data">
  <!-- title  -->
 
       <label class="error"><?php echo $error?></label>
      <div class="form-outline">
        <input type="text" name="title" class="form-control" />
        <label class="form-label" >Title</label>
      </div>
  
 <!-- file img -->

  <div class="form-outline mb-4">
    <label class="error"><?php echo $errorimage;?></label>
    <input type="file" name="image" class="form-control">
    <label class="form-label"  >Image</label>
  </div>


  <!-- articale content -->
  <div class="form-outline mb-4">
    <textarea class="form-control"  name="news" rows="4"></textarea>
    <label class="form-label"  >news content</label>
  </div>

  

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
  .error{
    color: red;
    border-radius: 10%;
    padding: 5px;
    font-size: 20px;
    
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
  @media(max-width:700px){
    form{
      width:100%
    }
  }
</style>

