<?php

include 'conn.php';

session_start();

$food=0;
$wood=0;
$stone=0;
$choose=0;



$resTiles = mysqli_query($con,"SELECT * FROM session WHERE id =".$_SESSION['game']);
$rowTiles = mysqli_fetch_array($resTiles, MYSQLI_ASSOC);
$tiles_str = $rowTiles['tiles'];
$tiles_db = explode(',', $tiles_str);



if($_SESSION['player']==1){
    $player='player1';

    $foodDb=$rowTiles['food1'];
    $woodDb=$rowTiles['wood1'];
    $stoneDb=$rowTiles['stone1'];
    $chooseDb=$rowTiles['choose1'];
}else{
    $player='player2';

    $foodDb=$rowTiles['food2'];
    $woodDb=$rowTiles['wood2'];
    $stoneDb=$rowTiles['stone2'];
    $chooseDb=$rowTiles['choose2'];
}



$query="SELECT * FROM tiles WHERE id_session = ".$_SESSION['game']." AND ".$player." >0";
$resActiveTiles = mysqli_query($con,$query);


while ($row = mysqli_fetch_array($resActiveTiles, MYSQLI_ASSOC)) {

    if($_SESSION['player']==1){
        $qtd=$row['player1'];
    }else{
        $qtd=$row['player2'];
    }

    if($tiles_db[$row['tile']-1]=='field'){
        $food+=$qtd;
    }else if($tiles_db[$row['tile']-1]=='rock'){
        $stone+=$qtd;
    }else if($tiles_db[$row['tile']-1]=='forest'){
        $wood+=$qtd;
    }else if($tiles_db[$row['tile']-1]=='triTile'){
        $choose+=$qtd;
    }else if($tiles_db[$row['tile']-1]=='town'){
        $choose+=$qtd;
    }

}

// echo "Food: ".$food."| Madeira: ".$wood." | Stone: ".$stone." | Choose: ".$choose;

$food+=$foodDb;
$wood+=$woodDb;
$stone+=$stoneDb;
$choose+=$chooseDb;


if($_SESSION['player']==1){
    $select_query2 = "UPDATE session SET food1=".$food.", wood1=".$wood.", stone1=".$food.", choose1=".$choose." WHERE id =".$_SESSION['game'];
}else{
    $select_query2 = "UPDATE session SET food2=".$food.", wood2=".$wood.", stone2=".$food.", choose2=".$choose." WHERE id =".$_SESSION['game'];
}

$result = mysqli_query($con, $select_query2);

if($choose>0){
    header("Location: ../game.php?msg=4");
}else{
    header("Location: ../game.php");
}



?>