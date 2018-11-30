<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Projet Tutoré</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JQuerry -->
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
    </script>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>      


    <!-- Fichier Perso -->
    <link rel="stylesheet" type="text/css" media="screen" href="template/log/css/connect/connexion.css" />

    

    
</head>

<body>



    <div class="bloc">

        <h1 class="titre">Connexion</h1>

        <form  action="../page.php" method="post" class="ui form test" >

            <div class="field " :class="{error :!identifiantError}">
                 <label>Identifiant</label>
                  <div class="ui left icon input ">
                    <input type="text" placeholder=""  v-model="identifiant" name="id">
                    <i class="user icon"></i>
                 </div>

            </div>
            
            <div class="field" :class="{error :!passwordError}">
              <label>Mot de passe</label>

              <div class="ui left icon input ">
                <input type="password" placeholder=""  v-model="mdp" name="mdp">
                <i class="lock icon"></i>
             </div>
            </div>


            <div class="field check">
              <div class="ui checkbox">
                <input type="checkbox" tabindex="0" class="hidden">
                <label>Voulez vous retenir l'identifiant</label>
              </div>
            </div>
            <button class="ui button btn-envoi" type="submit">Envoyer</button>

            


          </form>

          <!-- <div class="ui animated fade button"  tabindex="0">
              <div class="visible content">Connecter</div>
              <div class="hidden content"><i class="sign-in icon"></i> </div>
            </div> -->
          

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
    <script src="template/log/js/app.js"></script>

</body>



