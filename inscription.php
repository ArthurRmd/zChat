<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Projet Tutoré</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
    </script>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>      


    <!-- Fichier Perso -->
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/style.css" />

    

    
</head>

<body>



    <div class="bloc">

        <h1 class="titre">Inscription</h1>


        <form class="ui form test" >


         


          <div class="field espace-field" :class="{error :pseudoError}" id="pseudo">

              <label>Pseudo</label>
              <div class="ui left icon input ">
                <input type="text" placeholder=""  v-model="pseudo" >
                <i class="address book icon"></i>
              </div>
  
              <div class="position-gauche">
                <div class="ui pointing red basic label " v-if="msgPseudoError">
                  {{textePseudoError}}
                </div>
                <div class="ui pointing label " v-if="msgPseudo">
                  {{textePseudo}}
                </div>
              </div>
            </div>




              <div class="field espace-field" :class="{error :mdpError}" >
            
                  <div class="two fields">
                    <div class="field" id="mdp" >
                      <label for="id-mdp">Mot de passe</label>
                      <div class="ui left icon input ">
                          <input type="password" placeholder="" id="id-mdp"  v-model="mdp" >
                          <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field" id="verifMdp">
                        <label>Vérification mot de passe</label>
                        <div class="ui left icon input ">
                            <input type="password" placeholder=""  v-model="verifMdp" >
                            <i class="lock icon"></i>
                          </div>
                    </div>
                  </div>

                  <div class="position-gauche">
                      <div class="ui pointing red basic label " v-if="msgMdpError">
                        {{texteMdpError}}
                      </div>
                      <div class="ui pointing label " v-if="msgMdp">
                        {{texteMdp}}
                      </div>
                    </div>


                </div>
      



          <div class="field check ">
            <div class="ui checkbox">
              <input type="checkbox" tabindex="0" class="hidden"  v-model="check" id="checkConnected">
              <label>J'accepte les conditions d'utilisation</label>
            </div>
            <div class="ui pointing red basic label " v-if="verifCheck">
                Merci d'accepter les conditions
            </div>
          </div>
          
     
        </form>

        <button class="ui button btn-envoi">Envoyer</button>

        


          <!-- <div class="ui animated fade button"  tabindex="0">
              <div class="visible content">Connecter</div>
              <div class="hidden content"><i class="sign-in icon"></i> </div>
            </div> -->
          

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
    <script src="./assets/js/inscription.js"></script>
    <script src="./assets/js/app.js"></script>

</body>



