# zChat
zChat est une application de live chat complète et fonctionnelle. Elle fonctionne à l'aide d'une API appelée par un client.

## Technologies
### Back-End
API PHP suivant le modèle MVC. Toutes les erreurs potentielles sont gérées. Les codes HTTP et messages d'erreur sont cohérents aux requêtes du client.

La base de données utilisée est MySQL.

### Front-End
Le Front-End est développé entièrement en Vue.js. Les appels API sont optimisés pour maximiser les performances. Cela rend l'application très rapide et surtout dynamique.

Le framework CSS Semantic UI a été utilisé pour le design de l'application.

## Fonctionnalités
 - Connexion sécurisée. Le mot de passe est hashé en base de données. La connexion est mise en cache dans le cache du navigateur (`localStorage`) afin de minimiser les requêtes inutiles au serveur.
 - Inscription
 - Ecrans de loading lors du chargement des requêtes API
 - Reception / Envoi de message
 - Rafraichissement automatique des messages togglable
 - Gestion des emojis. Pour envoyer un emoji, il suffit d'envoyer un message contenant l'identifiant de l'emoji entouré de deux-points `:basketball: = 🏀`. Liste des emojis : [discord_emojis.min.json](api/lib/discord_emojis.min.json)
 - Envoyer une demande d'ajout d'ami
 - Accepter une demande d'ajout d'ami
 - Refuser une demande d'ajout d'ami

 ## Configurer
 1. Installer le SGBD MySQL
 2. Créer une base de données avec le nom de votre choix
 3. Importer dans cette base de données le fichier [database.sql](database.sql)
 4. Renommer le fichier [DatabaseConfig.default.class.php](api/lib/DatabaseConfig.default.class.php) en `DatabaseConfig.class.php`
 5. Configurer la connexion à votre base de données dans le fichier `DatabaseConfig.class.php`

## Test
Des comptes de test avec des données pré-remplies ont été généré dans le fichier [database.sql](database.sql).
Les utilisateurs sont les suivants : `[Antoine, Arthur, Thomas, Océan, Benoit]`. Le mot de passe de ces comptes est `test`.

*Selon votre configuration/version de PHP, le hashage des mots de passe fait de manière différente. Si c'est le cas, ces comptes ne pourront pas fonctionner.*

## TODO
 - [ ] Supprimer un ami déjà accepté
 - [ ] Interface d'ajout d'emoji user-friendly

## Auteurs
 - Antoine SAUVAGE : Toute l'API. Toute la partie Vue.js.
 - Arthur REMOND : Pages de connexion/inscription et design de l'application

## Repository GitHub
[https://github.com/ArthurRmd/zChat](https://github.com/ArthurRmd/zChat)

## Licence
[Licence MIT](https://github.com/ArthurRmd/zChat/blob/master/LICENSE)