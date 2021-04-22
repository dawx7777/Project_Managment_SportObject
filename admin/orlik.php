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
	
	<div id="blok_glowny" style="color:blue; ">
        
<?php
        $max_words = 5; 
$max_length = 50; 
        
        if ( !isset($_POST['submit']) )
{
            ?>
	<h1>Wyszukiwarka miejscowego orlika</h1><br><br>
	<form action="orlik.php" method="post">
	Szukaj orlika w swoim miejscu <span style="color: red; font-weight: bold;">*</span> <input type="post" name="fraza" style="width: 200px;" maxlength="'.$max_length.'"><br>
	<input type="submit" name="submit" value="Szukaj" class="btn btn-primary">
	</form>
	
	<?php
}
else
{
	$search_words = sanitizeString($_POST['fraza']);
	$search_words = mysqli_real_escape_string($connection,$search_words);
	$count_words = substr_count($search_words, ' ');
	
	if ( ($count_words + 1) > ($max_words) )
	{
		echo "Użyłeś za wiele słów";
		exit;
	}
	
	$search_words = str_replace("*", "%", $search_words);
	
	$result = queryMysql("SELECT nazwaorlika FROM orlik WHERE miejscowość LIKE '".$search_words."'");
	
	$num = mysqli_num_rows($result);
	if ( $num == 0 )
	{
		echo "Nie znaleziono pasujących.";
		exit;
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
            echo "<h3>Wyszukane orliki </h3><ul>";
			$body_search = $row['nazwaorlika'].'<br>';
            echo "<li><a data-transition='slide' href='orliki.php?view=" .
      $row['nazwaorlika'] . "'>" . $row['nazwaorlika'] . "</a>"."</br>";
            ?>
            <a data-transition='slide'
      href='booking.php?view=<?php echo $row['nazwaorlika'] ?>' class="btn btn-success">REZERWUJ TERMIN</a>
<?php
		}
		
	}
}


?>
        <hr>
    <br><br>
        
    <?php



 $result = queryMysql("SELECT nazwaorlika FROM orlik  ORDER BY nazwaorlika");
$num    = $result->num_rows;

  echo "<h3>Dostępne orliki</h3><ul>";
 for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
  

    echo "<li><a data-transition='slide' href='orliki.php?view=" .
      $row['nazwaorlika'] . "'>" . $row['nazwaorlika'] . "</a>"."</br>";
     
     ?>
<a data-transition='slide'
      href='booking.php?view=<?php echo $row['nazwaorlika'] ?>' class="btn btn-primary">REZERWUJ TERMIN</a>
 
   
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
