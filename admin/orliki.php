<html>
    <body>

<?php

  session_start();
require_once 'functions.php';
$userstr = 'Witaj, gościu';

   if (!isset($_SESSION['log']))
  {
	header('Location: index.php');
	exit();
  }
        
    ?>
        
        
        <!doctype html>
<html lang="pl">
<head>
	<meta charset="uft-8">
	<title>ORLIKOWA</title>
	<link rel="stylesheet" href="home.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Content/bootstrap.css">
    <link rel="stylesheet" href="Content/style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="container" style="height:1200px; background-color:white;">
<div id="kontener">
	<div id="baner">
	<img src="logo.png"  style="margin-top:5px; margin-left:28%;" />
		
	</div>
	<div class="menu">
               <form method="get" action='home.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Strona główna</span></button>
                </form>
                <form method="get" action='orlik.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Rezerwacja</span></button>
                </form>
                  <form method="get" action='rezerwacje.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Zarządzanie rezerwacjami</span></button>
                </form>
          <form method="get" action='konta.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Zarządzanie kontami</span></button>
                </form>
          <form method="get" action='zespoly.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Zarządzanie zespołami</span></button>
                </form>
        
          <form method="get" action='orlikedit.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Zarządzanie orlikami</span></button>
                </form>
          <form method="get" action='mecze.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Zarządzanie meczami</span></button>
                </form>
    
                <form method="get" action='logout.php' style='display: inline-block;'>
                <button class="button" style="vertical-align:middle"><span>Wyloguj się</span></button>
                </form>   
            </div>
	
	<div id="blok_glowny" style="color:darkblue; font-size: 15px; height:auto; ">
        
 <?php
       if (isset($_GET['view']))
  {
       $orlik = sanitizeString($_GET['view']);
$result = queryMysql("SELECT nazwaorlika FROM orlik where nazwaorlika='$orlik'");
  $num    = $result->num_rows;
$row = $result->fetch_array(MYSQLI_ASSOC);
  echo "<h1>Orlik: </h1>";
         echo "<h3>".$row['nazwaorlika']."</h3>";
?>
<hr>
<?php        
   
    $orlik = sanitizeString($_GET['view']);
     $result = queryMysql("SELECT orlik.miejscowość, informacje_orlik.rok_zalożenia,informacje_orlik.	informacje_orlikcol,informacje_orlik.koszt_budowy,nawierzchnia.rodzaj from orlik inner join informacje_orlik on orlik.informacje_orlik_id=informacje_orlik.id inner join nawierzchnia on informacje_orlik.nawierzchnia_id=nawierzchnia.id where nazwaorlika='$orlik'");
       $result1=queryMysql("select oswietlenie.rodzaj from orlik inner join informacje_orlik on orlik.informacje_orlik_id=informacje_orlik.id inner join oswietlenie on informacje_orlik.oswietlenie_id=oswietlenie.id where nazwaorlika='$orlik' ");
           

  $num    = $result->num_rows;
 $row = $result->fetch_array(MYSQLI_ASSOC);
       $num1    = $result1->num_rows;
 $row1 = $result1->fetch_array(MYSQLI_ASSOC);
       
  echo "<h5>Informacje ogólne</h5><ul>";

   
    
    echo"Data założenia:"." ".$row['rok_zalożenia']."<br/>" ;
       
       echo "<br/>";
       
       echo"Miejscowość:"." ".$row['miejscowość']." <br/>";
       
       echo "<br/>";
      
       echo"Koszt_budowy:". " ".$row['koszt_budowy']." <br/>";
   
       echo "<br/>";
      
       echo"Informacje:". " ".$row['informacje_orlikcol']." <br/>";
       
         echo "<br/>";
      
       echo"Rodzaj nawierzchni:". " ".$row['rodzaj']." <br/>";
       
       echo "<br/>";
      
       echo"Rodzaj oswietlenia:". " ".$row1['rodzaj']." <br/>";
       
       ?>
        <hr>
        <?php
       
       
        $orlik = sanitizeString($_GET['view']);
       
        $result = queryMysql("SELECT organ.Nazwa_organu,organ.miejsce_zarządzania FROM orlik inner join organ on orlik.organ_id=organ.id where nazwaorlika='$orlik'");
       
         
       
  $num    = $result->num_rows;
$row = $result->fetch_array(MYSQLI_ASSOC);
       
       
       echo "<h5>Organ Zarządzajcy orlikiem</h5>";

   
    
    echo"Organ:"." ".$row['Nazwa_organu']."<br/>" ;
       
       echo "<br/>";
       
       echo"Siedziba:"." ".$row['miejsce_zarządzania']." <br/>";
       
       echo "<br/>";
       
       ?>
        <hr>
        <?php
       
         $zespol = sanitizeString($_GET['view']);
     
            
     $result=queryMysql("call rezerwacje('$orlik')");
                $num    = $result->num_rows;
                 
  echo "<h3>Terminy rezerwacji dla orlika</h3><ul>";
           ?>
        
        <table border=1 style='background-color:silver; float:center; border:3px solid blue;  '>
            <?php
       echo "<tr>";
    echo "<td>";
    echo "Data"."</td>";
    echo "<td>";
    echo "Czas rozpoczecia"."</td>";
    echo "<td>";
    echo "Czas zakończenia"."</td>";
        echo "<td>";
        echo "Imie"."</td>";
         echo "<td>";
        echo "Nazwisko"."</td>";
 echo "<td>";
        echo "Status"."</td>";   
       echo "</tr>";
       
for ($j = 0 ; $j < $num ; ++$j)
  {
   
    $row = $result->fetch_array(MYSQLI_ASSOC);
     echo "<tr>";
    echo "<td>";
    echo  $row['data']."</td>";
    echo "<td>";
    echo  $row['czas_rozpoczecia']."</td>";
    echo "<td>";
    echo  $row['czas_zakonczenia']."</td>";
    echo "<td>";
    echo  $row['Imie']."</td>";
      echo "<td>";
    echo  $row['Nazwisko']."</td>";
      echo "<td>";
    echo  $row['status']."</td>";
      

       
   }
       
      echo "</tr>";  
       echo "</table>";
       
       
    
       
   }
        

      ?>
 
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>

       
    