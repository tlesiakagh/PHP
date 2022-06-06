<?php

  @session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once("dbConnect.php");
    require("log_function_inc.php");

    list($wynik, $dane) = log_function($dbc);

    if($wynik){
      // Ustawienie ciasteczek
      $_SESSION['user_id'] = $dane['user_id'];
      $_SESSION['first_name'] = $dane['first_name'];
      $_SESSION['email'] = $dane['email'];
      $_SESSION['user_level'] = $dane['user_level'];
      // Przeniesienie na stronę główną zalogowanego użytkownika
      $host = $_SERVER['HTTP_HOST'];
      $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $file = ' ';
      if($_SESSION['user_level'] == 0)
        $file = 'loggedin.php';
      else
        $file = 'adminMainPage.php';
      header("Location: http://$host$uri/$file");
      exit();
    }else{
      $errors = $dane;
    }
    mysqli_close($dbc);
  }

  include("login_inc.php");
 ?>
