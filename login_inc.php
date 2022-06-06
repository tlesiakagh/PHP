<?php
  $page_title = "Logowanie";
  include("header.php");
?>
<?php
if(isset($errors) && !empty($errors)){
  echo "<h1>Błąd!</h1><p class='err'>Wystąpiły następujące błędy: <br>";
  foreach ($errors as $error) {
    echo "- $error<br>";
  }
  echo "<br>Spróbuj jeszcze raz</p>";
}
?>
<div class="pageHeader">
  <h1>Zaloguj się</h1>
</div>
<form action="login.php" method="post">
<label>Adres e-mail: <input type="email" name="mail" size="20" maxlength="60"></label>
<label>Hasło: <input type="password" name="pass" size="10" maxlength="20"></label>
<label><input type="submit" value="Zaloguj się"></label>
</form>

<?php include("footer.php")?>
