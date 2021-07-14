<?php

include 'conn.php';

$tiles=['forest','forest','forest','forest','forest','forest','forest','forest','water','water','water','mountain','mountain','mountain','rock','rock','rock','rock','rock','rock','rock','field','field','field','field','field','field','field','field','field','field','field','field','field'];
shuffle($tiles);

array_push($tiles,'town','triTile','town');

$finaltiles = implode(",", $tiles);



$select_query = "INSERT INTO session (tiles) VALUES ('".$finaltiles."')";
$result = mysqli_query($con, $select_query);



// echo $select_query;
// echo "<hr>";

$query = "SELECT * FROM session ORDER BY ID DESC LIMIT 1";
$resId = mysqli_query($con,$query);
$rowId = mysqli_fetch_array($resId, MYSQLI_ASSOC);

$gameId = $rowId['id'];


$select_query2 = "INSERT INTO tiles (id_session, tile, player1) VALUES ($gameId,35,3)";
$result2 = mysqli_query($con, $select_query2);

$select_query3 = "INSERT INTO tiles (id_session, tile) VALUES ($gameId,36)";
$result3 = mysqli_query($con, $select_query3);

$select_query4 = "INSERT INTO tiles (id_session, tile, player2) VALUES ($gameId,37,3)";
$result4 = mysqli_query($con, $select_query4);


// echo $query;


header("Location: ../game.php?g=".$gameId."&p=1");


?>