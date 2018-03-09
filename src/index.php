<?php
if (!isset($_ENV['COMPOSER_VENDOR_DIR']) || !is_dir($_ENV['COMPOSER_VENDOR_DIR'])) {
    exit('environment variable is not set: COMPOSER_VENDOR_DIR');
}
require_once $_ENV['COMPOSER_VENDOR_DIR'] . '/autoload.php';
$dockerSecrets = new \DockerSecrets\Reader\SecretsReader();
$backendApiToken = $dockerSecrets->read('backend_api_token');
echo $backendApiToken . PHP_EOL;
