# Project Setup Guide
This guide will walk you through setting up this project using DDEV and a Makefile.

## Prerequisites
Before you begin, make sure you have the following installed:

- DDEV
- Git

## Getting Started
Clone the project repository, then change into the project directory:

```bash
git clone git@gitlab.com:grpassu/applications-assurances/web_ea_evoli.git
```

## Start the DDEV environment:
```bash
ddev start
```

## Install Drupal and import configuration:
```bash
ddev make site-install
```

## Access your Drupal site at the following URL:
```bash
https://euro-assurance.ddev.site/
```

You can log in with the credentials that were prompted during the site-install.

## Updating Dependencies and Configuration
To update your project, run the following command:
```bash
ddev make site-update
```

## Exporting and Importing Configuration
### To export your Drupal configuration, run the following command:
```bash
ddev make export-config
```
This will generate a config directory containing your site's configuration.

### To import configuration, run the following command:
```bash
ddev make import-config
```
This will import the configuration from the config directory into your Drupal site.

## Clearing Cache
To clear your Drupal cache, run the following command:
```bash
ddev make clear-cache
```
