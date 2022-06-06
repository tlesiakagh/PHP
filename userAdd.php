<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once("dbConnect.php");

    // Tablica przechowująca komunikaty o błędach
    $errors = array();
    $values = array();

    // Sprawdzanie czy imie zostało podane
    if(empty($_POST['firstName'])){
      $errors[] = "Wpisz imie";
    }else{
      $values[] = trim($_POST['firstName']);
    }
    // Sprawdzanie czy nazwisko zostało podane
    if(empty($_POST['lastName'])){
      $errors[] = "Wpisz nazwisko";
    }else{
      $values[] = trim($_POST['lastName']);
    }
    // Sprawdzanie czy mail został podany
    if(empty($_POST['mail'])){
      $errors[] = "Wpisz adres e-mail";
    }else{
      $values[] = trim($_POST['mail']);
    }
    // Sprawdzanie czy hasło zostało podane
    if(empty($_POST['pass'])){
      $errors[] = "Wpisz hasło";
    }else{
      $values[] = trim($_POST['pass']);
    }

    // Sprawdzanie czy wystąpiły blędy tzn. czy errors[] jest pusta
    if(empty($errors)){
      // Wstawaimy dane do bazy danych
      $q = "INSERT INTO users(first_name, last_name, email, pass, registration_date) VALUES ('$values[0]', '$values[1]', '$values[2]', SHA1('$values[3]'), NOW())";
      $r = mysqli_query($dbc, $q);

      // Sprawdzanie poprawności wykonania zapytania
      if (mysqli_affected_rows($dbc) == 1){
        echo "<p>Nowy użytkownik został dodany</p>";
        include("footer.php");
        exit();
      }else{
        echo "<p class='err'>Nie dodano użytkownika z powodu awarii systemu</p>";
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

<form action="users.php?user_add=a" method="post">
  <fieldset>
    <legend>Dodawanie użytkowników</legend>
    <label>Imię: <input type="text" name="firstName" size="20" maxlength="20"></label>
    <label>Nazwisko: <input type="text" name="lastName" size="20" maxlength="40"></label>
    <label>Adres e-mail: <input type="email" name="mail" size="20" maxlength="60"></label>
    <label>Hasło: <input type="password" name="pass" size="10" maxlength="20"></label>
    <label><input type="submit" value="Zapisz"></label>
  </fieldset>
</form>
