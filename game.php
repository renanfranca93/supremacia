<?php

include './services/conn.php';

// $tiles=['forest','forest','forest','forest','forest','forest','forest','forest','water','water','water','mountain','mountain','mountain','rock','rock','rock','rock','rock','rock','rock','field','field','field','field','field','field','field','field','field','field','field','field','field'];
// shuffle($tiles);

// $tileeye = array();

// for($i=1;$i<=37;$i++){

//   array_push($tileeye, "<a href='services/reveal.php?id=".$i."'><i class='fa fa-eye' aria-hidden='true'></i></a>");

// }
session_start();


if(isset($_GET['g'])){
  $_SESSION['game']=$_GET['g'];
}

if(isset($_GET['p'])){
  $_SESSION['player']=$_GET['p'];
}

if(isset($_GET['turn'])&& $_GET['turn']==1){
  $btn = "<a href=services/finish.php><button class='btn btn-danger'>Finalizar turno</button></a>";
}else{
  $btn = "<a href=services/collect.php><button class='btn btn-secondary'>Coletar</button></a>";
}




$tiles = ['fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','fog','town','triTile','town'];

$resTiles = mysqli_query($con,"SELECT * FROM session WHERE id =".$_SESSION['game']);
$rowTiles = mysqli_fetch_array($resTiles, MYSQLI_ASSOC);
$tiles_str = $rowTiles['tiles'];
$tiles_db = explode(',', $tiles_str);

$playerActual=[null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,];
$playerOponent=[null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,];
$build=[null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,];


if($_SESSION['player']==1){
  $food=$rowTiles['food1'];
  $wood=$rowTiles['wood1'];
  $stone=$rowTiles['stone1'];
}

if($_SESSION['player']==2){
  $food=$rowTiles['food2'];
  $wood=$rowTiles['wood2'];
  $stone=$rowTiles['stone2'];
}

$resActiveTiles = mysqli_query($con,"SELECT * FROM tiles WHERE id_session = ".$_SESSION['game']);

while ($row = mysqli_fetch_array($resActiveTiles, MYSQLI_ASSOC)) {
  // if($row['tile']<34){

    $tiles[$row['tile']-1]=$tiles_db[$row['tile']-1];
  // }

  if($row['build']>0)
    {
      $build[$row['tile']-1]="&nbsp;<i class='fa fa-home' aria-hidden='true'></i>&nbsp;".$row['build'];
    }
    
    
    if($_SESSION['player']==1){
      if($row['player1']>0)
      {
        $playerActual[$row['tile']-1]="<i class='fa fa-male blue' aria-hidden='true'></i>&nbsp;".$row['player1'];
      }
      if($row['player2']>0)
      {
        $playerOponent[$row['tile']-1]="<i class='fa fa-male red' aria-hidden='true'></i>&nbsp;".$row['player2'];
      }
    }
    

    if($_SESSION['player']==2){
      if($row['player2']>0)
      {
        $playerActual[$row['tile']-1]="<i class='fa fa-male red' aria-hidden='true'></i>&nbsp;".$row['player2'];
      }
      if($row['player1']>0)
      {
        $playerOponent[$row['tile']-1]="<i class='fa fa-male blue' aria-hidden='true'></i>&nbsp;".$row['player1'];
      }
    }


    

}




