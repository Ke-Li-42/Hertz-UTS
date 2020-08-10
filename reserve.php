<?php
  session_start();
  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
  }
  $_SESSION["cart"][$_GET['id']] = 1;
?>