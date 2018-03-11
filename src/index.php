<?php
if (!isset($_ENV['COMPOSER_VENDOR_DIR']) || !is_dir($_ENV['COMPOSER_VENDOR_DIR'])) {
    exit('environment variable is not set: COMPOSER_VENDOR_DIR');
}
require_once $_ENV['COMPOSER_VENDOR_DIR'] . '/autoload.php';
$dockerSecrets = new \DockerSecrets\Reader\SecretsReader();
$backendApiToken = $dockerSecrets->read('backend_api_token');

?>

<html>
<head>
    <style type="text/css">
        .nav {
            display: flex;
        }

        a {
            text-decoration: none;
            color: #0000AA;
        }

        a.button {
            height: 20px;
            background-color: #0000AA;
            border: 1px solid #000066;
            border-radius: 5px;
            color: #fff;
            margin-right: 10px;
            padding: 10px 10px 10px 10px;
        }
    </style>
</head>
<body class="nav">
<a class="button" href="/images.php">Show images</a>
<a class="button" href="/upload.php">Upload image</a>
</body>
</html>