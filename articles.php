<!DOCTYPE html>
<?php 
 include('include/connect.php');
$page=1;
$count=0;
if(!isset($_GET['news']) and !isset($_GET['article']))
 {
     header('location:index.php');
 }


 
if(isset($_GET['news'])){
    $get='news';

    $page=($_GET['news']*2)-2;
    $select="SELECT *FROM news ";
    $select=$db->prepare($select);
    $select->execute();
    $count=$select->rowCount();
    $select="SELECT *FROM news order by id desc LIMIT $page,2 ";
    $select=$db->prepare($select);
    $select->execute();

}
if(isset($_GET['article'])){
    $get='article';
    $page=($_GET['article']*2)-2;
    $select="SELECT *FROM articles ";
    $select=$db->prepare($select);
    $select->execute();
    $count=$select->rowCount();
    $select="SELECT *FROM articles order by id desc LIMIT $page,2 ";
    $select=$db->prepare($select);
    $select->execute();

    $select=$select->fetchAll();

}
  
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Computer Science</title>
   
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" > 
    <link rel="stylesheet" href="asset/style.css">

</head>
<body>
    <section class="sub-header">
        <nav>
            <a href="index.html"><img src="eduford_img/logo.png"></a>
            <div class="nav-links" id="nav-links">
                <i class="fa fa-times" onclick="hide()"></i>

                <ul>
                <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services/lectures.php">lectures</a></li>
                    <li><a href="#contant">Contant </a></li>
                </ul>
            </div>
            <li class="fa fa-bars" id="bars" onclick="show()"></li>
        </nav>
      <h1>Our Cource</h1>
    </section>
    <!--articles-->
    <section class="articles">
        <h1>articless we offer </h1>
        <p>Wikipedia is a free online encyclopedia, created and edited by volunteers around the world </p>
        
        <div class="row">
             <?php 

                     foreach($select as $select){?>
                    <div class="articles-col">
                            <div class="articles-text">
                                   <h3><?php echo $select['title']?></h3>
                                    <p><?php echo substr($select['content'],0,160)."  .......";?>
                                     </p>
                            </div>
                             <div class="articles-info">
                                   <span><?php if(isset($_GET['article'])){echo $select['author'];}echo " ".$select['date'];?></span>
                                    <a href="read.php?articleid=<?php echo $select['id'];?>" class="hero-btn read-btn">read</a>
                            </div>
                    </div>

                     
                  <?php    }?>   
   
        </div > <!-- row --> 
        <nav aria-label="Page navigation example">

<ul class="pagination">

<?php 
    if($count>0)
      {
        for($i=1;$i<($count/2)+1; $i++){?>
         <li class="page-item"><a class="page-link" href="articles.php?<?php echo $get."=";?><?php echo $i;?>"><?php echo $i;?> </a></li>
         <?php } }
         
       
  ?>
</ul>
</nav>

    
    </section>  <!--articles-->
     <!--services-->
     
 
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