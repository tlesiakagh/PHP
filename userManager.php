<?php
  require_once("dbConnect.php");
  $q = "SELECT last_name, first_name, email, registration_date, user_id FROM users";
  $r = mysqli_query($dbc, $q);
  $num = mysqli_num_rows($r);
  $data = mysqli_fetch_all($r);
  echo "<p>Obecnie jest zajerestrowanych $num użytkowników</p>";

  usort($data, function ($a, $b) {
    return $a[3] <=> $b[3];
  });
  
 ?>
<div id="usersMainDiv">
  <table>
    <tr>
      <th>Naziwsko</th>
      <th>Imię</th>
      <th>Email</th>
      <th>Data rejestracji</th>
      <th>Edycja</th>
      <th>Usuwanie</th>
    </tr>
      <?php
      foreach ($data as $record) {
        $date = new DateTime($record[3]);
        $id = $record[4];
        echo "<tr>";
        echo 
            "<td>" . $record[0] . "</td>",
            "<td>" . $record[1] . "</td>",
            "<td>" . $record[2] . "</td>",
            "<td>" . $date -> format('d M Y') . "</td>",
            "<td><a href='users.php?e=$id'>Edytuj</a></td>",
            "<td><a href='users.php?d=$id'>Usuń</a></td>";
        }
        echo "</tr>";
    ?>
  </div>
</table>
</div>
