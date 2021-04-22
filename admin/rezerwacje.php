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
	
	<div id="blok_glowny" style="color:blue; font-size: 18px; height:auto ">
        

<?php

$result=queryMysql("select konto_logowania.login,rezerwacja.id,rezerwacja.Imie,rezerwacja.Nazwisko,rezerwacja.telefon,termin.data,termin.czas_rozpoczecia,termin.czas_zakonczenia,orlik.nazwaorlika,status_rezerwacji.status,status_rezerwacji.data_zmiany from konto_logowania,rezerwacja,termin,status_rezerwacji,orlik where rezerwacja.konto_logowania_id=konto_logowania.id and termin.rezerwacja_id=rezerwacja.id and termin.Orlik_id=orlik.id and rezerwacja.status_rezerwacji_id=status_rezerwacji.id order by termin.data,orlik.nazwaorlika,status_rezerwacji.status ");
  

  
      

  $num    = $result->num_rows;
       
  
echo "<table border=1>";
      
         echo "<tr style='background-color:silver'>";
   echo "<td>";
    echo "ID"."</td>";
      echo "<td>";
    echo "Konto"."</td>";
    echo "<td>";
  
    echo "Imie"."</td>";
  echo "<td>";
    echo "Nazwisko"."</td>";
  echo "<td>";
    echo "Telefon"."</td>";
 echo "<td>";
    echo "Data"."</td>";
    echo "<td>";
    echo "Czas rozpoczecia"."</td>";
    echo "<td>";
    echo "Czas zakończenia"."</td>";
    echo "<td>";
     echo "Nazwa orlika"."</td>";
    echo "<td>";
     echo "Status rezerwacji"."</td>";
           echo "<td>";
     echo "Data zmiany"."</td>";
      echo "<td>";
     echo "Usuń rezerwację"."</td>";
    echo "<td>";
     echo "Zmień status"."</td>";  
        
        
   echo "</tr>";
        
 echo "<h3>Bieżace rezerwacje użytkowników</h3>";
for ($j = 0 ; $j < $num ; ++$j)
{
   
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    echo "<tr>";
   echo "<td>";
    echo $row['id']."</td>";
      echo "<td>";
    echo  $row['login']."</td>";
     echo "<td>";
    echo  $row['Imie']."</td>";
 echo "<td>";
    echo  $row['Nazwisko']."</td>";
 echo "<td>";
    echo  $row['telefon']."</td>";
    echo "<td>";
    echo  $row['data']."</td>";
    echo "<td>";
    echo  $row['czas_rozpoczecia']."</td>";
    echo "<td>";
    echo  $row['czas_zakonczenia']."</td>";
    echo "<td>";
     echo  $row['nazwaorlika']."</td>";
    echo "<td>";
     echo  $row['status']."</td>";
       echo "<td>";
     echo  $row['data_zmiany']."</td>";
      
   
    

    
    
    
if (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
      
    
    
    queryMysql("DELETE termin,rezerwacja,status_rezerwacji from termin inner join rezerwacja on termin.rezerwacja_id=rezerwacja.id inner join status_rezerwacji on status_rezerwacji.id=rezerwacja.status_rezerwacji_id where rezerwacja.id='". $row['id']."' and rezerwacja.id='$remove' ");
   header('Location:rezerwacje.php');

  }
   
    echo "<td>";
    
    ?>
     <a data-transition='slide'
      href='rezerwacje.php?remove=<?php echo $row['id'] ?>' class="btn btn-danger">ANULUJ REZERWACJE</a>
    <?php
     echo "</td>";
    if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);
      
    
    
    queryMysql("update status_rezerwacji right join rezerwacja on status_rezerwacji.id=rezerwacja.status_rezerwacji_id set status_rezerwacji.status='ZAAKCEPTOWANY' where rezerwacja.id='". $row['id']."' and rezerwacja.id='$add'  ");
        
           header('Location:rezerwacje.php');
        
    }
    
    echo "<td>";
    
    ?>
        
    <a data-transition='slide'
       href='rezerwacje.php?add=<?php echo $row['id'] ?>' class="btn btn-success">Zmień status rezerwacji</a>
