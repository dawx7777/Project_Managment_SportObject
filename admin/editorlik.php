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
	
	<div id="blok_glowny" style="color:blue; height:auto; font-size: 18px; ">
       
<?php
        if (isset($_POST['update'])) {
	$id = $_POST['id'];
	 @$orlik = sanitizeString($_POST['nazwa']);
      @$miasto = sanitizeString($_POST['miasto']);
      @$organ = sanitizeString($_POST['organ']);
        @$m_organ = sanitizeString($_POST['zarzadzanie']);
      @$info = sanitizeString($_POST['info']);
     @$koszt = sanitizeString($_POST['koszt']);
      @$rok = sanitizeString($_POST['rok']);
      @$oswietlenie = sanitizeString($_POST['oswietlenie']);
      @$nawierzchnia= sanitizeString($_POST['nawierzchnia']);      

	 queryMysql("update nawierzchnia inner join informacje_orlik on informacje_orlik.nawierzchnia_id=nawierzchnia.id inner join orlik on orlik.informacje_orlik_id=informacje_orlik.id set rodzaj='$nawierzchnia' where nazwaorlika='$id'");
            	 queryMysql("update oswietlenie inner join informacje_orlik on informacje_orlik.oswietlenie_id=oswietlenie.id inner join orlik on orlik.informacje_orlik_id=informacje_orlik.id set rodzaj='$oswietlenie' where nazwaorlika='$id'");
                queryMysql("update informacje_orlik inner join orlik on orlik.informacje_orlik_id=informacje_orlik.id set informacje_orlikcol='$info',rok_zalożenia='$rok',koszt_budowy='$koszt' where nazwaorlika='$id'");
            
                queryMysql("update organ inner join orlik on orlik.organ_id=organ.id set Nazwa_organu='$organ', miejsce_zarządzania='$m_organ' where nazwaorlika='$id'");
            queryMysql("update orlik set nazwaorlika='$orlik',miejscowość='$miasto' where nazwaorlika='$id'" );
            
            
                $_SESSION['a_zmiany']="Zmiany pozytywnie wykonane";
             
            
             
              
              
             
}
?>
        
        
                  <?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = queryMysql("SELECT orlik.nazwaorlika,orlik.miejscowość, informacje_orlik.rok_zalożenia,informacje_orlik.	informacje_orlikcol,informacje_orlik.koszt_budowy,nawierzchnia.rodzaj from orlik inner join informacje_orlik on orlik.informacje_orlik_id=informacje_orlik.id inner join nawierzchnia on informacje_orlik.nawierzchnia_id=nawierzchnia.id where nazwaorlika='$id'");
         $record1=queryMysql("select oswietlenie.rodzaj from orlik inner join informacje_orlik on orlik.informacje_orlik_id=informacje_orlik.id inner join oswietlenie on informacje_orlik.oswietlenie_id=oswietlenie.id where nazwaorlika='$id' ");
        $record2 = queryMysql("SELECT organ.Nazwa_organu,organ.miejsce_zarządzania FROM orlik inner join organ on orlik.organ_id=organ.id where nazwaorlika='$id'");

		
			$n = mysqli_fetch_array($record);
            $n1 = mysqli_fetch_array($record1);
            $n2 = mysqli_fetch_array($record2);
			$orlik = $n['nazwaorlika'];
			$info= $n['informacje_orlikcol'];
            $miasto=$n['miejscowość'];
            $rok=$n['rok_zalożenia'];
            $koszt=$n['koszt_budowy'];
            $organ=$n2['Nazwa_organu'];
            $m_organ=$n2['miejsce_zarządzania'];
            $nawierzchnia=$n['rodzaj'];
            $oswietlenie=$n1['rodzaj'];
            
        
        
		      
	}
     ?>
        <form method="post" action="editorlik.php" style=" width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;" >
        
            
             <?php
			if (isset($_SESSION['a_zmiany']))
			{ ?>
				<div class="alert alert-success"><?php echo $_SESSION['a_zmiany']?></div>
                        <?php
				unset($_SESSION['a_zmiany']);
			}
		?>
	
		            <form method="post" action="editorlik.php">
                 <div class="form-group">
                    <label for="przykladowanazwa">Nazwa Orlika</label>
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" class="form-control" name="nazwa" value="<?php echo $orlik; ?>"  placeholder="Podaj Nazwę" >
               
                
                    <label for="przykladowamiejscowość">Miejscowość</label>
                    <input type="text" class="form-control" name="miasto" value="<?php echo $miasto; ?>" placeholder="Podaj Miejscowość">
                </div>
               <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="przykladowyNazwaorganu">Nazwa Organu</label>
                        <input type="text" class="form-control" name="organ" value="<?php echo $organ; ?>" placeholder="Nazwa Organu">
                    </div>
                  
                <div class="form-group col-md-6">
                        <label for="przykladowemiesjcezarządzania">Miejsce Zarządzania</label>
                        <input type="text" class="form-control" name="zarzadzanie" value="<?php echo $m_organ; ?>" placeholder="Miejsce zarządzania organu">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="przykladowyrok">Rok założenia</label>
                        <input type="date" class="form-control" name="rok" value="<?php echo $rok; ?>" placeholder="Rok założenia">
                    </div>
                  
                <div class="form-group col-md-6">
                        <label for="przykladowykoszt">Koszt budowy</label>
                        <input type="text" class="form-control" name="koszt" value="<?php echo $koszt; ?>" placeholder="Koszt budowy">
                    </div>
                </div>
               <div class="form-group">
                    <label for="przykladoweinfo">Krótka informacja</label>
                    <input type="textarea" class="form-control" name="info" value="<?php echo $info; ?>" placeholder="Podaj krótką informację">
                </div>
                <div class="form-group">
                    <label for="przykladoweinfo">Rodzaj oświetlenia</label>
                    <label class="form-control" for="przykladoweoswietlenie">
                    <input type="radio"   name="oswietlenie"  value="LED" value="<?php echo $oswietlenie; ?>" checked>LED</label>
                     <label class="form-control" for="przykladoweoswietlenie">
                    <input type="radio"   name="oswietlenie" value="<?php echo $oswietlenie; ?>" value="halogen">halogen</label>
                        
                        
                </div>
                 <div class="form-group">
                     <label for="przykladoweinfo">Rodzaj nawierzchni</label>
                    <label class="form-control" for="przykladowanawierzchnia">
                    <input type="radio"   name="nawierzchnia"  value="sztuczna" value="<?php echo $nawierzchnia; ?>" checked>sztuczna</label>
                     <label class="form-control" for="przykladoweoswietlenie">
                    <input type="radio"   name="nawierzchnia"  value="trawiasta" value="<?php echo $nawierzchnia; ?>">trawiasta</label>
                      <label class="form-control" for="przykladowanawierzchnia">
                    <input type="radio"   name="nawierzchnia"  value="polsztuczna" value="<?php echo $nawierzchnia; ?>">polsztuczna</label>  
                        
                </div>
		<div class="input-group">
			
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >Zmodyfikuj</button>

		</div>
	</form>

 
    </div>
</div>
        

	
		
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>
