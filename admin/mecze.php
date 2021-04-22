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
 

 $result = queryMysql("SELECT  mecz.id,mecz.zespol,mecz.rywal,wynik.wynik,wynik.data from mecz inner join wynik on wynik.mecz_id=mecz.id where wynik.wynik !='' ");
$num    = $result->num_rows;

  echo "<h3>Wyniki spotkań</h3><ul>";
        
        
           echo "<table border=1 color=black style='border-style:solid;'>";
        
             echo "<tr>";
        echo "<td>";
    echo "ID"."</td>";
   echo "<td>";
    echo "Gospodarz"."</td>";
      echo "<td>";
    echo "Rywal"."</td>";
    echo "<td>";
    echo "Wynik"."</td>";
      echo "<td>";
         echo "Data"."</td>";
      echo "<td>";
    echo "Zmien/wprowadź wynik "."</td>";   
 
    
        
        
   echo "</tr>";
 for ($j = 0 ; $j < $num ; ++$j)
  {
      
     
    $row = $result->fetch_array(MYSQLI_ASSOC);

    
echo "<tr>";
         echo "<td>";
 echo  $row['id']."</td>";
    echo "<td>";
 echo  $row['zespol']."</td>";
    
    echo "<td>";
    echo  $row['rywal']."</td>";
    echo "<td>";
    echo  $row['wynik']."</td>";
    echo "<td>";
    echo  $row['data']."</td>";
  
     

if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);
           $wynikspotkania=sanitizeString($_POST['wynikspotkania']);
            
    $result=queryMysql("update wynik right join mecz on mecz.id=wynik.mecz_id set wynik.wynik='$wynikspotkania' where mecz.zespol='".$row['zespol']."' and mecz.rywal='".$row['rywal']."'  ");
      header('Location:mecze.php');
if($result==TRUE){
}  
}
         echo "<td>";
     ?>
     
        <form  method="post" action='mecze.php?add=<?php echo $row['id'] ?>'>
            <div class="wynik"><span class="red">Wprowadź lub zmień</span><p>
					 <input type="text" name="wynikspotkania" id="wynikspotkania" placeholder="np.2:1" />
						<button type="submit" class="btn btn-primary">Wyślij</button>
                </div>
    </form>
        
        <?php
         
            echo "</td>";
  
 }
    
         echo "</tr>";
echo "</table>";
?>
      

 
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>
