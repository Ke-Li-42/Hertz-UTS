<?php
  session_start();
  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
  }
  unset($_SESSION["cart"][$_GET['id']]);
  header("Location: reservation.php");
?>