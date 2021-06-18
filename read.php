
<?php 
include('include/connect.php');
session_start();

if(!isset($_GET['newsid']) and !isset($_GET['articleid']))
{
    header('location:index.php');
}
if(empty($_GET['newsid']) and empty($_GET['articleid']))
{
    header('location:index.php');
}
if(isset($_GET['newsid'])){
      $id=$_GET['newsid'];
    $select="SELECT *FROM news WHERE id=$id";
    $select=$db->prepare($select);
    $select->execute();
    $select=$select->fetch(pdo::FETCH_ASSOC);
  }
  if(isset($_GET['articleid'])){
    $id=$_GET['articleid'];
  $select="SELECT *FROM articles WHERE id=$id";
  $select=$db->prepare($select);
  $select->execute();
  $select=$select->fetch(pdo::FETCH_ASSOC);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <title>Computer Science</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
       <link rel="stylesheet" href="asset/style.css">

</head>
<body>
<section class="sub-header">
        <nav>
            <a href="index.html"><img src="asset/eduford_img/logo.png"></a>
            <div class="nav-links" id="nav-links">
                <i class="fa fa-times" onclick="hide()"></i>

                <ul>
                <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services/lectures.php">lectures</a></li>
                    <li><a href="#contant">Contant </a></li>
                    <li>
                    <div class="dropdown">
                    <?php if(!isset($_SESSION['first_name'])){
                        ?><?php echo '<button class="dropbtn"><a href="account/login.php">login</a></button>';}
                        
                        else{

                            ?><?php echo "<button class='dropbtn'><a href='account/account.php?id=".$_SESSION['id']."'>".$_SESSION['first_name'].'</a></button>';}
                        
                        
                        ?>
                    <?php if(isset($_SESSION['first_name'])){
                        ?>
                        
                        <?php echo"
                        <div class='dropdown-content'>
                          <a href='services/showvacation.php'>";
                          $job=$_SESSION['job'];
                           if($job=='HOdepartment' ||$job=='AHDepartment' ){
                           
                            $department=$_SESSION['department'];
                            $sql="SELECT *FROM vacation WHERE department='$department' and job!='SADean'and $job='none'";
                            $sql=$db->prepare($sql);
                            $sql->execute();
                            $vacation=$sql->rowCount();
                            
                               echo "vacation <span id='vacation'>". $vacation;
                               echo "<a href='services/addlectures.php?page=1'>"."Lectures</a>";
                           } 
                           elseif($job=='SADean' ||$job=='Dean' ){
                           
                            $department=$_SESSION['department'];
                            $sql="SELECT *FROM vacation WHERE  $job='none'";
                            $sql=$db->prepare($sql);
                            $sql->execute();
                            $vacation=$sql->rowCount();
                               echo "vacation <span id='vacation'>". $vacation;
                               echo "<a href='services/lectures.php?page=1'>"."Lectures</a>";
                           } 
                           else {
                               echo "<a href='services/lectures.php?page=1'>"."Lectures</a>";
                           }
                           
                           echo"</a>
                           <a href='account/logout.php'>logout</a>
                        </div>
                      </div>";
                    }?>
                      </li>
                </ul>
            </div>
            <li class="fa fa-bars" id="bars" onclick="show()"></li>
        </nav>
        
 
    </section>
     <!-- blog -->
     <section class="blog-content">
         <div class="row">
            <div class="blog-left">
                <img src="asset/eduford_img/<?php echo $select['image'];?>" >
                <h2 style="text-align: center;"><?php echo $select['title']?></h2>
                <p> <?php echo $select['content'];?></p>
              
            </div>
        
          
     </section>
     <section class="cta" id="contant">
          <h1>You can contact the college dean directly</h1>
        <a href="" class="hero-btn">CONTACT US</a>
        </section>


        <!-- footer -->
        <section class="footer">
            <h4>About Us</h4>
            <p>Wikipedia is a free online encyclopedia, created and edited by volunteers around the world</p>
        
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
<script>
    function show(){
        nav=document.getElementById('nav-links');
        nav.style.right="0px";
    }
    function hide(){
        nav=document.getElementById('nav-links');
        nav.style.right="-200px";
    }
</script>
</html>