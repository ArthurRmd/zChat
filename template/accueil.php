<!DOCTYPE html>
<html>
<head>

  <title>Titre</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device=width, initial-scale=1">

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Boostrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

  <!-- Perso -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="js/script.js"></script>
</head>
<body>

  <div class="container">
    <h1 class="text-center"> Chat </h1>

    <label for="msg">Message</label>
      <div class="texte-message" id="chat">
    </div>
    <br>

      <div class="row">
        <div class="col col-md-2">
          <input type="text" class="form-control " id="pseudo" placeholder="Pseudo">
        </div>
        
        <div class="col col-md-8">
          <input type="text" class="form-control"  id="message" placeholder="Message" value="">
        </div>

        <div class="col col-md-2">
        <button type="submit" class="btn btn-primary btn-envoyer">Envoyer</button>
        </div>
      </div>
  </div>
</body>
</html>
