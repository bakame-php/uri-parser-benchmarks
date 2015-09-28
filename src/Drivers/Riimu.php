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

use Riimu\Kit\UrlParser\UriParser;
use RuntimeException;
use UriParsers\Benchmarks\AbstractDriver;

/**
 * Class to test Riimu URI Parser
 *
 * @package UriParsers.Benchmarks
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   0.2.0
 */
class Riimu extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'riimu';
    }

    /**
     * @inheritdoc
     */
    public function getParserName()
    {
        return 'Riimu\Kit\UrlParser\UriParser';
    }

    /**
     * @inheritdoc
     */
    public function benchmark($count, $uri)
    {
        $start = microtime(true);
        $memory = memory_get_usage();
        $uriParser = new UriParser();
        $uriParser->setMode(UriParser::MODE_IDNA2003);
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
        $uriParser = new UriParser();
        $uriParser->setMode(UriParser::MODE_IDNA2003);
        $uri = $uriParser->parse($uri);
        if (null === $uri) {
            throw new RuntimeException('`Riimu\Kit\UrlParser\UriParser::parse` returns `null`');
        }

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