<?php
echo "</td>";
}
echo "</tr>";
echo "</table>";
        
   $result=queryMysql(" select administrator.login,rezerwacja.id,termin.data,termin.czas_rozpoczecia,termin.czas_zakonczenia,orlik.nazwaorlika,status_rezerwacji.status,status_rezerwacji.data_zmiany from administrator,rezerwacja,termin,status_rezerwacji,orlik where rezerwacja.Administrator_id=administrator.id and termin.rezerwacja_id=rezerwacja.id and termin.Orlik_id=orlik.id and rezerwacja.status_rezerwacji_id=status_rezerwacji.id order by termin.data,orlik.nazwaorlika ");
  

  
      

  $num    = $result->num_rows;
       
  
echo "<table border=1>";
      
         echo "<tr style='background-color:silver'>";
   echo "<td>";
    echo "ID"."</td>";
      echo "<td>";
    echo "Konto"."</td>";
    echo "<td>";
    echo "Data"."</td>";
    echo "<td>";
    echo "Czas rozpoczecia"."</td>";
    echo "<td>";
    echo "Czas zakończenia"."</td>";
    echo "<td>";
     echo "Nazwa orlika"."</td>";
    echo "<td>";
     echo "Status rezerwacji"."</td>";
        echo "<td>";
     echo "Data zmiany"."</td>";
      echo "<td>";
     echo "Usuń rezerwację"."</td>";
     
        
        
   echo "</tr>";
        
 echo "<h3>Bieżace rezerwacje Administartora</h3>";
for ($j = 0 ; $j < $num ; ++$j)
{
   
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    echo "<tr>";
   echo "<td>";
    echo $row['id']."</td>";
      echo "<td>";
    echo  $row['login']."</td>";
    echo "<td>";
    echo  $row['data']."</td>";
    echo "<td>";
    echo  $row['czas_rozpoczecia']."</td>";
    echo "<td>";
    echo  $row['czas_zakonczenia']."</td>";
    echo "<td>";
     echo  $row['nazwaorlika']."</td>";
    echo "<td>";
     echo  $row['status']."</td>";
     echo "<td>";
     echo  $row['data_zmiany']."</td>";
   
      
   
    

    
    
    
if (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
      
    
    
    queryMysql("DELETE termin,rezerwacja,status_rezerwacji from termin inner join rezerwacja on termin.rezerwacja_id=rezerwacja.id inner join status_rezerwacji on status_rezerwacji.id=rezerwacja.status_rezerwacji_id where rezerwacja.id='". $row['id']."' and rezerwacja.id='$remove' ");
       header('Location:rezerwacje.php');

  }
   
   
    echo "<td>";
    ?>
        
     <a data-transition='slide'
      href='rezerwacje.php?remove=<?php echo $row['id'] ?>' class=" btn btn-warning">ANULUJ REZERWACJE</a>
        <?php
  
    
    echo "</td>";


}
echo "</tr>";
echo "</table>";
   ?>
       <hr>
    <h3>Usuń z bazy wszystkie stare rezerwacje</h3>    
     <?php   
        
        
        if (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
        $result=queryMysql("DELETE termin,rezerwacja,status_rezerwacji from termin inner join rezerwacja on termin.rezerwacja_id=rezerwacja.id inner join status_rezerwacji on status_rezerwacji.id=rezerwacja.status_rezerwacji_id where termin.data < date(now()) "); 
               header('Location:rezerwacje.php');
        }
        ?>
       <a data-transition='slide'
      href='rezerwacje.php?remove=<?php  $result ?>' class=" btn btn-warning">USUŃ WSZYSTKIE STARE REZERWACJE</a>
       <?php
    ?>
        
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>