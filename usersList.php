<?php
  require_once("dbConnect.php");
  $q = "SELECT last_name, first_name, email, registration_date FROM users";
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
    </tr>
      <?php
      foreach ($data as $record) {
        $date = new DateTime($record[3]);
        echo "<tr>";
        for ($i=0; $i < count($record); $i++) {
          if($i != 3)
            echo "<td>" . $record[$i] . "</td>";
          else
            echo "<td>" . $date -> format('d M Y') . "</td>";
        }
        echo "</tr>";
      }
    ?>
  </div>
</table>
</div>
