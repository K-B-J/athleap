<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["name"]);
unset($_SESSION["weight"]);
unset($_SESSION["height"]);
unset($_SESSION["fcoins"]);
unset($_SESSION["age"]); 
$_SESSION["logout"] = true;
header("Location: index.php");
