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

use Net_URL2;
use UriParsers\Benchmarks\AbstractDriver;

/**
 * Class to test Pear URI Parser
 *
 * @package UriParsers.Benchmarks
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   0.2.0
 */
class Pear extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'pear';
    }

    /**
     * @inheritdoc
     */
    public function getParserName()
    {
        return 'Net_URL2';
    }

    /**
     * @inheritdoc
     */
    public function benchmark($count, $uri)
    {
        $start = microtime(true);
        $memory = memory_get_usage();
        foreach ($this->generateUri($count, $uri) as $url) {
            new Net_URL2($url);
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
        $uri = new Net_URL2($uri);

        return $this->formatResults([
            'scheme' => $uri->getScheme(),
            'user' => $uri->getUser(),
            'pass' => $uri->getPassword(),
            'host' => $uri->getHost(),
            'port' => $uri->getPort(),
            'path' => $uri->getPath(),
            'query' => $uri->getQuery(),
            'fragment' => $uri->getFragment(),
        ]);
    }
}
