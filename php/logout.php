<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["name"]);
$_SESSION["logout"] = true;
header("Location: index.php");
