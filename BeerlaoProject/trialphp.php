
    

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
     //$sql="SELECT * FROM `tabletest`";
     //$sqlforcounter="SELECT MAX(counter) FROM `Beerlaotest`";
     
    $sqlforinsertingintwohundredwinner = "INSERT INTO `twohundredwinner`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
    
   $sqlforinsertinginfiftywinner = "INSERT INTO `fiftywinner`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
   
   $sqlforinsertinginLuckyDraw = "INSERT INTO `Luckydraw`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";
   


$sqlforinsertingininvaliduser = "INSERT INTO `InvalidUser`(`Code`, `Phoneno`) VALUES ('$searchparameter',$phonenumbergot)";

    $sql="SELECT * FROM `Beerlaotest` WHERE $columntosearchin = '$searchparameter'";
   
    $sqlforcounter="SELECT * FROM `Beerlaotest` ORDER BY `Beerlaotest`.`counter` DESC";
    $sqlformaxcounter="SELECT counter FROM `Beerlaotest`  ";


$result = $con ->query($sql);

   if($result-> num_rows >0)
    {  
       
        while($row = $result -> fetch_assoc()){
                
               $counter=$row["counter"];
              
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
                 else
                {
              
                }
                
              }
                      // echo $highestcounter;
                       $highestcounter=$highestcounter+1;
                       $sqlforinserting = "UPDATE `Beerlaotest` SET `counter`='$highestcounter' WHERE `Serialno`='$searchparameter'";
                       $resultforinserting=$con->query($sqlforinserting);
                       
                        echo "\n";
                           $once=false;
                           
                           echo "\n";
                           if($highestcounter%50==0)
                           {
                               if($highestcounter%200==0)
                               {
                                    $resultfor200 = $con ->query($sqlforinsertingintwohundredwinner);
                                         echo "Congratulations! you have won  cash prize \n you will be contacted soon.
                        ";
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
                           
                           
                            
                           
                          // echo (int)$highestcounter;
                            echo "\n";
                       if($resultforinserting->num_rows>0)
                       {
                           
                               //echo "inserted";
                                echo "\n";
                           
                       }
                       else
                       {
                           //echo "inserted with no rows";
                            echo "\n";
                       }
              
               }
           
           }
           else
           {
               echo "This code has already been used.Try another code.";
           }
          
        }
        //echo $counter;
        //echo "</table>";
    
    }
    else
    {
     
        $resultforinvaliduser = $con ->query($sqlforinsertingininvaliduser);
        echo "Sorry! you have entered the wrong code try to zap again with the correct code.";
  
  }
  
   
    
    
    $con->close();
    ?>
  
