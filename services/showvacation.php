<?php
include('../include/connect.php');
   session_start();
    $sql="";
    if(isset($_GET['accept'])){
       $id=$_GET['accept'];
       $job=$_SESSION['job'];
       $sql1= "UPDATE vacation SET $job='accept' WHERE id=$id";
       $sql1=$db->prepare($sql1);
       $sql1->execute();

    }
    if(isset($_GET['refuse'])){
      $id=$_GET['refuse'];
      $job=$_SESSION['job'];
      $sql1= "UPDATE vacation SET $job='refuse' WHERE id=$id";
      $sql1=$db->prepare($sql1);
      $sql1->execute();

   }

    if(isset($_SESSION['first_name']))
   {
      $job=$_SESSION['job'];
      if($job=='HOdepartment' ||$job=='AHDepartment'  )
        {
                 $department=$_SESSION['department'];
                 $sql="SELECT *FROM vacation WHERE department='$department'";
                 $sql=$db->prepare($sql);
                 $sql->execute();
                 $sql=$sql->fetchAll();
                                  
         
       }
       elseif($job=='Dean' || $job=='SADean')
       {
         $sql="SELECT *FROM vacation";
         $sql=$db->prepare($sql);
         $sql->execute();
         $sql=$sql->fetchAll();
                    
       }
       else
       {
          echo "you cant see this page ";
          header('location:../index.php?error=you cant see this page');
       }
       ?>
       <table border="2">
           <tr>
             <th>Name</th>
             <th>Department</th>
             <th>exam</th>
             <th>illness vacation</th>
             <th>job title</th>
             <th>Head of Department</th>
             <th>Assistant of HOdepartment </th>
             <th>Scientific Assistant Of Dean</th>
             <th>Date</th>
             <th>duration</th>
           
           </tr>
       <?php 
       foreach($sql as $row)
       {  if($row['job']=='none'){

          $none="accept-btn";
       }
       elseif($row['job']=='accept'){
          $none="accept";
       }
       else{
          $none="refuse";
       }

          if($row['exam']==1){$exam="yes";}
          else{$exam="no";}
          if($row['illness']==1){$illness="yes";}
          else{$illness="no";}
          ?>

          <tr>
             <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
             <td><?php echo $row['department'];?></td>
             <td><?php  echo $exam;?></td>
             <td><?php echo $illness;?></td>        
             <td><?php echo $row['job'];?></td>
              <?php   
                
                if($job=='HOdepartment' and $row['job']!='SADean'){
              ?>
                 <td><a href="showvacation.php?accept=<?php echo $row['id'];?>" id="accept-btn">accept</a>
                 <a href="showvacation.php?refuse=<?php echo $row['id'];?>"  id="refuse-btn">refuse</a></td>
               <?php }
               elseif($job=='HOdepartment' and $row['job']=='SADean'){
                  ?>
                  <td>Not valid</td>
                   <?php
               }
               
               
               else {?><td><?php echo $row['hodepartment'];}?></td>
               
               <?php   
               if($job =='AHDepartment'and $row['job']!='SADean'){
                  ?>
                     <td><a href="showvacation.php?accept=<?php echo $row['id'];?>" id="accept-btn">accept</a>
                     <a href="showvacation.php?refuse=<?php echo $row['id'];?>"  id="refuse-btn">refuse</a></td>
                   <?php }
                   elseif($job=='AHDepartment' and $row['job']=='SADean'){
                      ?>
                      <td>Not valid</td>
                       <?php
                   }
                    else {?><td><?php echo $row['ahdepartment'];}?></td>
               
               <?php   
                if($job=='SADean'){
              ?>
               
               <td><a href="showvacation.php?accept=<?php echo $row['id'];?>" id="accept-btn">accept</a>
                 <a href="showvacation.php?refuse=<?php echo $row['id'];?>"  id="refuse-btn">refuse</a></td>
               <?php } else {?><td><?php echo $row['sadean'];}?></td>
               <td><?php echo $row['date'];?></td>
             <td><?php echo $row['duration'];?></td>
           
 
          </tr>
         <?php
       }
   }
   else
   {
      header('location:../index.php');
   }
        

?>








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
    text-align: center;
    font-size: 20px;
 }
#accept-btn{
   
   text-decoration: none;
   background-color: green;
   padding: 10px;
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
   padding: 10px;
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