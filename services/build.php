<?php 


include 'conn.php';

session_start();
$game = $_SESSION['game'];
$player = $_SESSION['player'];

$query = "SELECT * FROM tiles WHERE id_session = ".$game." AND tile = ".$_GET['id'];
$resTiles = mysqli_query($con,$query);
$rowTiles = mysqli_fetch_array($resTiles, MYSQLI_ASSOC);

$build = $rowTiles['build']+1;

$select_query = "UPDATE tiles SET build =".$build." WHERE tile=".$_GET['id']." AND id_session = ".$game;

// echo $select_query;

$result = mysqli_query($con, $select_query);

header("Location: ../game.php");



?>
