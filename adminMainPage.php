<?php
  @session_start(); // @ Wycisza Notice, wypluwane przez funkcję przed, którą się znajduje.
  if(!isset($_SESSION['user_id'])){
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $file = 'index.php';
    header("Location: http://$host$uri/$file");
    exit();
 }

  $page_title = "Strona główna dla administratora";
  include("header.php");
?>
<?php
  echo "<div class='pageHeader'>
          <h1>Witaj $_SESSION[first_name]</h1>
        </div>";
?>
<p>Zostałeś zalogowany jako administrator</p>
<p>
  Możesz sprawdzić zarejstrowanych użytkowników
</p>
<p>
  Możesz zmodyfikować dane zarejstrowanych użytkowników
</p>
<p>
  Możesz usunąć użytkownika
</p>
<p>
  Możesz dodać nowego użytkownika
</p>
<?php include("footer.php")?>
