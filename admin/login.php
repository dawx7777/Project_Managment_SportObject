<?php
    
 require_once 'header.php';
  $error = $user = $pass = "";




  if (isset($_POST['login']))
  {
    $user = sanitizeString($_POST['login']);
    $pass = sanitizeString($_POST['haslo']);
    
    if ($user == "" || $pass == "")
     echo "Nie wszystkie pola zostały wypełnione";
    else
    {
      $result = queryMysql("select login,hasło from konto_logowania WHERE login='$user' AND hasło='$pass'");

      if ($result->num_rows == 0)
      {
        echo "Nieudana próba logowania";
      }
      else
      {
        $_SESSION['login'] = $user;
        $_SESSION['haslo'] = $pass;
        die("Jesteś zalogowany jako $user ");
      }
    }
  }


?>
