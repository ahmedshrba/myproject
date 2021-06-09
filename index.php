<?php
session_start();

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
    <section class="header">
        <nav>
            <a href="index.html"><img src="asset/eduford_img/logo.png"></a>
            <div class="nav-links" id="nav-links">
                <i class="fa fa-times" onclick="hide()"></i>

                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="Cource.html">Cource</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="#contant">Contant </a></li>
                    <li>
                    <div class="dropdown">
                    <?php if(!isset($_SESSION['fisrt_name'])){
                        ?><?php echo '<button class="dropbtn"><a href="login.php">login</a></button>';}
                        
                        else{

                            ?><?php echo '<button class="dropbtn"><a href="kkk.php">'.$_SESSION['fisrt_name'].'</a></button>';}
                        
                        
                        ?>
                    <?php if(isset($_SESSION['fisrt_name'])){
                        ?>
                        
                        <?php echo'
                        <div class="dropdown-content">
                          <a href="#">Link 1</a>
                          <a href="#">Link 2</a>
                          <a href="logout.php">logout</a>
                        </div>
                      </div>';
                    }?>
                      </li>
                </ul>
            </div>
            <li class="fa fa-bars" id="bars" onclick="show()"></li>
        </nav>
        <div class="text-box">
            <h1>Computer Science and Information Technology</h1>
            <p>
                Computer science is the study of algorithmic processes, computational machines and computation itself.  </p>
            <a href="" class="hero-btn">Watch a video to know more</a>
        </div>
 
    </section>
    <!--articles-->
    <section class="articles">
        <h1>Professors' articles</h1>
        <p>Articles written by the faculty in a simplified way directed to students of primary studies</p>
        
        <div class="row">

            <div class="articles-col">
               <div class="articles-text">
                <h3>How explainable artificial intelligence can help humans innovate</h3>
                <p>
                    AI algorithms can solve hard problems and learn incredible tasks,
                     but they can't explain how they do these things.
                     If researchers can build explainable AI, it could lead to a flood of new knowledge.
                     AI algorithms can solve hard problems and learn incredible tasks,
                     but they can't explain how they do these things.
                     If researchers can build explainable AI, it could lead to a flood of new knowledge.
                </p>
               </div>
                <div class="articles-info">
                    <span>writen by Ahmed kreem 2020/4/5</span>
                    <a href="read" class="hero-btn read-btn">read</a>
                   </div>
            </div>
            <div class="articles-col">
                <div class="articles-text">
                 <h3>How explainable artificial intelligence can help humans innovate</h3>
                 <p>
                     AI algorithms can solve hard problems and learn incredible tasks,
                      but they can't explain how they do these things.
                      If researchers can build explainable AI, it could lead to a flood of new knowledge.
                 </p>
                </div>
                 <div class="articles-info">
                     <span>writen by Ahmed kreem 2020/4/5</span>
                     <a href="read" class="hero-btn read-btn">read</a>
                    </div>
             </div>
             <div class="articles-col">
                <div class="articles-text">
                 <h3>How explainable artificial intelligence can help humans innovate</h3>
                 <p>
                     AI algorithms can solve hard problems and learn incredible tasks,
                      but they can't explain how they do these things.
                      If researchers can build explainable AI, it could lead to a flood of new knowledge.
                 </p>
                </div>
                 <div class="articles-info">
                     <span>writen by Ahmed kreem 2020/4/5</span>
                     <a href="read" class="hero-btn read-btn">read</a>
                    </div>
             </div>
           
        </div > 
        <!-- row --> 
        <h3><a href="" class="hero-btn read-btn">show more</a></h3>
    
    </section>  <!--articles-->

    <!--news-->
    <section class="news">
        <h1>top news</h1>
        <p>Wikipedia is a free online encyclopedia, created and edited by volunteers around the world </p>
        
        <div class="row">
            <div class="news-col">
                <img src="asset/eduford_img/london.png" >
                <div class="layer">
                    <h3><a href=" " class="hero-btn read-btn news-btn">read</a></h3>
                </div>
                <p>The launch of the activities of the third international scientific conference of the department</p>
            </div>
            <div class="news-col">
                <img src="asset/eduford_img/newyork.png" >
                <div class="layer">
                    <h3><a href=" " class="hero-btn read-btn news-btn">read</a></h3>
                </div>
                <p>A training course for teachers and graduate students in the Department of Computer Science</p>
            </div>
            <div class="news-col">
                <img src="asset/eduford_img/washington.png" >
                <div class="layer">
                    <h3><a href=" " class="hero-btn read-btn news-btn">read</a></h3>
                    
                </div>
                <p>A training course for teachers and graduate students in the Department of Computer Science</p>

            </div>
        </div>  <!--row-->

    </section><!--news--> 

    <!--services-->
    <section class="services">
            <h1>Online services</h1>
            <p>A smart electronic library that facilitates the student to access many sources <br>
                Lesson discussion platform with professors
                 </p>
   
            <div class="row">
                <div class="services-col">
                    <img src="asset/eduford_img/library.png" alt="">
                    <h3>the Library</h3>
                    <p>A smart electronic library that facilitates the student to access many sources </p>

                </div>
                <div class="services-col">
                    <img src="asset/eduford_img/cafeteria.png" alt="">
                    <h3>Lesson discussion platform</h3>
                    <p>Where you can ask questions and discuss lectures with professors and students</p>

                </div>
                <div class="services-col">
                    <img src="asset/eduford_img/projects-logo.jpg" alt="">
                    <h3>Graduation Projects</h3>
                    <p>Students' graduation projects in previous years
                        Helping the student to find creative ideas</p>
                </div>
            </div>
        </section>
        <!--OutStanding-students-->
        <section class="OutStanding-students">
            <h1>OutStanding students</h1>
            <p>OutStanding students are selected according to grades, daily activities, and attendance</p>
   
             <div class="row">
                 <div class="OutStanding-students-col">
                     <img src="asset/eduford_img/user1.jpg">
                     <div>
                        <p>Department of Computer Science average 70%<br>The best in programming </p>
                        <h3>Sara Mohmmed</h3>
                     

                    </div>
                 </div>
                 <div class="OutStanding-students-col">
                    <img src="asset/eduford_img/user2.jpg">
                    <div>
                       <p>Multimedia department, average 75%<br>the best in artificial intelligence</p>
                       <h3>Ahmed kreem</h3>
                     
                   </div>
                  
                </div>
                 
             </div>  <!-- row -->
        </section>
      <!-- call to action -->
      <section class="cta" id="contant">
          <h1>You can contact the college dean directly</h1>
        <a href="" class="hero-btn">CONTACT US</a>
        </section>

        <!-- About us section -->
       

        <!-- footer -->
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