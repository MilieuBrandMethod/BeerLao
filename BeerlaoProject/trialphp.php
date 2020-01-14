
    <?php
    $servername="localhost";
    $username="ayushya";
    $password="passayushya";
    $dbName="databasetestzappar";
    $searchparameter =$_GET['equalswhat'];
    $columntosearchin = $_GET['tablecolumn'];
    $phonenumbergot=$_GET['phonenumber'];
    $con=new mysqli($servername,"$username","$password","$dbName");
    $once=true;
    $counter=0;
    $highestcounter;
    
    if($con ->connect_error)
    {
        die ("connection failed: ".$con -> connect_error);
    }
     $settransaction="SET SESSION ISOLATION LEVEL SERIALIZABLE";
     $resultstart=$con->query($settransaction);
          $maxcounterlock="LOCK TABLES `Beerlaotest` READ ";
          $transaction="START TRANSACTION";
     $resultmax=$con->query($maxcounterlock);
     $resulttrans=$con->query($transaction);
     
    $sqlforinsertingintwohundredwinner = "INSERT INTO `twohundredwinner`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
    
   $sqlforinsertinginfiftywinner = "INSERT INTO `fiftywinner`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
   
   $sqlforinsertinginLuckyDraw = "INSERT INTO `Luckydraw`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
   
$sqlforinsertingininvaliduser = "INSERT INTO `InvalidUser`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
    $sql="SELECT * FROM `Beerlaotest` WHERE $columntosearchin = '$searchparameter'";
   
   
    $sqlformaxcounter="SELECT counter FROM `Beerlaotest`  ";
    $result = $con ->query($sql);
   if($result-> num_rows >0)
    {  
       
        while($row = $result -> fetch_assoc()){
                
               $counter=$row["counter"];
               $lockleave="UNLOCK TABLES";
               $resultleave=$con->query($lockleave);
           if($counter==0)
           {
               echo "Your details have been succesfully captured";
               echo "\n";

               $result1=$con->query($sqlformaxcounter);
              if($result1->num_rows>0)
                {  
                while($row2 = $result1 -> fetch_assoc()){
                if((int)$row2['counter']>$highestcounter)
                {
                     $highestcounter=(int)$row2['counter'];
                 }
               
                
              }

               
                
                       $highestcounter=$highestcounter+1;
                       $sqlforinserting1 = "SELECT `counter` FROM `Beerlaotest` FOR UPDATE";              
                       $sqlforinserting2 = "UPDATE `Beerlaotest` SET `counter`='$highestcounter' WHERE `Serialno`='$searchparameter'";
                       $resultforinserting1=$con->query($sqlforinserting1);
                       $resultforinserting2=$con->query($sqlforinserting2);
                       
                        echo "\n";
                           $once=false;
                           
                           echo "\n";
                           if($highestcounter%50==0)
                           {
                               if($highestcounter%200==0)
                               {
                                    $resultfor200 = $con ->query($sqlforinsertingintwohundredwinner);
                                         echo "Congratulations! you have won  cash prize \n you will be contacted soon.  ";
                               }
                               else
                               {
                                   $resultfor50 = $con ->query($sqlforinsertinginfiftywinner);
                                         echo "Congratulations! you have won  Pepsi prize \n you will be con
                                         tacted soon.";
                                         echo "\n";
                               }
                                
                               
                           }
                           else
                           {
                                $resultforld = $con ->query($sqlforinsertinginLuckyDraw);
                                     echo "Congratulations! you have entered the lucky draw contest.";
                           }
                           
                           
                            
                           
                          
                            echo "\n";
                       if($resultforinserting->num_rows>0)
                       {
                           
                               
                                echo "\n";
                           
                       }
                       else
                       {
                           
                            echo "\n";
                       }
              
               }
           
           }
           else
           {
               echo "This code has already been used.Try another code.";
           }
          
        }

    }
    else
    {
     
        $resultforinvaliduser = $con ->query($sqlforinsertingininvaliduser);
        echo "Sorry! you have entered the wrong code try to zap again with the correct code.";
  
  }
  
 
 
    
    $con->close();
    ?>
  