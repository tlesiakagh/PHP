<?php
@session_start();
if(!isset($_SESSION['user_id'])){
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $file = 'index.php';
    header("Location: http://$host$uri/$file");
    exit();
}else{
    $_SESSION = [];
    session_destroy();
    setcookie('PHPSESSID',"", time()-3601);

    $page_title = "Ekran wylogowania";
    include("header.php");
    echo "<p>Zostałeś bezpiecznie wylogowany</p>";
    include("footer.php");
}
?>
