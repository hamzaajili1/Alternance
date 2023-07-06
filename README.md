# Kalitics

## Pré-requis

- Apache Server
- PHP
- Composer
- MYSQL Server
- Symfony 4

## Installation

### Recuparation du projet

Dans un terminal:
Un simple `git clone `
Ensuite `cd ./Alternance.git` pour accéder à la racine du projet.

### Installation des vendors

Executez la commande `composer install` a la racine de votre projet.

### Création de la base de données

Executez la commande `php bin/console doctrine:database:create`.

### Migration

Executez la commande `php bin/console doctrine:schema:update -f` (pas de soucis en dev)
ou `php bin/console make:migration` suivi de `php bin/console doctrine:migration:migrate`

## Démarrage

Executer la commande suivante `php bin/console server:run`
Rendez-vous sur http://VOTRESERVEUR/Alternance.

## Technos

- [JavaScript]
- [Symfony4] - Framework PHP (back-end)
- [CSS] - Framework JS/CSS (front-end)

## Auteurs

- **Hamza AJILI** (https://github.com/hamzaajili1)

=======

# Kalitics
