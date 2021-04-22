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
<?php
    
     
     @$orlik = sanitizeString($_POST['nazwa']);
      @$miasto = sanitizeString($_POST['miasto']);
      @$organ = sanitizeString($_POST['organ']);
        @$m_organ = sanitizeString($_POST['zarzadzanie']);
      @$info = sanitizeString($_POST['info']);
     @$koszt = sanitizeString($_POST['koszt']);
      @$rok = sanitizeString($_POST['rok']);
      @$oswietlenie = sanitizeString($_POST['oswietlenie']);
      @$nawierzchnia= sanitizeString($_POST['nawierzchnia']);
    

    

    if ($orlik == "" || $miasto == "" || $organ == "" || $m_organ == "" || $info == "" || $koszt == "" || $rok == "" || $oswietlenie == "" || $nawierzchnia == "" ){
   $_SESSION['blad']="Nie wszystkie pola zostały wypełnione <br><br>";
    }
       else
    {
      $result=queryMysql("SELECT nazwaorlika FROM orlik WHERE nazwaorlika='$orlik'");

      if ($result->num_rows){
        $_SESSION['istnieje']= "Orlik o takiej nazwie już istnieje.<br><br>";
      }
       
      else 
      {  
          
          
         $result= queryMysql("INSERT INTO oswietlenie values(null,'$oswietlenie')"); 
          if ($result===TRUE)
              $id_os=mysqli_insert_id($connection);
          $result= queryMysql("INSERT INTO nawierzchnia values(null,'$nawierzchnia')"); 
          if ($result===TRUE)
              $id_naw=mysqli_insert_id($connection);
          
$result=queryMysql("INSERT INTO informacje_orlik values (null, '$rok', '$koszt', '$info','$id_naw','$id_os')"); 
              
   if ($result===TRUE)
              $last_id=mysqli_insert_id($connection);
          
            $result= queryMysql("INSERT INTO organ values(null,'$organ','$m_organ')"); 
          if ($result===TRUE)
              $id_organ=mysqli_insert_id($connection);  
          
            $result= queryMysql("INSERT INTO orlik () values(null,'$orlik','$miasto','$id_organ','$last_id')"); 
         
              
       
       
      
           
           
           
          
           
$_SESSION['dodany']=" Orlik dodany do bazy";
    
    
      }
      
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
	
	<div id="blok_glowny">
        
   

    <div class="row">
        <div class=" col-sm-auto col2">
            <h1>Dodaj orlik do bazy</h1>
             <?php
			if (isset($_SESSION['istnieje']))
			{
				echo '<div class="error">'.$_SESSION['istnieje'].'</div>';
				unset($_SESSION['istnieje']);
                }
                ?>
             <?php
			if (isset($_SESSION['blad']))
			{
				echo '<div class="error">'.$_SESSION['blad'].'</div>';
				unset($_SESSION['blad']);
                }
                ?>
             <?php
			if (isset($_SESSION['dodany']))
			{
                ?>
				<div class="alert alert-success"><?php echo $_SESSION['dodany'] ?> </div>
            <?php
				unset($_SESSION['dodany']);
                }
                ?>
           
            
             
            <form method="post" action="zapiszorlik.php">
                 <div class="form-group">
                    <label for="przykladowanazwa">Nazwa Orlika</label>
                    <input type="text" class="form-control" name="nazwa"   placeholder="Podaj Nazwę" >
               
                
                    <label for="przykladowamiejscowość">Miejscowość</label>
                    <input type="text" class="form-control" name="miasto" placeholder="Podaj Miejscowość">
                </div>
               <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="przykladowyNazwaorganu">Nazwa Organu</label>
                        <input type="text" class="form-control" name="organ" placeholder="Nazwa Organu">
                    </div>
                  
                <div class="form-group col-md-6">
                        <label for="przykladowemiesjcezarządzania">Miejsce Zarządzania</label>
                        <input type="text" class="form-control" name="zarzadzanie" placeholder="Miejsce zarządzania organu">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="przykladowyrok">Rok założenia</label>
                        <input type="date" class="form-control" name="rok" placeholder="Rok założenia">
                    </div>
                  
                <div class="form-group col-md-6">
                        <label for="przykladowykoszt">Koszt budowy</label>
                        <input type="text" class="form-control" name="koszt" placeholder="Koszt budowy">
                    </div>
                </div>
               <div class="form-group">
                    <label for="przykladoweinfo">Krótka informacja</label>
                    <input type="textarea" class="form-control" name="info"  placeholder="Podaj krótką informację">
                </div>
                <div class="form-group">
                    <label for="przykladoweinfo">Rodzaj oświetlenia</label>
                    <label class="form-control" for="przykladoweoswietlenie">
                    <input type="radio"   name="oswietlenie"  value="LED" checked>LED</label>
                     <label class="form-control" for="przykladoweoswietlenie">
                    <input type="radio"   name="oswietlenie"  value="halogen">halogen</label>
                        
                        
                </div>
                 <div class="form-group">
                     <label for="przykladoweinfo">Rodzaj nawierzchni</label>
                    <label class="form-control" for="przykladowanawierzchnia">
                    <input type="radio"   name="nawierzchnia"  value="sztuczna" checked>sztuczna</label>
                     <label class="form-control" for="przykladoweoswietlenie">
                    <input type="radio"   name="nawierzchnia"  value="trawiasta">trawiasta</label>
                      <label class="form-control" for="przykladowanawierzchnia">
                    <input type="radio"   name="nawierzchnia"  value="polsztuczna">polsztuczna</label>  
                        
                </div>
<button type="submit" class="btn btn-primary">Wyślij</button>
                </div>
            
                
            </form>
        </div>
    </div>




 
    </div>
</div>
        

	
	<div id="stopka">
		 <p>© 2020 Copyright:<a href="https://zawislandawid.com/"> zawislandawid.com</a></p>
	</div>	
	</div>
	
    
      <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>
</body>
</html>

