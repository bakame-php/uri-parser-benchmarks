<?php

error_reporting(-1);
ini_set('display_errors', '1');

use UriParsers\Benchmarks\DriverCollection;

require dirname(__DIR__).'/vendor/autoload.php';

/**
 * Drives Collection
 *
 * @var DriverCollection
 */
$drivers = DriverCollection::createFromFileSystem(
    'UriParsers\Benchmarks\Drivers',
    dirname(__DIR__).'/src/Drivers'
);

/**
 * CLI colors
 */
$cyan = chr(27)."[36m";
$green = chr(27)."[32m";
$reset = chr(27)."[0m";
$redbg = chr(27)."[41m";
$yellow = chr(27)."[33m";

/**
 * Default URI
 *
 * @var string
 */
$uri = 'ftp://cnn.example.com&story=breaking_news:pass@10.0.0.1/top_story.htm?q=v&q=b#~toto';
