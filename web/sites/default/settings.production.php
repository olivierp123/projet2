<?php

/**
 * @file
 * Settings files.
 */

// Set Redis as the default backend for any cache bin not otherwise specified.
$settings["redis.connection"]["interface"] = "PhpRedis";
$settings['redis.connection']['host'] = $_ENV['REDIS_HOST'];
$settings['redis.connection']['port'] = $_ENV['REDIS_PORT'];
$settings['redis.connection']['password'] = $_ENV['REDIS_PASSWORD'];
$settings["cache"]["default"] = "cache.backend.redis";

// Apply changes to the container configuration to better leverage Redis.
// This includes using Redis for the lock and flood control systems, as well
// as the cache tag checksum. Alternatively, copy the contents of that file
// to your project-specific services.yml file, modify as appropriate, and
// remove this line.
$settings["container_yamls"][] = "modules/contrib/redis/example.services.yml";

// Allow the services to work before the Redis module itself is enabled.
$settings["container_yamls"][] = "modules/contrib/redis/redis.services.yml";

// Manually add the classloader path, this is required for the container
// cache bin definition below
// and allows to use it without the redis module being enabled.
$class_loader->addPsr4("Drupal\\redis\\", "modules/contrib/redis/src");

// Use redis for container cache.
// The container cache is used to load the container definition itself, and
// thus any configuration stored in the container itself is not available
// yet. These lines force the container cache to use Redis rather than the
// default SQL cache.
$settings["bootstrap_container_definition"] = [
  "parameters" => [],
  "services" => [
    "redis.factory" => [
      "class" => 'Drupal\redis\ClientFactory',
    ],
    "cache.backend.redis" => [
      "class" => 'Drupal\redis\Cache\CacheBackendFactory',
      "arguments" => [
        "@redis.factory",
        "@cache_tags_provider.container",
        "@serialization.phpserialize",
      ],
    ],
    "cache.container" => [
      "class" => '\Drupal\redis\Cache\PhpRedis',
      "factory" => ["@cache.backend.redis", "get"],
      "arguments" => ["container"],
    ],
    "cache_tags_provider.container" => [
      "class" => 'Drupal\redis\Cache\RedisCacheTagsChecksum',
      "arguments" => ["@redis.factory"],
    ],
    "serialization.phpserialize" => [
      "class" => "Drupal\Component\Serialization\PhpSerialize",
    ],
  ],
];

// Enable production config split and disable local development config split.
$config['config_split.config_split.local_dev']['status'] = FALSE;
$config['config_split.config_split.production']['status'] = TRUE;

// SUPPORT for HTTPS with F5.
if (isset($_SERVER['HTTP_HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_HTTP_X_FORWARDED_PROTO'] == 'https') {
  $_SERVER['HTTPS'] = 'on';
}

// Set reverse proxy settings.
$settings['reverse_proxy'] = TRUE;
$settings['reverse_proxy_addresses'] = array($_SERVER['REMOTE_ADDR']);


