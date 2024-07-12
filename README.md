# Projet Laravel de Gestion de Produits et Commandes
## Description
Ce projet est une application web de gestion de produits et de commandes. Il permet de créer, modifier, et supprimer des produits, de gérer des catégories, ainsi que de passer et suivre des commandes.

## Fonctionnalités
- Gestion des produits: Ajout, modification, suppression de produits, avec une option pour les promotions.
- Gestion des catégories: Ajout, modification, suppression de catégories.
Gestion des commandes: Affichage des commandes, modification de leur statut, et visualisation des détails.
- Carrousel de promotions: Affichage des produits en promotion sur la page d'accueil.
- Validation du panier: Passage de commande avec saisie de l'adresse de livraison et méthode de paiement.

## Prérequis
- PHP >= 7.3
- Composer
- Serveur web (Apache, Nginx, etc.)
- Base de données MySQL

## Installation
1. Cloner le dépôt du projet:
```bash
git clone https://github.com/Hiintz/laravel-ecommerce.git
```
2. Accéder au répertoire du projet:
```bash
cd laravel-ecommerce
```
3. Installer les dépendances via Composer:
```bash
composer install
```
4. Configurer le fichier .env:
```bash
cp .env.example .env
Modifier les valeurs des variables de configuration (DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.) pour correspondre à votre environnement.
```
5. Importer les données de la base de données:
Le fichier d'export de la base de données est disponible dans le dossier database. 
6. Exécuter les migrations:
```bash
php artisan migrate --seed
```
7. Démarrer le serveur de développement:
```bash
php artisan serve
```
L'application sera accessible à l'adresse http://localhost:8000.

## Utilisation
### Accès à l'interface d'administration
Pour accéder à l'interface d'administration, rendez-vous à l'adresse http://localhost:8000/admin ou via le bouton "Admin" après s'être authentifié. Vous pouvez également vous créer un compte facilement. Vous pourrez gérer les produits, catégories et commandes depuis cet espace.

### Passer une commande
1. Accéder à la page d'accueil pour voir les produits en promotion.
2. Ajouter des produits au panier.
3. Valider le panier en remplissant les informations de livraison et de paiement.

## Structure du projet
- app/Http/Controllers: Contient les contrôleurs de l'application.
- app/Models: Contient les modèles de l'application.
- resources/views: Contient les vues de l'application.
- routes/web.php: Contient les routes de l'application.
- database/migrations: Contient les migrations de la base de données.
- public/: Contient les fichiers publics accessibles (CSS, JS, images, etc.).

## Remarques
Les données initiales sont disponibles via le fichier d'export de la base de données dans le dossier database.
Assurez-vous de bien configurer votre environnement .env pour éviter les problèmes de connexion à la base de données.

## Auteur
Tony EVRARD - 2024