# Web Task Runner for Pentaho Data Integration

Cette application web permet de lancer depuis une interface web des tâches Pentaho Data Integration.

## Installation

L'installation fait appel au gestionnaire de dépendances Composer qui se charge de récupérer l'ensemble des dépendances (CakePHP, Pentaho Data Integration, etc.).

```bash
curl -sS https://getcomposer.org/installer | php
composer install
```

En cas d'erreur lors de la décompression de Pentaho Data Integration par Composer, passez la valeur de configuration ```memory_limit``` de votre ```php.ini``` à ```-1```.

### Création de la base de données

Créez une base de données MySQL.


### Configurer les paramètres de connexion à la base de données

Renseignez les informations de connexion à la base de données nouvellement créée dans le fichier ```config/app.php``` (lignes 211 et suivantes).

### Créer le schéma de données

Pour créer le schéma initial de données, nous utilisons la console CakePHP

```bash
bin/cake migrations migrate
```


### Créer un virtualhost Apache ou un serverblock nginx

Créez un hôte virtuel Apache ou un serverblock nginx pointant vers le dossier webroot/


### Créer l'utilisateur initial de l'application

Depuis l'interface Web, cliquez sur **Register** et créez un nouveau compte.

Exécutez la requête SQL suivante pour rendre l'utilisateur nouvellement créé administrateur.

```sql
UPDATE users SET active=1, is_superuser=1 WHERE id=1;
```

## Démarrage rapide

### Paramètres

Commencez par créer l'ensemble des paramètres utilisés dans les tâches Pentaho Data Integration que vous utiliserez

### Tâches

Déposez les fichiers .kjb (Kettle JoB) dans le dossier ```scripts/```
Ajoutez ensuite les tâches que vous désirez lancer depuis **Web Task Runner**

### Scénarios

Créez ensuite vos scénarios.

Aux scénarios sont associés des tâches (préalablement ajoutées) et des paramètres qui seront hérités par l'ensemble des tâches qui composent le scénario (typiquement, les paramètres de connexions à vos bases de données et plus généralement tous les paramètres que vous souhaitez partager avec l'ensemble des tâches associées au scénario).

### Migrations

Vous constituez ensuite vos migrations. 

Chaque migration est basée sur un scénario. Vous pouvez ensuite renseigner la valeur des paramètres qui sont associés au scénario et aux tâches associées au scénario pour la migration courante.

#### Exécution d'une migration

Une fois la migration paramétrée, vous pouvez lancer son exécution (un auto-diagnostique avant exécution est alors effectué afin de s'assurer que l'ensemble des prérequis sont satisfaits). Si tel est le cas, l'exécution est lancée et vous pouvez ensuite suivre le déroulement par l'intermédiaire du log ```kitchen.sh``` affiché en direct (celui-ci vous informe de la progression de la migration et des erreurs éventuelles — contrastées en rouge).

## Licence et Copyright

**Web Task Runner** pour *Pentaho Data Integration* est un outil développé par Oblady SARL et placé sous licence AGPL.    
**Web Task Runner** pour *Pentaho Data Integration* n'a pas été validé ou approuvé par Hitachi Data Systems. 

Pentaho, PDI et le logo Pentaho sont des marques déposées de Hitachi Data Systems. 

Ce programme est distribué dans l'espoir qu'il sera utile, mais SANS AUCUNE GARANTIE; sans même la garantie implicite de QUALITÉ MARCHANDE ou D'ADÉQUATION À UN USAGE PARTICULIER. Pour plus d'informations, reportez vous au fichier LICENCE.txt de l'archive.