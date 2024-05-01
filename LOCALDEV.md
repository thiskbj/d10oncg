# Local Development
The local site will be available at the PROJECT_BASE_URL in the .env file

Your Database credentials in your settings.local.php will need to match the values in the .env file as well

## Starting, Stoping and Using Docker
To start your local environment navigate to the base directory in the command line and use `make up` or if `make` is not available you can use `docker compose up -d`

Similarly, you can use `make down` or `docker compose down` to turn it on and off.

### Accessing the Shell
Use `make shell` to drop into the php containers shell.

### Drush & Composer
 Drush and composer are also available as make commands as well.

 `make drush`

 `make composer`

### Other Services
Adminer (phpmyadmin): adminer.${PROJECT_BASE_URL}
