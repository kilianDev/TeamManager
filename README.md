# TeamManager

This project is a simple team manager, based on Silex Framework.
It uses : 
* Doctrine DBAL for querying the database
* Twig for its templates
* Bootstrap 3 for the UI

Getting started
---------------
* Install the dependencies :
    composer install

* Import the db schema into an already created MySQL database (exemple with a db named teammanager)
    mysql -u root -p teammanager < app/resources/schema.sql
 
* Optionnaly, import some fake data :
    mysql -u root -p teammanager < app/resources/some_data.sql
 
* Finally, configure the DB credentials into the config file 
    app/config/prod.php

 
And you're good to go !

Application structure
---------------------
    - app
      -- config - Contains the configuration files (dev.php and prod.php)
      -- resources - Contains the sql resources for initiating the project
      -- app.php - Called by index.php, initializes the app by registering libraries into the dependency injection container.
      -- routes.php - Called by index.php, routes map urls to controller classes.
    - src - Contains the main application code
      -- Teammanager - this folder contains the root of the namespace.
        --- Controller - Contains the controller classes.
        --- Form - Contains the Form classes.
        --- Model - Contains the entities.
        --- Repository - Contains a repository fot each entities (CRUD operations in DB)
    - vendor - Contains the dependencies managed by composer.
    - web - Contains static files (CSS, JS, etc) as well as the main entrypoint (index.php)
    
    

