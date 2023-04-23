# Define the path to the Drupal root directory
DRUPAL_ROOT = ./web

# Define the path to the directory containing Drupal configuration files
DRUPAL_CONFIG = ./config/sync

# Define the command to install Drupal
DRUPAL_INSTALL_DEPENDENCIES = composer install

# Define the command to update Drupal dependencies
DRUPAL_UPDATE_DEPENDENCIES = composer update

# Define the command to install Drupal from existing configuration
DRUPAL_INSTALL = drush site:install --existing-config -y

# Define the command to import Drupal configuration
DRUPAL_IMPORT_CONFIG = drush config-import -y

# Define the command to export Drupal configuration
DRUPAL_EXPORT_CONFIG = drush config-export -y

# Define the command to update database schema
DRUPAL_UPDATE_SCHEMA = drush updb -y

# Define the command to check for available translation updates
DRUPAL_LOCALE_CHECK = drush locale-check

# Define the command to import the available translation updates
DRUPAL_LOCALE_UPDATE = drush locale-update

# Define the command to clear Drupal cache
DRUPAL_CLEAR_CACHE = drush cache:rebuild

# Install Drupal and import configuration
site-install:
	$(DRUPAL_INSTALL_DEPENDENCIES)
	$(DRUPAL_INSTALL)

# Update Drupal and clear cache
site-update:
	$(DRUPAL_INSTALL_DEPENDENCIES)
	$(DRUPAL_IMPORT_CONFIG)
	$(DRUPAL_UPDATE_SCHEMA)
	$(DRUPAL_LOCALE_CHECK)
	$(DRUPAL_LOCALE_UPDATE)
	$(DRUPAL_CLEAR_CACHE)

# Export Drupal configuration
export-config:
	$(DRUPAL_EXPORT_CONFIG)

# Import Drupal configuration
import-config:
	$(DRUPAL_IMPORT_CONFIG)

# Clear Drupal cache
clear-cache:
	$(DRUPAL_CLEAR_CACHE)
