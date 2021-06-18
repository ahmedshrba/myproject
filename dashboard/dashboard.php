
<?php
error_reporting(0);

  include('../include/connect.php');
$row="s";
  if(isset($_GET['article'])){
    $get='article';
    $page=($_GET['article']*10)-10;
    $row="SELECT *FROM articles ";
    $row=$db->prepare($row);
    $row->execute();
    $count=$row->rowCount();
    $row="SELECT *FROM articles order by id desc LIMIT $page,10";
    $row=$db->prepare($row);
    $row->execute();

    $row=$row->fetchAll();

   }
if(isset($_GET['news'])){
    $get='news';

    $page=($_GET['news']*10)-10;
    $row="SELECT *FROM news ";
    $row=$db->prepare($row);
    $row->execute();
    $count=$row->rowCount();
    $row="SELECT *FROM news order by id desc LIMIT $page,10 ";
    $row=$db->prepare($row);
    $row->execute();

    $row=$row->fetchAll();

   }
  
if(isset($_POST['newssearch'])){
      $count=0;
    $search=$_POST['newssearch'];
    $search=trim($search);
   $search=strip_tags($search);
   $search=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$search);
   $search=preg_replace("~'~", '',$search);

   $row="SELECT *FROM news  WHERE  title LIKE '%$search%'";
   $row=$db->prepare($row);
   $row->execute();

   $row=$row->fetchAll();
          }
 if(isset($_POST['articlesearch'])){
            $count=0;
          $search=$_POST['articlesearch'];
          $search=trim($search);
         $search=strip_tags($search);
         $search=preg_replace('#<script(.*?)>(.*?)</script>#is', '',$search);
         $search=preg_replace("~'~", '',$search);
      
         $row="SELECT *FROM articles  WHERE  title LIKE '%$search%'";
         $row=$db->prepare($row);
         $row->execute();
      
         $row=$row->fetchAll();
                }


   if(isset($_GET['articledelete'])){
       $id=$_GET['articledelete'];
    $delet="DELETE FROM articles WHERE id=$id";
    $delet=$db->prepare($delet);
    $delet->execute();
    header("location:dashboard.php?article=1");
   }
   if(isset($_GET['newsdelete'])){
    $id=$_GET['newsdelete'];
 $delet="DELETE FROM news WHERE id=$id";
 $delet=$db->prepare($delet);
 $delet->execute();
 header("location:dashboard.php?news=1");
}



$arr=array('table-primary','table-secondary','table-success','table-danger','table-warning');










?>








<?php 
    session_start();
   if(isset($_SESSION['first_name']) and $_SESSION['job']!='student' ){?>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../asset/dashboardstyle.css">
    <title>dashbord</title>
</head>
<body>
    
    <div class="container-fluid">
       
       <div class="row">
           <div class="col-sm-2 bg-dark">
                 <h1>dashboard</h1>
                 <ul  id="panel-menu"class="nav nav-pills nav-stacked">
                   
                     <li class="">
                         <a href="dashboard.php?news=1">
                             
                             <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                             
                              news
                        </a>
                    </li>
                     <li>
                         <a href="dashboard.php?article=1">
                             
                             <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                             
                               article
                        </a>
                     </li>
                    
                     <li>
                         <a href="addnewaccount.php">
                             
                             <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                             
                             Add new account
                        </a>
                    </li>
                     <li>
                         <a href="../account/logout.php">
                              
                              <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                              
                             Logout
                        </a>
                    </li>
                 
                 </ul>
           </div>
           <!-- ending of panels -->
           <div class="col-sm-10">
           

           <form action="dashboard.php" method="POST">
<div class="input-group rounded">
  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
    aria-describedby="search-addon" name="<?php echo $get."search";?>"/>
  
</div>  
</form>
<?php
 
?>

<div class="table">
<table class="table  table-dark" border="2">
<tr><th colspan="4"><?php  if(isset($_GET['news'])){?><a href="addnewnews.php">add news</a><?php } 
   if(isset($_GET['article'])){?><a href="addnewarticle.php">add article</a><?php }  ?></th></tr>
<tr class="table-dark">
  <th >title</th>
  <th>content</th>
  <th>date</th>
  <th>action</th>
</tr>
<?php
   foreach($row as $row){
       
       ?>
<tr >
  
   <td class="<?php echo $arr[0];?>"><?php echo $row['title'];?></td>
   <td class="<?php echo $arr[2];?>"><?php echo substr($row['content'],0,100)." ....";?></td>
   <td class="<?php echo $arr[4];?>"><?php echo $row['date'];?></td>
   <td class="<?php echo $arr[0];?>"><a href="dashboard.php?<?php echo $get."delete="?><?php echo $row['id']?>">Delete</a></td>
</tr>
<?php }?>
</table>
<nav aria-label="Page navigation example">

  <ul class="pagination">

  <?php 
      if($count>0){
        if(isset($get)){
          for($i=1;$i<($count/10)+1; $i++){?>
           <li class="page-item"><a class="page-link" href="dashboard.php?<?php echo $get."=";?><?php echo $i;?>"><?php echo $i;?> </a></li>
           <?php } }}
           
         
    ?>
  </ul>
</nav>
</div>
           </div>
           <!-- ending of main area -->
       </div>
                  <!-- ending of main row -->

       
        
    </div>
               <!-- ending of contanir -->
  
  
  <?php }

 else{
     header('location:../index.php');
 }

?>
     <section class="footer">
            <h4>About Us</h4>
            <p>Computer Science and Information Technology/Al-Qadisiyah University ,Founded in 2007</p>
        
            <div class="icons">
                <i class="fa fa-facebook"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-linkedin"></i>
                <i class="fa fa-whatsapp"></i>

            </div>
             <p>made with <i class="fa fa-heart-o"></i> by Ahmed Shrba
             </p>
        </section>
</body>
</html>









<style>


  .table{
      width: 80%;
      margin: 0 auto;
      margin-top: 8%;
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
  margin-top: 10%;
  margin-left:50%;
  transform: translate(-50%);
  margin-bottom: 30px;
}

</style>