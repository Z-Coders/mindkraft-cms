<?php
  session_start();
  require 'cms.php';
  $sql = new SQL();
  $user = $_POST['user'];
  $password = $_POST['password'];
  $table_prefix = $sql->getTeblePrefix();
  $query = "select * from ".$table_prefix."cpanel_users where username='".$user."' and password='".$password."'";
  $result = $sql->execQuery($query);
  if (mysqli_num_rows($result) == 1) {
    $_SESSION['user'] = true;
    header("location:console.php");
  }
  else {
    header("location:../index.php");
  }
?>
