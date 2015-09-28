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

use League\Uri\UriParser;
use UriParsers\Benchmarks\AbstractDriver;

/**
 * Class to test League URI Parser
 *
 * @package UriParsers.Benchmarks
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   0.2.0
 */
class League extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'league';
    }

    /**
     * @inheritdoc
     */
    public function getParserName()
    {
        return 'League\Uri\Parser';
    }

    /**
     * @inheritdoc
     */
    public function benchmark($count, $uri)
    {
        $start = microtime(true);
        $memory = memory_get_usage();
        $uriParser = new UriParser();
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
        return $this->formatResults((new UriParser())->parse($uri));
    }
}