?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Supremacia Tabuleiro</title>
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <?php
    if(isset($_GET['msg']) && $_GET['msg']==1){
      echo "<script>alert('Você deve explorar a área antes de se mover!');</script>";
    }
    if(isset($_GET['msg']) && $_GET['msg']==2){
      echo "<script>alert('Área já explorada!');</script>";
    }
    if(isset($_GET['msg']) && $_GET['msg']==3){
      echo "<script>alert('Você não pode atacar uma área vazia!');</script>";
    }
    if(isset($_GET['msg']) && $_GET['msg']==4){
      echo "<script>alert('Você possui recursos a selecionar. Clique nobotão escolher.');</script>";
    }
    ?>

  </head>
  <body>
    <div class="all">
      <div id="hexGrid">
        <div class="hexCrop">
          <div class="hexGrid">
            <div class="hex whiteBg"><img src='./img/logo.png' width='180px'></div>
            <div class="hex whiteBg"><button class='btn btn-secondary'>Escolher</button></div>
            <div class="hex whiteBg"><?php echo $btn; ?></div>
            <div  id="1" class="hex <?php echo $tiles[0]; ?>"><span class='mini'>1</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(1)"><?php echo $playerActual[0]; ?></a><?php echo $playerOponent[0]; ?><?php echo $build[0]; ?></div>
            <div class="hex whiteBg">Jogo:<?php echo $_SESSION['game'];?> | Player:<?php echo $_SESSION['player'];?></div>
            <div class="hex whiteBg"><img src='./img/windrose.png' width='180px'></div>
            <div class="hex whiteBg"><a href="index.php">Sair</a></div>
            <div class="hex whiteBg">
              <img src='./img/food.png' width='40px'><?php echo $food; ?>
              <img src='./img/wood.png' width='40px'><?php echo $wood; ?>
              <img src='./img/stone.png' width='40px'><?php echo $stone; ?>
            </div>
            <div id="1" class="hex <?php echo $tiles[1]; ?>"><span class='mini'>2</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(2)"><?php echo $playerActual[1]; ?></a><?php echo $playerOponent[1]; ?><?php echo $build[1]; ?></div>
            <div id="1" class="hex <?php echo $tiles[2]; ?>"><span class='mini'>3</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(3)"><?php echo $playerActual[2]; ?></a><?php echo $playerOponent[2]; ?><?php echo $build[2]; ?></div>
            <div id="35" class="hex <?php echo $tiles[34]; ?>"><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(35)"><?php echo $playerActual[34]; ?></a><?php echo $playerOponent[34]; ?></div>
            <div id="1" class="hex <?php echo $tiles[3]; ?>"><span class='mini'>4</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(4)"><?php echo $playerActual[3]; ?></a><?php echo $playerOponent[3]; ?><?php echo $build[3]; ?></div>
            <div id="1" class="hex <?php echo $tiles[4]; ?>"><span class='mini'>5</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(5)"><?php echo $playerActual[4]; ?></a><?php echo $playerOponent[4]; ?><?php echo $build[4]; ?></div>
            <div class="hex whiteBg"></div>
            <div id="1" class="hex <?php echo $tiles[5]; ?>"><span class='mini'>6</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(6)"><?php echo $playerActual[5]; ?></a><?php echo $playerOponent[5]; ?><?php echo $build[5]; ?></div>
            <div id="1" class="hex <?php echo $tiles[6]; ?>"><span class='mini'>7</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(7)"><?php echo $playerActual[6]; ?></a><?php echo $playerOponent[6]; ?><?php echo $build[6]; ?></div>
            <div id="1" class="hex <?php echo $tiles[7]; ?>"><span class='mini'>8</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(8)"><?php echo $playerActual[7]; ?></a><?php echo $playerOponent[7]; ?><?php echo $build[7]; ?></div>
            <div id="1" class="hex <?php echo $tiles[8]; ?>"><span class='mini'>9</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(9)"><?php echo $playerActual[8]; ?></a><?php echo $playerOponent[8]; ?><?php echo $build[8]; ?></div>
            <div id="1" class="hex <?php echo $tiles[9]; ?>"><span class='mini'>10</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(10)"><?php echo $playerActual[9]; ?></a><?php echo $playerOponent[9]; ?><?php echo $build[9]; ?></div>
            <div id="1" class="hex <?php echo $tiles[10]; ?>"><span class='mini'>11</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(11)"><?php echo $playerActual[10]; ?></a><?php echo $playerOponent[10]; ?><?php echo $build[10]; ?></div>
            <div id="1" class="hex <?php echo $tiles[11]; ?>"><span class='mini'>12</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(12)"><?php echo $playerActual[11]; ?></a><?php echo $playerOponent[11]; ?><?php echo $build[11]; ?></div>
            <div id="1" class="hex <?php echo $tiles[12]; ?>"><span class='mini'>13</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(13)"><?php echo $playerActual[12]; ?></a><?php echo $playerOponent[12]; ?><?php echo $build[12]; ?></div>
            <div id="1" class="hex <?php echo $tiles[13]; ?>"><span class='mini'>14</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(14)"><?php echo $playerActual[13]; ?></a><?php echo $playerOponent[13]; ?><?php echo $build[13]; ?></div>
            <div id="1" class="hex <?php echo $tiles[14]; ?>"><span class='mini'>15</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(15)"><?php echo $playerActual[14]; ?></a><?php echo $playerOponent[14]; ?><?php echo $build[14]; ?></div>
            <div id="36" class="hex <?php echo $tiles[35]; ?>"><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(36)"><?php echo $playerActual[35]; ?></a><?php echo $playerOponent[35]; ?><?php echo $build[35]; ?></div>
            <div id="1" class="hex <?php echo $tiles[15]; ?>"><span class='mini'>16</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(16)"><?php echo $playerActual[15]; ?></a><?php echo $playerOponent[15]; ?><?php echo $build[15]; ?></div>
            <div id="1" class="hex <?php echo $tiles[16]; ?>"><span class='mini'>17</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(17)"><?php echo $playerActual[16]; ?></a><?php echo $playerOponent[16]; ?><?php echo $build[16]; ?></div>
            <div id="1" class="hex <?php echo $tiles[17]; ?>"><span class='mini'>18</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(18)"><?php echo $playerActual[17]; ?></a><?php echo $playerOponent[17]; ?><?php echo $build[17]; ?></div>
            <div id="1" class="hex <?php echo $tiles[18]; ?>"><span class='mini'>19</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(19)"><?php echo $playerActual[18]; ?></a><?php echo $playerOponent[18]; ?><?php echo $build[18]; ?></div>
            <div id="1" class="hex <?php echo $tiles[19]; ?>"><span class='mini'>20</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(20)"><?php echo $playerActual[19]; ?></a><?php echo $playerOponent[19]; ?><?php echo $build[19]; ?></div>
            <div id="1" class="hex <?php echo $tiles[20]; ?>"><span class='mini'>21</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(21)"><?php echo $playerActual[20]; ?></a><?php echo $playerOponent[20]; ?><?php echo $build[20]; ?></div>
            <div id="1" class="hex <?php echo $tiles[21]; ?>"><span class='mini'>22</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(22)"><?php echo $playerActual[21]; ?></a><?php echo $playerOponent[21]; ?><?php echo $build[21]; ?></div>
            <div id="1" class="hex <?php echo $tiles[22]; ?>"><span class='mini'>23</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(23)"><?php echo $playerActual[22]; ?></a><?php echo $playerOponent[22]; ?><?php echo $build[22]; ?></div>
            <div id="1" class="hex <?php echo $tiles[23]; ?>"><span class='mini'>24</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(24)"><?php echo $playerActual[23]; ?></a><?php echo $playerOponent[23]; ?><?php echo $build[23]; ?></div>
            <div id="1" class="hex <?php echo $tiles[24]; ?>"><span class='mini'>25</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(25)"><?php echo $playerActual[24]; ?></a><?php echo $playerOponent[24]; ?><?php echo $build[24]; ?></div>
            <div id="1" class="hex <?php echo $tiles[25]; ?>"><span class='mini'>26</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(26)"><?php echo $playerActual[25]; ?></a><?php echo $playerOponent[25]; ?><?php echo $build[25]; ?></div>
            <div id="1" class="hex <?php echo $tiles[26]; ?>"><span class='mini'>27</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(27)"><?php echo $playerActual[26]; ?></a><?php echo $playerOponent[26]; ?><?php echo $build[26]; ?></div>
            <div id="1" class="hex <?php echo $tiles[27]; ?>"><span class='mini'>28</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(28)"><?php echo $playerActual[27]; ?></a><?php echo $playerOponent[27]; ?><?php echo $build[27]; ?></div>
            <div id="37" class="hex <?php echo $tiles[36]; ?>"><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(37)"><?php echo $playerActual[36]; ?></a><?php echo $playerOponent[36]; ?></div>
            <div id="1" class="hex <?php echo $tiles[28]; ?>"><span class='mini'>29</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(29)"><?php echo $playerActual[28]; ?></a><?php echo $playerOponent[28]; ?><?php echo $build[28]; ?></div>
            <div id="1" class="hex <?php echo $tiles[29]; ?>"><span class='mini'>30</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(30)"><?php echo $playerActual[29]; ?></a><?php echo $playerOponent[29]; ?><?php echo $build[29]; ?></div>
            <div id="1" class="hex <?php echo $tiles[30]; ?>"><span class='mini'>31</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(31)"><?php echo $playerActual[30]; ?></a><?php echo $playerOponent[30]; ?><?php echo $build[30]; ?></div>
            <div class="hex whiteBg"></div>
            <div class="hex whiteBg"></div>
            <div id="1" class="hex <?php echo $tiles[31]; ?>"><span class='mini'>32</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(32)"><?php echo $playerActual[31]; ?></a><?php echo $playerOponent[31]; ?><?php echo $build[31]; ?></div>
            <div id="1" class="hex <?php echo $tiles[32]; ?>"><span class='mini'>33</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(33)"><?php echo $playerActual[32]; ?></a><?php echo $playerOponent[32]; ?><?php echo $build[32]; ?></div>
            <div  id="1"class="hex <?php echo $tiles[33]; ?>"><span class='mini'>34</span><a href=# data-toggle='modal' data-target='#modalAcoes' onclick="getTileId(34)"><?php echo $playerActual[33]; ?></a><?php echo $playerOponent[33]; ?><?php echo $build[33]; ?></div>
            <div class="hex whiteBg"></div>
  
          </div>
        </div>
      </div>
    </main>

    <div class="modal fade" id="modalAcoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Documentos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
    <ul>
      <a id="exploren" href=#><li>Explorar N</li></a>
      <a id="explorene" href=#><li>Explorar NE</li></a>
      <a id="explorese" href=#> <li>Explorar SE</li></a>
      <a id="explores" href=#> <li>Explorar S</li></a>
      <a id="exploreso" href=#><li>Explorar SO</li></a>
      <a id="exploreno" href=#><li>Explorar NO</li></a>
      <hr>
      <a id="moven" href=#> <li>Mover N</li></a>
      <a id="movene" href=#><li>Mover NE</li></a>
      <a id="movese" href=#><li>Mover SE</li></a>
      <a id="moves" href=#><li>Mover S</li></a>
      <a id="moveso" href=#><li>Mover SO</li></a>
      <a id="moveno" href=#><li>Mover NO</li></a>
      <hr>
      <a id="build" href=#><li>Construir</li></a>
      <hr>
      <a id="attack" href=#><li>Atacar</li></a>
    </ul>
                        
      
   
      
    </div>
  </div>
