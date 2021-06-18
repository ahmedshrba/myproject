<?php

   include('../include/connect.php');
  $page=1; 
   $filter=0;
   
   
   if(isset($_GET['page']))
       {
         $page=$_GET['page'];
         $page=($page*10)-10;
       }
       if(isset($_GET['science'])){
        $page=($_GET['science']*10)-10;
        $lecture="SELECT *FROM lectures  WHERE department ='Computer Science'";
        $lecture=$db->prepare($lecture);
        $lecture->execute();
        $count=$lecture->rowCount();
        $lecture="SELECT *FROM lectures  WHERE department ='Computer Science'  LIMIT $page,10 ";
        $lecture=$db->prepare($lecture);
        $lecture->execute();
    
        $lecture=$lecture->fetchAll();

       }
       elseif(isset($_GET['multimedia'])){
        $page=($_GET['multimedia']*10)-10;
        $lecture="SELECT *FROM lectures WHERE department ='multimedia'";
        $lecture=$db->prepare($lecture);
        $lecture->execute();
        $count=$lecture->rowCount();
        $lecture="SELECT *FROM lectures WHERE department ='multimedia' ORDER BY id DESC LIMIT $page,10";
        $lecture=$db->prepare($lecture);
        $lecture->execute();
    
        $lecture=$lecture->fetchAll();

       }
       else{
         if(isset($_GET['page'])){ $page=($_GET['page']*10)-10;
         }
         else{$page=1;}
        $lecture="SELECT *FROM lectures ";
        $lecture=$db->prepare($lecture);
        $lecture->execute();
        $count=$lecture->rowCount();
        $lecture="SELECT *FROM lectures ORDER BY id DESC  LIMIT $page,10";
        $lecture=$db->prepare($lecture);
        $lecture->execute();
    
        $lecture=$lecture->fetchAll();
     
       }
    
       if(isset($_POST['search'])){
       $count=0;
        $search=$_POST['search'];
        $search=trim($search);
       $search=strip_tags($search);
       $search=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$search);
       $search=preg_replace("~'~", '',$search);
   
       $lecture="SELECT *FROM lectures  WHERE  department LIKE '%$search' or name LIKE '%$search%' or teacher LIKE '%$search%' ";
       $lecture=$db->prepare($lecture);
       $lecture->execute();
   
       $lecture=$lecture->fetchAll();
      }

   $arr=array('table-primary','table-secondary','table-success','table-danger','table-warning');





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form action="lectures.php" method="POST">
<div class="input-group rounded">
  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
    aria-describedby="search-addon" name="search" />
  <span class="input-group-text border-0" id="search-addon">
    <i class="fa fa-search"></i>
  </span>
</div>  
</form>
<div class="btndiv">


<a href="lectures.php?multimedia=1" name="multimedia" class="btna" >multimedia</a>
  <a href="lectures.php?science=1" name="science" class="btna">computer science</a>
  <a href="lectures.php?page=1" name="science" class="btna">all</a>
 
</div>



<div class="table">
<table class="table  table-dark" border="2">
<tr class="table-dark">
  <th >licture name</th>
  <th >teacher name</th>
  <th>department</th>
  <th>number</th>
  <th>stage</th>
  <th>file</th>
</tr>
<?php
   foreach($lecture as $lecture){
       
       ?>
<tr >
  
   <td class="<?php echo $arr[0];?>"><?php echo $lecture['name'];?></td>
   <td class="<?php echo $arr[1];?>"><?php echo $lecture['teacher'];?></td>
   <td class="<?php echo $arr[2];?>"><?php echo $lecture['department'];?></td>
   <td class="<?php echo $arr[3];?>"><?php echo $lecture['number'];?></td>
   <td class="<?php echo $arr[4];?>"><?php echo $lecture['stage'];?></td>
   <td class="<?php echo $arr[0];?>"><a href="lectures/<?php echo $lecture['file'];?>">pdf</a></td>
</tr>
<?php }?>
</table>
<nav aria-label="Page navigation example">

  <ul class="pagination">

  <?php 
      if($count>0){
        if(isset($_GET['multimedia'])){
          for($i=1;$i<($count/10)+1; $i++){?>
           <li class="page-item"><a class="page-link" href="lectures.php?multimedia=<?php echo $i;?>"><?php echo $i;?> </a></li>
           <?php } }
           
           elseif(isset($_GET['science'])){
             for($i=1;$i<($count/10)+1; $i++){?>
              <li class="page-item"><a class="page-link" href="lectures.php?science=<?php echo $i;?>"><?php echo $i;?> </a></li>
              <?php } }
       
       else{
         for($i=1;$i<($count/10)+1; $i++){?>
          <li class="page-item"><a class="page-link" href="lectures.php?page=<?php echo $i;?>"><?php echo $i;?> </a></li>
          <?php } }
           
           
      }
    ?>
  </ul>
</nav>
</div>

</body>
</html>

<style>
  .table{
      width: 80%;
      margin: 0 auto;
  }
  table tr th,td{
      border: 1px solid black;
      text-align: center;
  }
.pagination{
    width:50%;
    margin: 0 auto;
}
form{ width: 25%;
  margin-top: 3%;
  margin-left:50%;
  transform: translate(-50%);
  margin-bottom: 30px;
}
.btndiv{
  width: 25%;
  margin-top: 3%;
  margin-left:50%;
  transform: translate(-50%);
  margin-bottom: 30px;

}
.btna{
   
   text-decoration: none;
   background-color: green;
   padding: 16px;
   color: white;
   border-radius: 20%;
   margin-top: 30px;

}
</style>



