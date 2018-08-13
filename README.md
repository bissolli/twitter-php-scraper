# Twitter Profile Scraper

[![Build Status](https://travis-ci.org/bissolli/twitter-php-scraper.svg?branch=master)](https://travis-ci.org/bissolli/twitter-php-scraper)
[![Latest Stable Version](https://poser.pugx.org/bissolli/twitter-php-scraper/v/stable)](https://packagist.org/packages/bissolli/twitter-php-scraper)
[![Total Downloads](https://poser.pugx.org/bissolli/twitter-php-scraper/downloads)](https://packagist.org/packages/bissolli/twitter-php-scraper)
[![License](https://poser.pugx.org/bissolli/twitter-php-scraper/license)](https://packagist.org/packages/bissolli/twitter-php-scraper)

Twitter PHP Scrapper. Get account information, tweets, likes, re-tweets and comments through the Twitter handle.

## Code Example
To get the user profile:
```php
$twitter = new \Bissolli\TwitterScraper\Twitter('official_php');
var_dump($twitter->getProfile());
```
To load all the reachable tweets (last 20 tweets)
```php
$twitter = (new \Bissolli\TwitterScraper\Twitter('official_php'))->loadTweets();
var_dump($twitter->getProfile());
var_dump($twitter->getTweets());
```

## Installation

### Using composer
```sh
composer require bissolli/twitter-php-scraper
```

### If you don't have composer
You can download it [here](https://getcomposer.org/download/).

# TODO
* [X] Implement .travis.yml 
