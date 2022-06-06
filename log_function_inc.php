<?php
function log_function($dbc){
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Tablica przechowująca komunikaty o błędach i wartości z bazy danych
    $errors = array();
    $values = array();

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
      // Sprawdzenie poprawności wprowadzonych danych: maila i aktualnego hasła
      $q = "SELECT user_id, first_name, email, user_level FROM users WHERE (email='$values[0]' AND pass=SHA1('$values[1]'))";
      $r = mysqli_query($dbc, $q);

      // Sprawdzanie poprawności wykonania zapytania
      if(mysqli_num_rows($r) == 1){
        // Pobranie wyniku zapytania
        $row = mysqli_fetch_assoc($r);
        return [true, $row];
      }else{
        $errors[] = "Wprowadzone hasło lub email są nieprawidłowe";
      }
    }
    return [false, $errors];
  }
}
 ?>
