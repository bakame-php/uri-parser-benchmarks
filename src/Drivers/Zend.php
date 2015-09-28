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
use Zend\Uri\Uri;

/**
 * Class to test Zend URI Parser
 *
 * @package UriParsers.Benchmarks
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   0.2.0
 */
class Zend extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'zend';
    }

    /**
     * @inheritdoc
     */
    public function getParserName()
    {
        return 'Zend\Uri\Uri';
    }

    /**
     * @inheritdoc
     */
    public function benchmark($count, $uri)
    {
        $start = microtime(true);
        $memory = memory_get_usage();
        $uriParser = new Uri(null);
        foreach ($this->generateUri($count, $uri) as $url) {
            $uriParser->parse($url);
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
        $uri = new Uri($uri);

        return $this->formatResults([
            'scheme' => $uri->getScheme(),
            'userinfo' => $uri->getUserInfo(),
            'host' => $uri->getHost(),
            'port' => $uri->getPort(),
            'path' => $uri->getPath(),
            'query' => $uri->getQuery(),
            'fragment' => $uri->getFragment(),
        ]);
    }
}
