
    

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
    

   $result = $con ->query($sql);

   if($result-> num_rows >0)
    {  
        //echo "<table><tr><th>1</th><th>2</th></tr>";
        while($row = $result -> fetch_assoc()){
                
               $counter=$row["counter"];
              
           if($counter==0)
           {
               echo "first use of this code";
               echo "\n";
               $resultforhighestcounter=$con->query($sqlforcounter);
               if($resultforhighestcounter->num_rows>0)
               {
                   while($row2=$resultforhighestcounter->fetch_assoc())
                   {if($once==true)
                       {
                           $highestcounter=$row2["counter"];
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
                                         echo "200 winner";
                               }
                               else
                               {
                                   $resultfor50 = $con ->query($sqlforinsertinginfiftywinner);
                                         echo "50 winner";
                               }
                                
                               
                           }
                           else
                           {
                                $resultforld = $con ->query($sqlforinsertinginLuckyDraw);
                                     echo "Lucky Draw";
                           }
                           
                           
                            
                           
                           echo (int)$highestcounter;
                            echo "\n";
                       if($resultforinserting->num_rows>0)
                       {
                           
                               echo "inserted";
                                echo "\n";
                           
                       }
                       else
                       {
                           echo "inserted with no rows";
                            echo "\n";
                       }
                       }
                       
                       
                   }
               }
           
           }
           else
           {
               echo "already used";
           }
          
        }
        //echo $counter;
        //echo "</table>";
    
    }
    else
    {
     
        $resultforinvaliduser = $con ->query($sqlforinsertingininvaliduser);
        //echo "further evaluation";
    }
  
   
    
    
    $con->close();
    ?>
  
