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

 
 $result = queryMysql("SELECT imie,nazwisko,dataurodzenia,miasto,adres,kodpocztowy,konto_logowania.email,konto_logowania.login FROM klient inner join konto_logowania on klient.konto_logowania_id=konto_logowania.id  where login not like 'administrator'");
  $num    = $result->num_rows;

  echo "<h3>Informacje o użytkownikach</h3>";
        
        echo "<table border=1 color=black style='border-style:solid;'>";
        
             echo "<tr>";
   echo "<td>";
    echo "Login"."</td>";
      echo "<td>";
    echo "Imię"."</td>";
    echo "<td>";
    echo "Nazwisko"."</td>";
    echo "<td>";
    echo "Data urodzenia"."</td>";
    echo "<td>";
    echo "Miasto"."</td>";
    echo "<td>";
    echo "Adres zamieszkania"."</td>";
    echo "<td>";
     echo "Kod pocztowy"."</td>";  
    echo "<td>";    
     echo "Adres email"."</td>";
    echo "<td>";
     echo "Usuń konto"."</td>";
         echo "<td>";
     echo "Edytuj konto"."</td>";
    
        
        
   echo "</tr>";
for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);


echo "<tr>";
    echo "<td>";
 echo  $row['login']."</td>";
    
    echo "<td>";
    echo  $row['imie']."</td>";
    echo "<td>";
    echo  $row['nazwisko']."</td>";
    echo "<td>";
    echo  $row['dataurodzenia']."</td>";
    echo "<td>";
    echo  $row['miasto']."</td>";
    echo "<td>";
    echo  $row['adres']."</td>";
    echo "<td>";
     echo  $row['kodpocztowy']."</td>";
    echo "<td>";
     echo  $row['email']."</td>";
    
    

   
    echo "<td>";
    
    ?>
     <a 
      href='konta.php?del=<?php echo $row['login'] ?>' class="del_btn">Usuń </a>
        
        <?php
     echo "</td>";
    
   echo "<td>";
    ?>
				<a href="konta.php?edit=<?php echo $row['login']; ?>" class="edit_btn" >Edit</a>
        <?php
			echo "</td>";
}
echo "</tr>";
echo "</table>";

?>
        
              <html>
<head>

</head>
<body>
	
        
        <?php 
	

	
	$email = "";
	$adres = "";
    $imie = "";
	$nazwisko = "";
    $miasto = "";
	$data = "";
    $kod = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$email = $_POST['email'];
		$adres = $_POST['adres'];
      $imie = $_POST['imie'];
      $nazwisko = sanitizeString($_POST['nazwisko']);
        $data = sanitizeString($_POST['dataurodzenia']);
      $miasto = sanitizeString($_POST['miasto']);
		$kod = sanitizeString($_POST['kod']);

	
	}
?>
            <?php
        if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$email = sanitizeString($_POST['email']);
	$adres = sanitizeString($_POST['adres']);
      $imie = sanitizeString($_POST['imie']);
      $nazwisko = sanitizeString($_POST['nazwisko']);
        $data = sanitizeString($_POST['dataurodzenia']);
      $miasto = sanitizeString($_POST['miasto']);
		$kod = sanitizeString($_POST['kod']);       

	 queryMysql("UPDATE konto_logowania SET email='$email' where login='$id'");
            	 queryMysql("UPDATE klient inner join konto_logowania on konto_logowania.id=klient.konto_logowania_id SET adres='$adres',imie='$imie',nazwisko='$nazwisko',dataurodzenia='$data',miasto='$miasto',kodpocztowy='$kod' where login='$id'");
            $_SESSION['kk_zmiany']="Zmiany pozytywnie wykonane";

}
?>
        
        
                  <?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = queryMysql("SELECT konto_logowania.email,klient.imie,klient.nazwisko,klient.adres,klient.miasto,klient.dataurodzenia,klient.kodpocztowy FROM konto_logowania inner join klient on klient.konto_logowania_id=konto_logowania.id ");

		
			$n = mysqli_fetch_array($record);
			$email = $n['email'];
			$adres= $n['adres'];
			$imie= $n['imie'];
        $nazwisko = $n['nazwisko'];
			$data= $n['dataurodzenia'];
            $kod = $n['kodpocztowy'];
			$miasto= $n['miasto'];
		
	}
    
    
    
    if (isset($_GET['del'])) {
	$id = $_GET['del'];
	 queryMysql("delete czlonkowie from czlonkowie inner join konto_logowania on czlonkowie.konto_logowania_id=konto_logowania.id where konto_logowania.login='". $row['login']."' and konto_logowania.login='$id'");
    queryMysql("delete rezerwacja from rezerwacja inner join konto_logowania on rezerwacja.konto_logowania_id=konto_logowania.id where  konto_logowania.login='". $row['login']."' and konto_logowania.login='$id'");   
    queryMysql("DELETE konto_logowania,klient,profil from klient right join konto_logowania on konto_logowania.id=klient.konto_logowania_id  left join profil on konto_logowania.id=profil.konto_logowania_id where konto_logowania.login='". $row['login']."' and konto_logowania.login='$id' ");
       queryMysql("DELETE FROM przyjaciele WHERE login='$id' or przyjaciel='$id'");
        header('Location:konta.php');
    }
?>
      <?php
			if (isset($_SESSION['kk_zmiany']))
			{ ?>
				<div class="alert alert-success"><?php echo $_SESSION['kk_zmiany']?></div>
                        <?php
				unset($_SESSION['kk_zmiany']);
			}
		?>
        <form method="post" action="konta.php" style=" width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;" >
        
		<div class="input-group">
			<label>Adres email</label>
           <input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
			<label>Imię </label>
			<input type="text" name="imie" value="<?php echo $imie; ?>">
            <label>Nazwisko </label>
            <input type="text" name="nazwisko" value="<?php echo $nazwisko; ?>">
            <label>Data urodzenia </label>
            <input type="date" name="dataurodzenia" value="<?php echo $data; ?>">
            <label>Adres </label>
            <input type="text" name="adres" value="<?php echo $adres; ?>">
            <label>Kod pocztowy </label>
            <input type="text" name="kod" value="<?php echo $kod; ?>">
            <label>Adres </label>
            <input type="text" name="miasto" value="<?php echo $miasto; ?>">
		</div>
		<div class="input-group">
			<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >Zmodyfikuj</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Zapisz</button>
<?php endif ?>
		</div>
	</form>
</body>
</html>
 

 
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>


