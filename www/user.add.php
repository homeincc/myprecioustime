<?php
session_start();
require("functions.php");

$connection = Connect();


	
$u = new User();
$u->Create(md5(time()),"");
$u->Persist($connection);
$us = new UserScore();
$us->id = $u->id;
$us->Create($_POST["males"], $_POST["females"], $_POST["age_young"], $_POST["age_mid"], $_POST["age_old"], $_POST["body_slim"], $_POST["body_mid"], $_POST["body_fat"], $_POST["soft"], $_POST["hard"], $_POST["profi"], $_POST["amateur"], $_POST["white"], $_POST["black"], $_POST["asian"], $_POST["couple"], $_POST["threesome"], $_POST["group"]);
$us->Persist($connection);
echo $us->id;
$_SESSION["uid"]  = $us->id;

?>