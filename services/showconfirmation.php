<?php
include('../include/connect.php');
   session_start();
    $sql="";
    if(isset($_SESSION['first_name']))
    {
       $job=$_SESSION['job'];
       if($job=='HOdepartment' ||$job=='AHDepartment'  )
         {
                  $department=$_SESSION['department'];
                  $sql="SELECT *FROM confirmation WHERE department='$department' order by id DESC";
                  $sql=$db->prepare($sql);
                  $sql->execute();
                  $sql=$sql->fetchAll();
                                   
          
        }   
       
        else
        {
           echo "you cant see this page ";
           header('location:../index.php?error=you cant see this page');
        }
    if(isset($_GET['accept'])){
       $id=$_GET['accept'];
       $accept="accept";
       $sql1= "UPDATE confirmation SET accept='yes' WHERE id=$id";
       $sql1=$db->prepare($sql1);
       $sql1->execute();
       $sql1="SELECT *FROM confirmation WHERE id=$id";
       $sql1=$db->prepare($sql1);
       $sql1->execute();
       $sql1=$sql1->fetch(pdo::FETCH_ASSOC);
       $serial=rand(50000,5000000)-rand(0,400)*3+rand(0,9);
       $message="We assure you that the student :".$sql1['name'].
       " is currently studing in the collage of Computer Science, Department of :"
       .$sql1['department']."
       You can verify the authenticity of this confirmation through the confirmation check service on our website "
       . "serial  number of confirmation  : ".$serial ;
       
       ;
       mail("shrba9696@gmail.com","confirmation",$message,"From: a@gmail.com");
       $sql1= "UPDATE confirmation SET serial='$serial' WHERE id=$id";
       $sql1=$db->prepare($sql1);
       $sql1->execute();
       header("location:showconfirmation.php");

    }
    if(isset($_GET['refuse'])){
      $id=$_GET['refuse'];
      $job=$_SESSION['job'];
      $sql1= "UPDATE confirmation SET accept='no' WHERE id=$id";
      $sql1=$db->prepare($sql1);
      $sql1->execute();

   }


       ?>
       <table border="2">
           <tr>
             <th>Name</th>
             <th>Department</th>
             <th>stage</th>
             <th>email</th>
             <th>receiving</th>
             <th>accept</th>           
             <th>Serial</th>
           </tr>
       <?php 
       foreach($sql as $row)
       {  
             if($row['accept']=="no"){
             }
        ?>

          <tr>
             <td><?php echo $row['name'];?></td>
             <td><?php echo $row['department'];?></td>
             <td><?php  echo $row['stage'];?></td>
             <td><?php echo $row['email'];?></td>        
             <td><?php echo $row['receiving'];?></td>
             <td><?php echo $row['accept'];?></td>
             <td>
             <?php 
             if($job=='AHDepartment' || $job=="HOdepartment" ){
              if($row['accept']=="none"){
              ?>

                 <a href="showconfirmation.php?accept=<?php echo $row['id'];?>" id="accept-btn">accept</a>
                 <a href="showconfirmation.php?refuse=<?php echo $row['id'];?>"  id="refuse-btn">refuse</a></td>
               <?php }
            elseif($row['accept']=="no"){
               echo "this refuse";
            }
            else{
               echo $row['serial'];
            }
            
            }?>
             
             
             

<?php }   }?>







<style>
   body{
      background-color: #dddddd;
   }
 table{
    background-color: #c0c0c0;
    
    margin: 0 auto;
 }
 table tr th{
    background-color: #aaaaaa;
    color: #001f3f;
 }
 table tr th ,td{
    padding: 8px;
    text-align: center;
    font-size: 25px;
    
 }
 
#accept-btn{
   
   text-decoration: none;
   background-color: green;
   padding: 6px;
   color: white;
   border-radius: 50%;

}
#accept-btn:hover{
   background-color: white;
   color: green;
}
#refuse-btn{
   
   text-decoration: none;
   background-color: red;
   padding: 6px;
   color: white;
   border-radius: 50%;

}
#refuse-btn:hover{
   background-color: white;
   color: red;
}
#accept{
   text-decoration: none;
   background-color: white;
   padding: 10px;
   color: green;
   border-radius: 50%;
}
#refuse{
   text-decoration: none;
   background-color: white;
   padding: 10px;
   color: red;
   border-radius: 50%;
}

@media(max-width:700px){
   table{
      display: flex;
      flex-direction: column;
   }
}
</style>