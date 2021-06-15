<!DOCTYPE html>
<?php 
 include('include/connect.php');

 $select="SELECT *FROM news";
 $select=$db->prepare($select);
 $select->execute();
 $select=$select->fetchAll();
  
?>
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
            <a href="index.html"><img src="eduford_img/logo.png"></a>
            <div class="nav-links" id="nav-links">
                <i class="fa fa-times" onclick="hide()"></i>

                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Cource</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Contant</a></li>
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
            <div class="articles-col">
                <h3>Intermediate</h3>
                <p>
                    final Fantasy IX is a 2000 role-playing video game
                    developed and published by Squaresoft for the PlayStation video game console.
                    developed and published by Squaresoft for the PlayStation video game console.
                </p>

            </div>
            <div class="articles-col">
                <h3>Degree</h3>
                <p>
                    final Fantasy IX is a 2000 role-playing video game
                    developed and published by Squaresoft for the PlayStation video game console.
                    developed and published by Squaresoft for the PlayStation video game console.
                </p>

            </div>
            <div class="articles-col">
                <h3>Post Graduation</h3>
                <p>
                    final Fantasy IX is a 2000 role-playing video game
                    developed and published by Squaresoft for the PlayStation video game console.
                    developed and published by Squaresoft for the PlayStation video game console.
                </p>

            </div>
           
        </div > <!-- row --> 
    
    
    </section>  <!--articles-->
     <!--services-->
     <section class="services">
      
        <h1>Our services</h1>
        <p>Wikipedia is a free online encyclopedia, created and edited by volunteers around the world </p>

      
        <div class="row row-fac"> 
            <?php    
         
         foreach($select as $row){?>
          
            <div class="services-col">
            
             <img src="<?php echo'asset/eduford_img/'. $row['image'];?>">
             <h3><?php echo $row['title'];?></h3>
             <p><?php echo substr($row['content'], 0, 40).".....";?></p>

       
       
    
            
          
        
       
        </div>
        <?php  }   ?>
        </div>
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