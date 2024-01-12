#
# Drupal 10 on Cloud.gov Proof-of-concept 

-------------

Based on:

# cf-ex-drupal8

-------------


# Drupal 10 on Cloud.gov Proof-of-concept Manifest

- **.bp-config**
Cloud foundry buildpack configuration
  - **httpd**
httpd config file modifications to support Drupal 10 on CF/Cloud.gov
  - **php**
    - **php.ini.d**
      - **extensions.ini**
Enable php extensions for php buildpack
      - **memory\_limit.ini**
php memory limit configuration
  - **options.json**
buildpack options, including installing the latest version of php 8.2
- . **editorconfig**
Drupal editor config normalization
- **.git**
- **.gitattributes**
- **.gitignore**
- **.profile**
Run during CF/Cloud.gov app initialization – creates/modifies .htaccess file
- **LICENSE.txt**
- **README.md**
- **apt.yml**
apt packages to add – adds mariadb/mysql client
- **bootstrap.sh**
Bootstrap.sh script – run via the ./scripts/deploy-cloudgov.sh
 Should only be run on initial deployment – otherwise it will replace the database
 Many updates, enhancements, and safeguards should be put in place if something like this is used in production
- **composer.json**
composer file for Drupal 10
- **composer.lock**
composer lock file for Drupal 10
- **config**
Drupal configuration files imported during site initialization – imported via bootstrap.sh script
- **cronish.sh**
Script to simulate cron – triggers Drupal site cron
- **db**
Location of seed database. If you want to import database from an existing site, include it here. Imported in the bootstrap.sh script
- **drush**
For use with/by the drush utility for Drupal
- **manifest.yml**
Configures the CF/Cloud.gov app(s), services, etc
- **private**
Placeholder directory for Drupal private directory
- **Scripts**
  - **composer**
    - **ScriptHandler.php**
composer support script
  - **delete-cloudgov.sh**
Deletes entire app (aside from routes)!
 Use only in testing
 Run from app root directory
  - **deploy-cloudgov.sh**
Initializes/launches app
 Only used for initialization of app
 Run from app root directory
- **web**
placeholder directory/subdirectories for Drupal