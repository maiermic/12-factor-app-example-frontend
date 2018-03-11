<?php
if (!isset($_ENV['COMPOSER_VENDOR_DIR']) || !is_dir($_ENV['COMPOSER_VENDOR_DIR'])) {
    exit('environment variable is not set: COMPOSER_VENDOR_DIR');
}
require_once $_ENV['COMPOSER_VENDOR_DIR'] . '/autoload.php';

$client = new \GuzzleHttp\Client(['base_uri' => $_ENV['BACKEND_URL']]);
$images = json_decode($client->get('/images/')->getBody(), true);

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Images</title>

    <style type="text/css">
        body, html {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        .images,
        .image {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image {
            max-width: 100%;
        }
    </style>
</head>
<body>
<div class="images">
    <h1>Images</h1>
    <?php foreach ($images as $image): ?>
        <div class="image" id="<?= $image['id'] ?>">
            <h2 class="title"><?= $image['title'] ?></h2>
            <img src="<?= $image['url'] ?>">
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
