![logo1](public/assets/img/logo1.png) ![logo2](public/assets/img/logo2.png) ![logo1](public/assets/img/logo1.png)

Un projet d'une boutique eCommerce fictive d'achat de vêtement femme, homme & bébé.

## Installation

Pour installer le projet, rien de plus simple !

Après avoir cloné le projet, vous devez récupérer les dépendances avec la commande :

```bash
composer install
```  
Créé une base de données, avec la commande :
```bash
symfony console doctrine:migrations:migrate
```
Ensuite lancer le serveur, avec la commande :

```bash
symfony serve
```

## Comment j'ai fait ?

Tous les détails sont en ligne de commentaire sur chaque fichier du projet.

Voici toutes les lignes de commande utilisée pour arriver à ce résultat :

```
// création du projet
symfony new lagarderobe --full

// nouveau controller (contolleur & template)
symfony console make:controller

// entity et repository User
symfony console make:user

// création d'une base de donnée en relation
// avec les informations du fichier .env
symfony console doctrine:database:create

// migration de la base de donnée
// (à faire après chaque création ou modification d'une entity)
symfony console make:migration

// envoie de la migration à la base de donnée
// (à faire après chaque "make:migration"
symfony console doctrine:migrations:migrate

// création du nouveau form
symfony console make:form

// création ou modification d'une entity
symfony console make:entity

// création d'un login et logout
symfony console make:auth

// création d'un dashboard controller
symfony console make:admin:dashboard

// Lier une entity au dashboard controller
symfony console make:admin:crud
```

D'autre ligne de commande qui m'ont permis de gérer mon projet :

```
// afficher tout les commandes possible pour ce projet
symfony console

// lancer le serveur
symfony serve

// afficher l'ensemble des routes du site
symfony console debug:router

// afficher l'ensemble des services
symfony console debug:autowiring
```

J'ai aussi ajouté de nouveaux bundles :

```
// EasyAdmin (pour la gestion administrateur)
composer require easycorp/easyadmin-bundle

// Stripe (pour le paiement)
composer require stripe/stripe-php

// MailJet (pour la gestion des emails)
composer require mailjet/mailjet-apiv3-php
```

## License
Ce projet a été réalisé dans le but de l'apprentissage du framework Symfony dans le centre de formation de l'AFPA de Roubaix par [Lio (moi même :)](http://www.liohumb.com).

*Coder sur PHPStorm & Mac os ;)*