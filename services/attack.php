<?php 


include 'conn.php';

session_start();
$game = $_SESSION['game'];
$player = $_SESSION['player'];


//destino
$query = "SELECT * FROM tiles WHERE id_session = ".$game." AND tile = ".$_GET['id'];
$resTiles = mysqli_query($con,$query);
$rowTiles = mysqli_fetch_array($resTiles, MYSQLI_ASSOC);



$player1 = $rowTiles['player1'];
$player2 = $rowTiles['player2'];


if($player1>0 && $player2>0){

    $player1--;
    $player2--;

    $select_query = "UPDATE tiles SET player1=".$player1." WHERE tile=".$_GET['id']." AND id_session = ".$game;
    $select_query2 = "UPDATE tiles SET player2=".$player2." WHERE tile=".$_GET['id']." AND id_session = ".$game;

    $result = mysqli_query($con, $select_query);
    $result = mysqli_query($con, $select_query2);

    header("Location: ../game.php");


}else{
    header("Location: ../game.php?msg=3");
}




?>
