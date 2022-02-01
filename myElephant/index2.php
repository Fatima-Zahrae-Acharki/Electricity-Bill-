<?php 
//  filter_has_var(SELECT_POST,"choose")
    if(filter_has_var(INPUT_POST,"newIndex") && filter_has_var(INPUT_POST,"oldIndex") && isset($_POST['choose']) ){
        $old = $_POST["oldIndex"] ;
        $new = $_POST["newIndex"] ;
        $calibre = $_POST["choose"] ;
        global $MHT1,$MHT2,$Tarif ;
        // echo $calibre."<hr>" ;
        $result = $new - $old ;
        define("TVA" , 0.14) ;
        define("TR1" ,0.794 ) ;
        define("TR2" ,0.883 ) ;
        define("TR3" ,0.9451 ) ;
        define("Timbre" ,0.45 ) ;
        // echo $result."<hr>" ;

        if($calibre == "5-10" ){
            $Tarif = 22.65 ;
        }
        elseif($calibre == "15-20"){
             $Tarif =37.05 ;
        }
        elseif($calibre == ">30"){
             $Tarif = 46.20 ;
        }

        if($result > 0){
           if($result < 150 ){

               if($result <=100 ){
                   $Tranche1 = $result ;
                   $MHT1 = $Tranche1*TR1 ;
                   $montantTaxes1 = $MHT1*TVA ;
               }
               else if( $result >100 && $result <= 150){
                $Tranche1 = 100 ;
                $Tranche2 =  $result - 100 ;

                $MHT1 = $Tranche1*TR1 ;
                $montantTaxes1 = $MHT1*TVA ;
                
                $MHT2 = $Tranche2*TR2 ;
                $montantTaxes2 = $MHT2*TVA ;
               }
              
           }
        }
        else{
            echo "recheck your values" ;
        }
        // $total = $MHT1 + $MHT2 + $Tarif ;
        echo  "mht2 :".$MHT2." mht1 : ".$MHT1." tarif : ".$Tarif."<hr>" ;
        echo $Total = $MHT2+$MHT1+$Tarif ;

       

    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Online Electrity Bill</title>
</head>
<body>
    <nav>
        <img id="logo" src="logo.png" alt="">
    </nav>
    <!-- <?php
    //  echo $__SERVER["PHP_SELF"];
     ?> -->
   
        <div id="Hero">
            <h1>Your Electricity Bill</h1>
            <form action="index2.php" method="POST">
                 <div class="inputs">
                    <span>
                        <h5> New : </h5>
                        <input  type="number" name="newIndex">
                    </span>
                    <span>
                        <h5>Old :</h5>
                        <input type="number" name="oldIndex">
                    </span>
                    <span>
                        <h5>Calibre :</h5>
                       <select name="choose" id="">
                           <option value="5-10">5-10</option>
                           <option value="15-20">15-20</option>
                           <option value=">30">>30</option>
                       </select>
                        <button id="btn" type="submit">Check</button>
                    </span>
                   
                </div>
                
                    
            </form>
            
            
        </div>
    
</body>
</html>

<!-- 
total 

37.05*0.14 = 5.19



 -->