</div>
<script>

function getTileId(id){

  //town A
  if(id==35){
    var n=1;
    var ne=4;
    var se=10;
    var s=9;
    var so=8;
    var no=3;

    document.getElementById('exploren').setAttribute("href", "services/reveal.php?id="+n);
    document.getElementById('explorene').setAttribute("href", "services/reveal.php?id="+ne);
    document.getElementById('explorese').setAttribute("href", "services/reveal.php?id="+se);
    document.getElementById('explores').setAttribute("href", "services/reveal.php?id="+s);
    document.getElementById('exploreso').setAttribute("href", "services/reveal.php?id="+so);
    document.getElementById('exploreno').setAttribute("href", "services/reveal.php?id="+no);

    document.getElementById('moven').setAttribute("href", "services/move.php?id="+n+"&o="+id);
    document.getElementById('movene').setAttribute("href", "services/move.php?id="+ne+"&o="+id);
    document.getElementById('movese').setAttribute("href", "services/move.php?id="+se+"&o="+id);
    document.getElementById('moves').setAttribute("href", "services/move.php?id="+s+"&o="+id);
    document.getElementById('moveso').setAttribute("href", "services/move.php?id="+so+"&o="+id);
    document.getElementById('moveno').setAttribute("href", "services/move.php?id="+no+"&o="+id);

    document.getElementById('build').setAttribute("href", "services/build.php?id="+id);

    document.getElementById('attack').setAttribute("href", "services/attack.php?id="+id);

  }else if(id==1){


    var se=4;
    var s=35;
    var so=3;



    document.getElementById('exploren').removeAttribute("href");
    document.getElementById('explorene').removeAttribute("href")
    document.getElementById('explorese').setAttribute("href", "services/reveal.php?id="+se);
    document.getElementById('explores').setAttribute("href", "services/reveal.php?id="+s);
    document.getElementById('exploreso').setAttribute("href", "services/reveal.php?id="+so);
    document.getElementById('exploreno').removeAttribute("href")

    document.getElementById('moven').removeAttribute("href")
    document.getElementById('movene').removeAttribute("href")
    document.getElementById('movese').setAttribute("href", "services/move.php?id="+se+"&o="+id);
    document.getElementById('moves').setAttribute("href", "services/move.php?id="+s+"&o="+id);
    document.getElementById('moveso').setAttribute("href", "services/move.php?id="+so+"&o="+id);
    document.getElementById('moveno').removeAttribute("href")

    document.getElementById('build').setAttribute("href", "services/build.php?id="+id);

    document.getElementById('attack').setAttribute("href", "services/attack.php?id="+id);

  }else if(id==2){

    var ne=3;
    var se=8;
    var s=7;
    var so=35;


    document.getElementById('exploren').removeAttribute("href");
    document.getElementById('explorene').setAttribute("href", "services/reveal.php?id="+ne);
    document.getElementById('explorese').setAttribute("href", "services/reveal.php?id="+se);
    document.getElementById('explores').setAttribute("href", "services/reveal.php?id="+s);
    document.getElementById('exploreso').setAttribute("href", "services/reveal.php?id="+so);
    document.getElementById('exploreno').removeAttribute("href")

    document.getElementById('moven').removeAttribute("href")
    document.getElementById('movene').setAttribute("href", "services/move.php?id="+ne+"&o="+id);
    document.getElementById('movese').setAttribute("href", "services/move.php?id="+se+"&o="+id);
    document.getElementById('moves').setAttribute("href", "services/move.php?id="+s+"&o="+id);
    document.getElementById('moveso').setAttribute("href", "services/move.php?id="+so+"&o="+id);
    document.getElementById('moveno').removeAttribute("href")

    document.getElementById('build').setAttribute("href", "services/build.php?id="+id);

    document.getElementById('attack').setAttribute("href", "services/attack.php?id="+id);

  }else if(id==3){

    var ne=1;
    var se=35;
    var s=8;
    var so=2;


    document.getElementById('exploren').removeAttribute("href");
    document.getElementById('explorene').setAttribute("href", "services/reveal.php?id="+ne);
    document.getElementById('explorese').setAttribute("href", "services/reveal.php?id="+se);
    document.getElementById('explores').setAttribute("href", "services/reveal.php?id="+s);
    document.getElementById('exploreso').setAttribute("href", "services/reveal.php?id="+so);
    document.getElementById('exploreno').removeAttribute("href")

    document.getElementById('moven').removeAttribute("href")
    document.getElementById('movene').setAttribute("href", "services/move.php?id="+ne+"&o="+id);
    document.getElementById('movese').setAttribute("href", "services/move.php?id="+se+"&o="+id);
    document.getElementById('moves').setAttribute("href", "services/move.php?id="+s+"&o="+id);
    document.getElementById('moveso').setAttribute("href", "services/move.php?id="+so+"&o="+id);
    document.getElementById('moveno').removeAttribute("href")

    document.getElementById('build').setAttribute("href", "services/build.php?id="+id);

    document.getElementById('attack').setAttribute("href", "services/attack.php?id="+id);

}else if(id==4){

var se=5;
var s=10;
var so=35;
var no=1;


document.getElementById('exploren').removeAttribute("href");
document.getElementById('explorene').removeAttribute("href");
document.getElementById('explorese').setAttribute("href", "services/reveal.php?id="+se);
document.getElementById('explores').setAttribute("href", "services/reveal.php?id="+s);
document.getElementById('exploreso').setAttribute("href", "services/reveal.php?id="+so);
document.getElementById('exploreno').setAttribute("href", "services/reveal.php?id="+no);

document.getElementById('moven').removeAttribute("href")
document.getElementById('movene').removeAttribute("href")
document.getElementById('movese').setAttribute("href", "services/move.php?id="+se+"&o="+id);
document.getElementById('moves').setAttribute("href", "services/move.php?id="+s+"&o="+id);
document.getElementById('moveso').setAttribute("href", "services/move.php?id="+so+"&o="+id);
document.getElementById('moveno').setAttribute("href", "services/move.php?id="+no+"&o="+id);

document.getElementById('build').setAttribute("href", "services/build.php?id="+id);

document.getElementById('attack').setAttribute("href", "services/attack.php?id="+id);

}


}

</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>
