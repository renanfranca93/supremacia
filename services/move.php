<?php 


include 'conn.php';

session_start();
$game = $_SESSION['game'];
$player = $_SESSION['player'];


//destino
$query = "SELECT * FROM tiles WHERE id_session = ".$game." AND tile = ".$_GET['id'];
$resTiles = mysqli_query($con,$query);
$rowTiles = mysqli_fetch_array($resTiles, MYSQLI_ASSOC);

if($player==1){
    $playerFinal = $rowTiles['player1']+1;
}else{
    $playerFinal = $rowTiles['player2']+1;
}

//origem

$queryOrigem = "SELECT * FROM tiles WHERE id_session = ".$game." AND tile = ".$_GET['o'];
$resOrigem = mysqli_query($con,$queryOrigem);
$rowOrigem = mysqli_fetch_array($resOrigem, MYSQLI_ASSOC);

if($player==1){
    $playerOrigem = $rowOrigem['player1']-1;
}else{
    $playerOrigem = $rowOrigem['player2']-1;
}


//continuacao

if($rowTiles==0){
    echo 'vazio';
    //erro. deve explorar primeiro
    header("Location: ../game.php?msg=1");

}else{

    $select_query = "UPDATE tiles SET player".$player."=".$playerFinal." WHERE tile=".$_GET['id']." AND id_session = ".$game;
    $select_query2 = "UPDATE tiles SET player".$player."=".$playerOrigem." WHERE tile=".$_GET['o']." AND id_session = ".$game;


// $tiles_str = $rowTiles['tiles'];




// echo $select_query;
// echo '<hr>';
// echo $select_query2;

$result = mysqli_query($con, $select_query);
$result = mysqli_query($con, $select_query2);

header("Location: ../game.php");
}
?>
