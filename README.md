# PDI Web Task Runner

Cette application permet de lancer depuis une interface web des tâches Pentaho Data Integration.

## Installation

La première fois :

```bash
docker create -v /var/lib/mysql --name pdiwebrunner_data tianon/true
```


Ensuite ...

```bash
docker-compose build
docker-compose up
composer install
```

http://dockerhost:9999