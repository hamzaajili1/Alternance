## Pré-requis

- Apache Server
- PHP > 7
- Composer
- MySQL Server
- Symfony 4

## Installation

### Recuparation du projet

Dans un terminal:
Un simple `git clone `
Ensuite `cd ./Kalitics.git` pour e rendre dans la racine du projet.

### Installation des vendors

Executez la commande `composer install` a la racine de votre projet.

### Création de la base de données

Executez la commande `php bin/console doctrine:database:create`.

### Migration

Executez la commande `php bin/console doctrine:schema:update -f`
ou `php bin/console make:migration` suivi de `php bin/console doctrine:migration:migrate`

## Démarrage

Executer la commande suivante sur le terminal: ` php bin/console server:run`
Rendez-vous sur http://VOTRESERVEUR/Alternance.

## Technos

- [jQuery 3] - Framework JS (front-end)
- [Symfony 4] - Framework PHP (back-end)
- [TWIG]

## Auteurs

- Hamza AJILI (https://github.com/hamzaajili1)

# Kalitics
#   A l t e r n a n c e  
 