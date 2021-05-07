# evaluation Webservices-API
pour cette utilisation j'ai utilisé laravel et blade.

## Installation

modifier le .env pour la base de données

## Command

````bash
php artisan migrate:fresh --seed
````

````bash
php artisan serve
````

## Identification

Au seed de la base de données un utilisteurs sera déjà créer pour tester l'application

email: john@doe.com

mdp : 1234

## Routes API

- GET : localhost:[port]/api/articles
- POST : localhost:[port]/api/articles
- PUT : localhost:[port]/api/articles/{id}
- DELETE : localhost:[port]/api/articles/{id}
- GET : localhost:[port]/api/articles/search


- POST : localhost:[port]/api/redacteurs
- PUT : localhost:[port]/api/redacteurs/{id}
- DELETE : localhost:[port]/api/redacteurs/{id}


- POST : localhost:[port]/api/categories
- PUT : localhost:[port]/api/categories/{id}
- DELETE : localhost:[port]/api/categories/{id}

## Routes Application

- localhost:[port]/
- localhost:[port]/register
- localhost:[port]/login
- localhost:[port]/dashboard
- localhost:[port]/articles
- localhost:[port]/articles/id/update
- localhost:[port]/articles/add
- localhost:[port]/categories
- localhost:[port]/redacteurs
- localhost:[port]/search
