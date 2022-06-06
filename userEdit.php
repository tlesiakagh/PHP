<?php
function prepareForm($id){
    require_once("dbConnect.php");

    $q = "SELECT first_name, last_name, email, pass fROM users WHERE user_id=$id";
    $r = mysqli_query($dbc, $q);
    
    $row= mysqli_fetch_array($r);

    echo "
    <form action='users.php?user_edit=1' method='post'>
    <fieldset>
        <legend>Edycja użytkowników</legend>
        <input type=hidden name=id value=$id></label>
        <label>Imię: <input type=text name=firstName size=20 maxlength=20 value=$row[first_name]></label>
        <label>Nazwisko: <input type=text name=lastName size=20 maxlength=40 value=$row[last_name]></label>
        <label>Adres e-mail: <input type=email name=mail size=20 maxlength=60 value=$row[email]></label>
        <label>Hasło: <input type=password name=pass size=10 maxlength=20 value=$row[pass]></label>
        <label><input type=submit value=Zapisz></label>
    </fieldset>
    </form>
    ";
}

function editUser($id, $fname, $lname, $mail, $pass){
    require_once("dbConnect.php");

    $q = "UPDATE users SET first_name='".$fname."', last_name='".$lname."', email='".$mail."', pass=SHA1('".$pass."') WHERE user_id=$id";
    $r = mysqli_query($dbc, $q);
    if($r == 1)
        echo "<p>Edycja użytkownika powiodła się</p>";
    else
        echo "<p>Podczas edycji wystąpił błąd :P</p>";
}

?>