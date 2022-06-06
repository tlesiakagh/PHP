<?php
  @session_start(); // @ Wycisza Notice, wypluwane przez funkcję przed, którą się znajduje.
  if(!isset($_SESSION['user_id'])){
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $file = 'index.php';
    header("Location: http://$host$uri/$file");
    exit();
 }

  $page_title = "Strona główna dla zalogowanych";
  include("header.php");
?>
<?php
  echo "<div class='pageHeader'>
          <h1>Witaj $_SESSION[first_name]</h1>
        </div>";
?>
<p>Zostałeś zalogowany teraz masz możliwość zmiany hasła
  i wyświetlenia listy użytkowników w bazie danych!</p>
<p>
  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
  It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
  It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
  including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry.
</p>
<?php include("footer.php")?>
