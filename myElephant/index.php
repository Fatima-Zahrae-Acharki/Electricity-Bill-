<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "<h1> Learning classes in php </h1>" ;

    
    ?>

<form action="myElephant" method="GET">
Name : <input type="text" name="firstName">
Family : <input type="text" name="lastName" id="">
Age : <input type="number" name="age" id="">
<button type="submit" name="send">send data</button>
</form>

<?php 
echo "hi" ;
    if(isset($__GET["firstName"]) && isset($__GET["lastName"]) && isset($__GET["age"])){
        echo $__GET["firstName"]."<br>" ;
        echo $__GET["lastName"]."<br>" ;
        echo $__GET["age"] ;
    } ; 
echo "hi there " ;

       
?>
</body>
</html>


<!-- class School{
            var $name ;
            var $Education ;
            var $location ;
            var $Nstudents ;
            function __construct($fullName , $type,$Location ,$Number){
                $this->name =$fullName ;
                $this->Education = $type ;
                $this->location = $Location ;
                $this->Nstudents = $Number ;
            }
        }

        class Collegue extends School {
            var $Year ;
            function __construct($fullName , $type,$Location ,$Number,$Year){
                $this->name =$fullName ;
                $this->Education = $type ;
                $this->location = $Location ;
                $this->Nstudents = $Number ;
                $this->Year = $Year ;
            }
          
        }


        $solicode = new School("solicode","Digital","sadam",50) ;
        echo $solicode->name."<hr>";
        echo $solicode->Nstudents."<hr>" ;

        $newcollegue = new Collegue("ibnzohr", "Science" , "azroo" ,5000, 1999 ) ;
        echo $newcollegue->Year."<hr>" ;
        echo $newcollegue-->
        <!-- name ; --> 