<?php @session_start(); var_dump($_SESSION)?>
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" href="style.css">
<nav>
  <div class="a">
    <h1>Twoja witryna</h1>
  </div>
  <div class="b">
    <ul>
      <?php
        if(isset($_SESSION['user_id']) && isset($_SESSION['user_level'])){
          if($_SESSION['user_level'] == 0){
            echo "
            <li><a href='loggedin.php'>Strona główna</a></li>
            <li><a href='passChange.php'>Zmiana hasła</a></li>
            <li><a href='logout.php'>Wylogowanie</a></li>";
          }else{
            echo "
            <li><a href='users.php'>Użytkownicy</a></li>
            <li><a href='#'>Dodaj wiadomość</a></li>
            <li><a href='logout.php'>Wylogowanie</a></li>";
          }
        }else{
          echo "
          <li><a href='index.php'>Strona główna</a></li>
          <li><a href='register.php'>Zarejestruj się</a></li>
          <li><a href='login_inc.php'>Logowanie</a></li>";
        }
      ?>
    </ul>
  </div>
</nav>
<div class="container">
