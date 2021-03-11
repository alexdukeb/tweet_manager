# Splitfire Test - Alexandre Ralli
## Tweet Manager


## Routes disponibles

Listing des tweets [GET] et filtres disponibles :
```sh
/tweets
/tweets?count={nombre de tweets/page}&page={index page}&author={filtre auteur}&hashtag={filtre hashtag}
```
Ajout d'un tweet [POST]:
```sh
/tweets
```
[POST] Request body (hashtags facultatifs):
```sh
{
    "author": "auteur",
    "message": "Contenu du tweet",
    "hashtags" : [
        "hashtag1",
        "hashtag2",
        ...
    ]
}
```


## Installation sur Linux


Clonez le projet dans **/var/www**
Si vous installez le projet dans à un autre emplacement, indiquez ce chemin dans le fichier **tweet_manager.conf**  pour la variable root.


```sh
git clone https://github.com/alexdukeb/tweet_manager.git
```

Installez les dépendences

```sh
composer install
```

Configuration NGINX PHP-FPM situé dans le fichier **tweet_manager.conf** à la racine du projet.
Après avoir installé NGINX et Php-fpm, mettre ce fichier de configuration dans : 

/etc/nginx/sties-available

/etc/nginx/sties-enabled


Créez la base de donnée SQL puis renseignez les informations de connection dans le .env :

Utilisateur par défaut  : root

Mdp par défaut : 
```sh
DATABASE_URL="mysql://root:@127.0.0.1:3306/tweet_manager"
```

Executez le script SQL : **tweet_manager.sql** situé  à la racine du projet.