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
$drivers = new DriverCollection();
$drivers->add(new UriParsers\Benchmarks\Drivers\League());
$drivers->add(new UriParsers\Benchmarks\Drivers\Native());
$drivers->add(new UriParsers\Benchmarks\Drivers\Pear());
$drivers->add(new UriParsers\Benchmarks\Drivers\Riimu());
$drivers->add(new UriParsers\Benchmarks\Drivers\Zend());

/**
 * CLI colors
 */
$yellow = chr(27)."[33m";
$green  = chr(27)."[32m";
$cyan   = chr(27)."[36m";
$reset  = chr(27)."[0m";
$redbg  = chr(27)."[41m";

/**
 * Default URI
 *
 * @var string
 */
$uri = 'ftp://cnn.example.com&story=breaking_news:pass@10.0.0.1/top_story.htm?q=v&q=b#~toto';
