<?php
session_start();
require_once('header.php');

if(isset($_POST['log']) && isset($_POST['pass'])){
    
    $username=mysqli_real_escape_string($connection,$_POST['log']);
   
    $password= md5($_POST['pass']);
    
    $sql="select * from administrator where login='$username' and haslo='$password'";
    $result=mysqli_query($connection,$sql);
    
    $count=mysqli_num_rows($result);
    if($count==1) {
        $_SESSION['log']=$username;
        
    }else{
        
        $_SESSION['blad'] = '<span style="font-size:12px;
		color:red;
		padding-top:5px;
		padding-left: 7px;">Nieprawidłowy login lub hasło!</span>';
    }
    
}
if(isset($_SESSION['log'])){
    
    header("Location: home.php" );
    
}


?>
  
     <!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content=" width=device-width, initial-scale=1">

    <title>Strona orlikowa</title>
    <link rel="stylesheet" type="text/css" href="Content/bootstrap.css">
    <link rel="stylesheet" href="Content/style.css">
</head>
<body style="background-image: url('1.jpg');">

    
      
        <div class="row" >
            
            <div class=" col-8 col1" style="height:500px; background-color:#DDE5E6; margin-top:50px; margin-left:250px;border-style:solid; border-color:#007bff; border-top-right-radius: 15px;border-top-left-radius: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px; border-width:30px;">

                <h1 style="text-align:center;">PANEL ADMINA</h1>
                <form method="post" action="index.php">
                    <div class="form-group">
                        <label for="przykladowyLogin">Login</label>
                        <input type="text" class="form-control" name="log" aria-describedby="podpowiedzLogin" placeholder="Wpisz Login" >
                        <small id="podpowiedzLogin" class="form-text text-muted">W powyższym polu wpisujesz swój Login.</small>
                    </div>
                    <div class="form-group">
                        <label for="przykladoweHaslo">Hasło</label>
                        <input type="password" class="form-control" name="pass" placeholder="Wpisz hasło"  >
                        <?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="przykladowyCheckbox">
                        <label class="form-check-label" for="przykladowyCheckbox">Zaznacz mnie!</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="logowanie">Wyślij</button>
                </form>
            </div>
            
           

    
    </div>
       

    <script src="Scripts/jquery-3.0.0.js"></script>
    <script src="Scripts/bootstrap.js"></script>

</body>
</html>


