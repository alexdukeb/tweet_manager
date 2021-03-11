# Splitfire Test - Alexandre Ralli
## Tweet Manager


## Routes disponibles

Listing des tweets [GET] :
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


## Installation

Installez les dépendences

```sh
composer install
```

Créez la base de donnée SQL puis renseignez les informations de connection dans le .env :

Utilisateur par défaut  : root

Mdp par défaut : 
```sh
DATABASE_URL="mysql://root:@127.0.0.1:3306/tweet_manager"
```

Executez le script SQL : tweet_manager.sql situé  à la racine du projet.