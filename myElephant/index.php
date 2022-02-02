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
        $Tranche1 = new Tranche(0 ,100,0.794) ,
        $Tranche2 = new Tranche(101 ,150,0.883) ,
        $Tranche3 = new Tranche(151 ,210,0.9451) ,
        $Tranche4 = new Tranche(211 ,310,1.0489) ,
        $Tranche5 = new Tranche(311 ,510,1.0489) , 
        $Tranche6 = new Tranche(511, null ,1.0489) 
    ] ;
    if($consumption > 0){
         if($consumption<= $Tranche1->highest){
             $Bill1 = $consumption ;
             $MHT1 = $Bill1 * $Tranche1->Tarif ;
             $TTC1 = $MHT1*TVA ;
        }
        elseif($consumption>= $Tranche2->lowest && $consumption< $Tranche2->highest){
            $Bill1 = $Tranche1->highest ;
            $MHT1 = $Tranche1->highest * $Tranche1->Tarif;
            $TTC1 = $MHT1*TVA ;
            $Bill2 = $consumption - $Tranche1->highest;
            $MHT2 = $Bill2 * $Tranche2->Tarif ;
            $TTC2 = $MHT2*TVA ;

            $totalTva = $TTC1 + $TTC2 + $TTCcalibre ;
            $HTtotal = $MHT1 + $MHT2 + $Tarifs ;
            $TTCtotal = $totalTva + Stamp ;
            $totalBill = $HTtotal + $TTCtotal ;
            // echo $totalBill ;
        }
        elseif($consumption >= $Tranche3->lowest && $consumption <= $Tranche3->highest){
            $Bill1 = $consumption ;
            $MHT1 = $Bill1 * $Tranche3->Tarif ;
            $TTC1 = $MHT1*TVA ;
            $totalTva = $TTC1 + $TTCcalibre ;
            $TTCtotal = $totalTva + Stamp ;
            $HTtotal = $MHT1 + $Tarifs ;
            $totalBill = $HTtotal + $TTCtotal ;
            echo "this is the third ".$totalBill ;
       }
       elseif($consumption >= $Tranche4->lowest && $consumption <= $Tranche4->highest){
        $Bill1 = $consumption ;
        $MHT1 = $Bill1 * $Tranche4->Tarif ;
        $TTC1 = $MHT1*TVA ;
        $totalTva = $TTC1 + $TTCcalibre ;
        $TTCtotal = $totalTva + Stamp ;
        $HTtotal = $MHT1 + $Tarifs ;
        $totalBill = $HTtotal + $TTCtotal ;
        echo "this is the fourth ".$totalBill ;
     }
     elseif($consumption >= $Tranche5->lowest && $consumption <= $Tranche5->highest){
        $Bill1 = $consumption ;
        $MHT1 = $Bill1 * $Tranche5->Tarif ;
        $TTC1 = $MHT1*TVA ;
        $totalTva = $TTC1 + $TTCcalibre ;
        $TTCtotal = $totalTva + Stamp ;
        $HTtotal = $MHT1 + $Tarifs ;
        $totalBill = $HTtotal + $TTCtotal ;
        echo "this is the fifth ".$totalBill ;
    }
    elseif( $consumption > $Tranche6->lowest){
        Cal($Tranche5->Tarif ) ;
    }


    function Cal($tranche){
        $Bill1 = $consumption ;
        $MHT1 = $Bill1 * $tranche ; // the obly parametres that changes is the tranche-->TARIF
        $TTC1 = $MHT1*TVA ;                 // so a function 
        $totalTva = $TTC1 + $TTCcalibre ;
        $TTCtotal = $totalTva + Stamp ;
        $HTtotal = $MHT1 + $Tarifs ;
        $totalBill = $HTtotal + $TTCtotal ;
        echo "this is the sixth ".$totalBill ;

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