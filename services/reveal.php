<?php 


include 'conn.php';


session_start();
$game = $_SESSION['game'];
$player = $_SESSION['player'];

$query = "SELECT * FROM tiles WHERE id_session = ".$game."AND tile = ".$_GET['id'];
$resTiles = mysqli_query($con,$query);
$rowTiles = mysqli_fetch_array($resTiles, MYSQLI_ASSOC);

if($rowTiles>0){
    header("Location: ../game.php?msg=2");
}else{
    $select_query = "INSERT INTO tiles (id_session, tile) VALUES (".$game.",".$_GET['id'].")";

    // echo $select_query;

    $result = mysqli_query($con, $select_query);

    header("Location: ../game.php");

}


?>
