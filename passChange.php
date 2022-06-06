<?php
  @session_start();
  if(!isset($_SESSION['user_id'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $file = 'index.php';
    header("Location: http://$host$uri/$file");
  }
  $page_title = "Zmiana hasła";
  include("header.php")
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])){
    require_once("dbConnect.php");
    // Tablica przechowująca komunikaty o błędach
    $errors = array();
    //Sprawdzanie czy aktualne hasło zostało podane
    if(empty($_POST['pass'])){
      $errors[] = "Wpisz aktualne hasło";
    }else{
      $p = trim($_POST['pass']);
    }
    // Sprawdzanie czy podano nowe hasło i czy jest takie samo
    if(empty($_POST['newPass']) || empty($_POST['repNewPass'])){
      if(empty($_POST['newPass']))
        $errors[] = "Wpisz nowe hasło";
      if(empty($_POST['repNewPass']))
        $errors[] = "Powtórz nowe hasło";
    }else{
      if($_POST['newPass'] != $_POST['repNewPass']){
        $errors[] = "Nowe hasło i Powtórzone nowe hasło są różne";
      }else{
        $np = trim($_POST['newPass']);
      }
    }
    // Sprawdzanie czy wystąpiły blędy tzn. czy errors[] jest pusta
    if(empty($errors)){
      // Sprawdzenie poprawności wprowadzonych danych: maila i aktualnego hasła
      $q = "SELECT user_id FROM users WHERE (email='$_SESSION[email]' AND pass=SHA1('$p'))";
      $r = mysqli_query($dbc, $q);
      $num = mysqli_num_rows($r);
      if($num == 1){
        // pobieramy id użytkownika
        $row = mysqli_fetch_array($r, MYSQLI_NUM);

        // tworzymy query do UPDATE
        $q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]";
        $r = mysqli_query($dbc, $q);

        // Sprawdzanie poprawności wykonania zapytania
        if (mysqli_affected_rows($dbc) == 1){
          echo "<p>Hasło zostało zmienione</p>";
          include("footer.php");
          exit();
        }else{
          echo "<p class='err'>Hasło nie zostało zmienione z powodu awarii systemu</p>";
          include("footer.php");
          exit();
        }
        }else {
          echo "<h1>Błąd!</h1><p class='err'>Wystąpiły następujące błędy: <br>";
          echo "- Twoje aktualne hasło jest inne!<br>";
          echo "<br>Spróbuj jeszcze raz</p>";
        }
    }else{
      echo "<h1>Błąd!</h1><p class='err'>Wystąpiły następujące błędy: <br>";
      foreach ($errors as $error) {
        echo "- $error<br>";
      }
      echo "<br>Spróbuj jeszcze raz</p>";
    }
  }
?>

<div class="pageHeader">
  <h1>Zmiana hasła</h1>
</div>
<form action="passChange.php" method="post">
<label>Aktualne hasło: <input type="password" name="pass" size="10" maxlength="20"></label>
<label>Nowe hasło: <input type="password" name="newPass" size="10" maxlength="20"></label>
<label>Powtórz nowe hasło: <input type="password" name="repNewPass" size="10" maxlength="20"></label>
<label><input type="submit" value="Zmień hasło"></label>
</form>

<?php include("footer.php")?>
