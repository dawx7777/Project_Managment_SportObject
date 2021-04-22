  
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
        if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$zespol = sanitizeString($_POST['zespol']);
	$data = sanitizeString($_POST['data']);
     $miasto = sanitizeString($_POST['miasto']);
	$kolor = sanitizeString($_POST['kolor']);       

	 queryMysql("UPDATE zespół SET Nazwa='$zespol', Data_zalożenia='$data', Miejscowość='$miasto' where Nazwa='$id' ");
            	 queryMysql("UPDATE koszulki left join zespół on zespół.id=koszulki.zespol_id SET kolor='$kolor' where zespół.Nazwa='$id'");
                queryMysql("UPDATE czlonkowie right join zespół on zespół.id=czlonkowie.zespol_id SET czlonkowie.zespol='$zespol' where zespół.Nazwa='$id'");
            $_SESSION['t_zmiany']="Zmiany pozytywnie wykonane";
}
?>
        
        
                  <?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = queryMysql("SELECT zespół.Nazwa,zespół.Data_zalożenia,zespół.Miejscowość,koszulki.kolor from zespół inner join koszulki on koszulki.zespol_id=zespół.id where Nazwa='".$_GET['edit']."'");

		
			$n = mysqli_fetch_array($record);
			$zespol = $n['Nazwa'];
			$data= $n['Data_zalożenia'];
            $miasto=$n['Miejscowość'];
            $kolor=$n['kolor'];
		      
	}
     ?>
        
        
        
          <?php
			if (isset($_SESSION['t_zmiany']))
			{ ?>
				<div class="alert alert-success"><?php echo $_SESSION['t_zmiany']?></div>
                        <?php
				unset($_SESSION['t_zmiany']);
			}
		?>
        
        <form method="post" action="editzespol.php" style=" width: 45%;
    height:auto; margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;">
        
		<div class="input-group">
			<label>Nazwa zepołu</label>
           <input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="text" name="zespol" value="<?php echo $zespol; ?>">

		</div>
		<div class="input-group">
			<label>Data założenia </label>
			<input type="text" name="data" value="<?php echo $data; ?>">
            <label>Miejscowość </label>
            <input type="text" name="miasto" value="<?php echo $miasto; ?>">
            <div class="input-group">
            <label>Kolor </label>
            <input type="text" name="kolor" value="<?php echo $kolor; ?>">
		</div>
		<div class="input-group">
			
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >Zmodyfikuj</button>
            </div>
		</div>
	</form>

 
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>





