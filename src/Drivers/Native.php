<?php
/**
 * Uri Parsers Benchmarks
 *
 * @package   UriParsers.Benchmarks
 * @author    Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @copyright 2015 Ignace Nyamagana Butera
 * @license   https://github.com/nyamsprod/uri-parser-benchmarks/blob/master/LICENSE (MIT License)
 * @version   4.0.0
 * @link      https://github.com/nyamsprod/uri-parser-benchmarks
 */
namespace UriParsers\Benchmarks\Drivers;

use UriParsers\Benchmarks\AbstractDriver;

/**
 * Class to test PHP's parse_url
 *
 * @package UriParsers.Benchmarks
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   0.2.0
 */
class Native extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'native';
    }

    /**
     * @inheritdoc
     */
    public function getParserName()
    {
        return 'parse_url';
    }

    /**
     * @inheritdoc
     */
    public function benchmark($count, $uri)
    {
        $start = microtime(true);
        $memory = memory_get_usage();
        foreach ($this->generateUri($count, $uri) as $url) {
            parse_url($url);
        }

        return [
            'memory' => memory_get_usage() - $memory,
            'duration' => microtime(true) - $start,
        ];
    }

    /**
     * @inheritdoc
     */
    public function parse($uri)
    {
        return $this->formatResults(parse_url($uri));
    }
}
