<?php

session_start();
require_once 'functions.php';
$userstr = 'Witaj, gościu';

   if (!isset($_SESSION['log']))
  {
	header('Location: index.php');
	exit();
  }
  
  
$max_words = 5; 
$max_length = 50; 


if ( !isset($_POST['submit']) )
{
	'<h1>Wyszukiwarka</h1><br><br>
	<form action="test.php" method="post">
	Fraza nicku <span style="color: red; font-weight: bold;">*</span> <input type="post" name="fraza" style="width: 200px;" maxlength="'.$max_length.'"><br>
	<input type="submit" name="submit" value="Szukaj">
	</form><br><br>
	<span style="color: red; font-weight: bold;">*</span> - znak gwiazdki (<b>*</b>) zastępuje dowolny ciąg znaków.';
	
	
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
            echo "<h3>Dostępne orliki</h3><ul>";
			$body_search = $row['nazwaorlika'].'<br>';
            echo "<li><a data-transition='slide' href='orliki.php?view=" .
      $row['nazwaorlika'] . "'>" . $row['nazwaorlika'] . "</a>"."</br>";
            ?>
            <a data-transition='slide'
      href='booking.php?view=<?php echo $row['nazwaorlika'] ?>' class="btn btn-primary">REZERWUJ TERMIN</a>
<?php
		}
		
	}
}



 

?>