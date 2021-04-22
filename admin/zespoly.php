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
 

 $result = queryMysql("SELECT Nazwa FROM zespół  ORDER BY Nazwa");
$num    = $result->num_rows;

  echo "<h3>Zespoły</h3><ul>";
 for ($j = 0 ; $j < $num ; ++$j)
  {
      
     
    $row = $result->fetch_array(MYSQLI_ASSOC);

    
     
    echo "<li><a data-transition='slide' href='czlonkowie.php?view=" .
      $row['Nazwa'] . "'>" . $row['Nazwa'] . "</a>"."</br>";

        
     
     ?>
     
        <a href='zespoly.php?del=<?php echo $row['Nazwa']; ?>' class="btn btn-danger">usuń</a>
        <a href='editzespol.php?edit=<?php echo $row['Nazwa']; ?>' class="btn btn-danger">Edytuj dane</a>
        
        <?php
     
     

     
  }
        
        if (isset($_GET['del'])) {
	$id = $_GET['del'];
	 queryMysql("DELETE koszulki,zespół from koszulki right join zespół on zespół.id=koszulki.zespol_id  where  zespół.Nazwa='$id' and zespół.Nazwa='". $row['Nazwa']."' ");
           
              queryMysql("DELETE from czlonkowie where zespol='$id' and zespol='". $row['Nazwa']."'");
            
              header('Location:zespoly.php');
    }
?>




 
    </div>
</div>
        

	
		
	</div>
	
    
      
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>
