<?php
 @session_start();
 if(!isset($_SESSION['user_id'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $file = 'index.php';
    header("Location: http://$host$uri/$file");
  }
  $page_title = "Panel do zarządzania uzytkownikami";
  include("header.php");
?>

<div class="pageHeader">
  <p class="userLink"><a href="users.php?user_manager=a">Zarządzanie użytkownikami</a></p>
  <p class="userLink"><a href="users.php?user_add=a">Dodawanie użytkowników</a></p>
  <p class="userLink"><a href="users.php?user_list=a">Lista użytkowników</a></p>
</div>

<?php
if(isset($_GET['user_list'])){
  include("usersList.php");
}elseif(isset($_GET['user_add'])) {
  include("userAdd.php");
}elseif(isset($_GET['user_manager'])) {
  include("userManager.php");
}elseif(isset($_GET['d'])) {
  include("userDelete.php");
  deleteUser($_GET['d']);
}elseif(isset($_GET['e'])) {
  include("userEdit.php");
  prepareForm($_GET['e']);
}elseif(isset($_GET['user_edit'])) {
  include("userEdit.php");
  editUser($_POST['id'],$_POST['firstName'],$_POST['lastName'],$_POST['mail'],$_POST['pass']);
}

?>

<?php include("footer.php")?>
