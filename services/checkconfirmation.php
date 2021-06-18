<?php

 include('../include/connect.php');
   $count=0;
   $error="";
   if(isset($_POST['submit'])){
     $search=$_POST['search'];
      $sql="SELECT *FROM confirmation WHERE serial LIKE '%$search%'";
      $sql=$db->prepare($sql);
      $sql->execute();
      $count=$sql->rowCount();
      $sql=$sql->fetch(PDO::FETCH_ASSOC);
      if($count==0){
        $error="not found";
        
      }       
    }



 ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet">
    <title>check confirmation</title>
</head>
<body>
<div class="wrap">
 <form action="checkconfirmation.php" method="POST">
   <div class="search">
      <input type="number" class="searchTerm" placeholder="put the serial number here " name="search">
      <button type="submit" class="searchButton" name="submit">
        <i class="fa fa-search"></i>
     </button>
   </div>
 </form>
</div>


<?php if(!empty($error)){
 echo "<h1 style='text-align: center;'>".$error."</h1>";


}?>
<?php 

 if($count>0){
   ?>

<div class="main" >
     <div class="first">
     <img src="../asset/eduford_img/logo.png">
     <p>computer science and information technology</p>
     </div>
    <h3>confirmation for <span> <?php echo $sql['receiving'];?></span> </h3>
    <div class="image"><img src="../asset/confirmation/<?php echo $sql['image'];?>"></div>
    
    <p>We assure you that the student : <span><?php echo $sql['name']?></span>
        is currently studing in the collage of Computer Science, Department of :<span> <?php echo $sql['department']?></span></p>


      <h4 class="serial">
       You can verify the authenticity of this confirmation through the confirmation check service on our website 
       serial  number of confirmation  :  <?php echo $sql['serial'];?></h4>

</div>

 <?php }?>


</body>
</html>


<style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap{
  width: 30%;
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.first{
  display:grid;
  margin-left: 20%;
  grid-template-columns: 20% 80%;
}
.first img{
    
    width: 150px;
}
p{
    font-size: 19px;
}
.first p{
    font-weight: 700;
    font-size:13px;
    line-height:80px;
}
h3{
    text-align: center;
}
span{
    color: red;
}
.serial{
    font-size: 13px;
font-family: 'Source Code Pro', monospace;}
.main{
    background-color: white;
    max-width: 60%;
    padding: 80px;
    padding-bottom: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 10%;
    transform: translate(-50%);
    
}
.image{

    width: 150px;
    margin: 0 auto;
}
.image img{
    padding: 2px;
    width: 100%;
    background-color:#00B4CC;
    height: 100px;
    border-radius: 20%;
}
</style>