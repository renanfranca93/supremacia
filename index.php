


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <title>Supremacia</title>
  </head>
  <body>
  <div class="container">
      <div class="row">
          <div class="col-12">
          <h2>Seja bem-vindo a SUPREMACIA!</h2>
        <p>O que deseja fazer?</p>
          </div>
      </div>
    <div class="row">

    <div class="col col-6">

        <a href="services/new_game.php"><button class='btn btn-primary' type="button">Criar novo Jogo</button></a>

    </div>

    <div class="col col-6">

        <form action="game.php" method='GET' >
            <div class="form-group">
                <input type="text" class="form-control" name='g' placeholder="Id do Jogo Existente">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="p" id="p" value="1">
                <label class="form-check-label" for="exampleRadios2">
                    Player 1
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="p" id="p" value="2">
                <label class="form-check-label" for="exampleRadios2">
                    Player 2
                </label>
                </div>
                <!-- <label for="html" >Player 1</label>
                <input type="radio" id="player" name='p' value="1" class="form-check-input">
                <label for="html">Player 2</label>
                <input type="radio" id="player" name='p' value="2" class="form-check-input"> -->
                <button class='btn btn-primary' type="submit">Entrar em Jogo Existente</button>
            </div>
            
        </form>


    </div>

    </div>


    


</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>