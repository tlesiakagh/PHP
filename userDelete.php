<?php
function deleteUser($id){
    if(isset($id)){
        require_once("dbConnect.php");
        
        $q = "DELETE FROM users WHERE user_id=$id";
        $r = mysqli_query($dbc, $q);

        if($r == 1){
          echo "<p>Użytkownik został usunięty z bazy danych</p>";
        }else{
          echo "<p>Użytkownik nie został usunięty z powodu błędu serwera :P</p>";
        }
      }
}
?>