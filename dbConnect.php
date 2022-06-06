<?php
Define ('DB_USER', "root");
Define ('DB_PASSWORD',"");
Define ('DB_HOST',"localhost");
Define ('DB_NAME',"sitename");

//nawiązywanie połączenia z bazą danych
$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR
die ("Brak połączenia z serwerem MySQL: " . mysqli_connect_error()); 
 ?>
