<?php

/**
 * Enable local development services.
 */
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

/**
 * Show all error messages, with backtrace information.
 *
 * In case the error level could not be fetched from the database, as for
 * example the database connection failed, we rely only on this value.
 */
$config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

// At DEV: Import translation from both l.d.o and local file system.
$config['locale.settings']['translation']['use_source'] = 'remote_and_local';

// Enable local development config split and disable production config split.
$config['config_split.config_split.local_dev']['status'] = TRUE;
$config['config_split.config_split.production']['status'] = FALSE;
