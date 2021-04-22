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
	
	<div id="blok_glowny" style="color:blue; font-size: 18px; ">
        

<?php

 $result = queryMysql("SELECT nazwaorlika FROM orlik  ORDER BY nazwaorlika");
$num    = $result->num_rows;

  echo "<h3>Dostępne orliki</h3><ul>";
 for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
     
      echo "<li><a data-transition='slide' href='orliki.php?view=" .
      $row['nazwaorlika'] . "'>" . $row['nazwaorlika'] . "</a>"."</br>";
  

     
     
     
         if (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
          
             
              queryMysql("Delete nawierzchnia from nawierzchnia inner join informacje_orlik on nawierzchnia.id=informacje_orlik.nawierzchnia_id inner join orlik on orlik.informacje_orlik_id=informacje_orlik.id  where orlik.nazwaorlika='". $row['nazwaorlika']."' and orlik.nazwaorlika='$remove'");
                queryMysql("Delete oswietlenie from oswietlenie inner join informacje_orlik on oswietlenie.id=informacje_orlik.oswietlenie_id inner join orlik on orlik.informacje_orlik_id=informacje_orlik.id  where orlik.nazwaorlika='". $row['nazwaorlika']."' and orlik.nazwaorlika='$remove'");
              queryMysql("Delete informacje_orlik from informacje_orlik inner join orlik on orlik.informacje_orlik_id=informacje_orlik.id  where orlik.nazwaorlika='". $row['nazwaorlika']."' and orlik.nazwaorlika='$remove'");
             
              queryMysql("Delete organ from organ inner join orlik on orlik.organ_id=organ.id where orlik.nazwaorlika='". $row['nazwaorlika']."' and orlik.nazwaorlika='$remove'");
                queryMysql("Delete orlik,termin,rezerwacja,status_rezerwacji from orlik right join termin on orlik.id=termin.Orlik_id inner join rezerwacja on termin.rezerwacja_id=rezerwacja.id inner join status_rezerwacji on status_rezerwacji.id=rezerwacja.status_rezerwacji_id where orlik.nazwaorlika='". $row['nazwaorlika']."' and orlik.nazwaorlika='$remove'");
               header('Location:orlikedit.php');

  }
     ?>
   
<a data-transition='slide'
      href='orlikedit.php?remove=<?php echo $row['nazwaorlika'] ?> ' class="btn btn-danger">USUŃ ORLIK Z BAZY!</a>
        
 <a data-transition='slide'
      href='editorlik.php?edit=<?php echo $row['nazwaorlika'] ?> ' class="btn btn-danger">Edytuj dane!</a>
   
    <?php
   
    
  }


?>
 
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>

       
    