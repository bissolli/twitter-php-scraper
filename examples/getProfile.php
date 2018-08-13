<?php

require __DIR__ . '/../vendor/autoload.php';

$account = new \Bissolli\TwitterScraper\Twitter('official_php');

echo "<pre>";
var_export($account->getProfile());
echo "</pre>";
