<!--
    consumption === consomation 
    portion 1 === Tranche1
    portion2 === Tranche 2 
    stamp === timbre
    min == low
    high == max
-->
<?php 
if(filter_has_var(INPUT_POST,"newIndex") && filter_has_var(INPUT_POST,"oldIndex") && isset($_POST["calibreType"])){
    $newIndex = $_POST["newIndex"] ;
    $oldIndex = $_POST["oldIndex"] ;
    $calibre = $_POST["calibreType"] ;
    $consumption = $newIndex - $oldIndex ;
    define("TVA", 0.14);
    define("Stamp", 0.45);
    global $TTC1 ,$TTC2 , $TTCcalibre ,$MHT1,$MHT2,$totalBill ;
    if($calibre == "5-10") $Tarifs = 22.65 ;
    elseif($calibre == "15-20") $Tarifs = 37.05 ;
    else $Tarifs =46.20 ;
    $TTCcalibre = $Tarifs*TVA ;

    class Tranche {
        public $lowest ;
        public $highest ;
        public $Tarif ;
        function __construct($low,$high,$Tarif){
            $this->lowest = $low ;
            $this->highest = $high ;
            $this->Tarif = $Tarif ;
        }
    }
    $TarifsKwh = [
         new Tranche(0 ,100,0.794) ,
         new Tranche(101 ,150,0.883) ,
         new Tranche(151 ,210,0.9451) ,
         new Tranche(211 ,310,1.0489) ,
         new Tranche(311 ,510,1.0489) , 
         new Tranche(511, null ,1.0489) 
    ]; 

    function Cal($tranche){
        echo "hello dfdfd" ;
        $Bill1 = $consumption ;
       
        $MHT1 = $Bill1 * $tranche ;  // the obly parametres that changes is the tranche-->TARIF
        echo "MHT1".$MHT1 ;
        $TTC1 = $MHT1*TVA ;                 // so a function 
        $totalTva = $TTC1 + $TTCcalibre ;
        $TTCtotal = $totalTva + Stamp ;
        $HTtotal = $MHT1 + $Tarifs ;
        $totalBill = $HTtotal + $TTCtotal ;
        echo "<hr>" ;
        echo "this is the fdhfdj".$totalBill ;
        echo "this is the sixth ".$totalBill ;
    }
    // echo "<hr>" ;
    // echo "this is the highest ".$TarifsKwh[0]->highest ;
    // echo "<hr>" ;
    // die ;
    if($consumption > 0){
         if($consumption<= $TarifsKwh[0]->highest){
            //  Cal($TarifsKwh[0]->Tarif) ;
             $Bill1 = $consumption ;
             $MHT1 = $Bill1 * $TarifsKwh[0]->Tarif ;
             $TTC1 = $MHT1*TVA ;
             echo "heloo" ;
        }
        elseif($consumption>= $TarifsKwh[1]->lowest && $consumption< $TarifsKwh[1]->highest){
            $Bill1 = $TarifsKwh[0]->highest ;
            $MHT1 =  $TarifsKwh[0]->highest * $TarifsKwh[0]->Tarif;
            $TTC1 = $MHT1*TVA ;

            $Bill2 = $consumption - $TarifsKwh[0]->highest; 
            $MHT2 = $Bill2 * $TarifsKwh[1]->Tarif ;
            $TTC2 = $MHT2*TVA ;

            $totalTva = $TTC1 + $TTC2 + $TTCcalibre ;
            $HTtotal = $MHT1 + $MHT2 + $Tarifs ;
            $TTCtotal = $totalTva + Stamp ;
            $totalBill = $HTtotal + $TTCtotal ;
            // echo $totalBill ;
        }
        elseif($consumption >= $TarifsKwh[2]->lowest && $consumption <=  $TarifsKwh[2]->highest){
            $Bill1 = $consumption ;
            $MHT1 = $Bill1 *  $TarifsKwh[2]->Tarif ;
            $TTC1 = $MHT1*TVA ;
            $totalTva = $TTC1 + $TTCcalibre ;
            $TTCtotal = $totalTva + Stamp ;
            $HTtotal = $MHT1 + $Tarifs ;
            $totalBill = $HTtotal + $TTCtotal ;
            echo "this is the third ".$totalBill ;
       }
       elseif($consumption >=  $TarifsKwh[3]->lowest && $consumption <=  $TarifsKwh[3]->highest){
        $Bill1 = $consumption ;
        $MHT1 = $Bill1 *  $TarifsKwh[3]->Tarif ;
        $TTC1 = $MHT1*TVA ;
        $totalTva = $TTC1 + $TTCcalibre ;
        $TTCtotal = $totalTva + Stamp ;
        $HTtotal = $MHT1 + $Tarifs ;
        $totalBill = $HTtotal + $TTCtotal ;
        echo "this is the fourth ".$totalBill ;
     }
     elseif($consumption >=  $TarifsKwh[4]->lowest && $consumption <=  $TarifsKwh[4]->highest){
        $Bill1 = $consumption ;
        $MHT1 = $Bill1 * $TarifsKwh[4]->Tarif ;
        $TTC1 = $MHT1*TVA ;
        $totalTva = $TTC1 + $TTCcalibre ;
        $TTCtotal = $totalTva + Stamp ;
        $HTtotal = $MHT1 + $Tarifs ;
        $totalBill = $HTtotal + $TTCtotal ;
        echo "this is the fifth ".$totalBill ;
    }
    elseif( $consumption > $TarifsKwh[5]->lowest){
       
        Cal($TarifsKwh[5]->Tarif) ;
        
    }



    // $totalTva = $TTC1 + $TTC2 + $TTCcalibre ;
    // // echo "total tva =>  ".$totalTva ;
    // $HTtotal = $MHT1 + $MHT2 + $Tarifs ;
    // echo $HTtotal ;
    // $TTCtotal = $totalTva + Stamp ;
    // echo "<hr>" ;
    // echo $TTCtotal ;
    // $totalBill = $HTtotal + $TTCtotal ;
    // echo "<hr>";
    // echo $totalBill;
    // $Bill1 = $consumption ;
    // $MHT1 = $Bill1 * $Tranche5->Tarif ; // the obly parametres that changes is the tranche-->TARIF
    // $TTC1 = $MHT1*TVA ;                 // so a function 
    // $totalTva = $TTC1 + $TTCcalibre ;
    // $TTCtotal = $totalTva + Stamp ;
    // $HTtotal = $MHT1 + $Tarifs ;
    // $totalBill = $HTtotal + $TTCtotal ;
    // echo "this is the sixth ".$totalBill ;

}}
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
        <div id="Hero">
            <h1>Your Electricity Bill</h1>
            <form action="index.php" method="POST">
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
                       <select name="calibreType" id="">
                           <option value="5-10">5-10</option>
                           <option value="15-20">15-20</option>
                           <option value=">30">>30</option>
                       </select>
                        <button id="btn" type="submit">Check</button>
                    </span>
                   
                </div>
                
                    
            </form>
            
            <table class="table table-bordered" >
                <?php  if(isset($_POST["submit"]))
                ?>

            </table>
            
            
        </div>
    
</body>
</html>