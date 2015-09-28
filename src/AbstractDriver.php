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
namespace UriParsers\Benchmarks;

use League\Uri\Parser;

/**
 * Abstract Class to test URI Parsers
 *
 * @package UriParsers.Benchmarks
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   0.2.0
 */
abstract class AbstractDriver
{
    /**
     * Benchmark a URI Parser
     *
     * @param int $count The number of URI to parse
     * @param string $uri The URI to parse
     *
     * @return float the benchmark duration
     */
    abstract public function benchmark($count, $uri);

    /**
     * Parsing using a URI parser
     *
     * @param string $uri The URI to parse
     *
     * @return array
     */
    abstract public function parse($uri);

    /**
     * Returns the Parser name
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Returns the Parser name
     *
     * @return string
     */
    abstract public function getParserName();

    /**
     * Format the parsing results
     *
     * @param array|bool $uriparts the result from the parser function
     *
     * @return array
     */
    protected function formatResults($uriparts)
    {
        if (!is_array($uriparts)) {
            $uriparts = ['parsing failed' => $uriparts];
        }

        $format = function ($value) {
            if (null === $value) {
                return chr(27)."[32m null".chr(27)."[0m";
            }

            if ('' === $value) {
                return chr(27)."[34m (empty string)".chr(27)."[0m";
            }

            if (is_bool($value)) {
                $value = (true === $value) ? 'true' : 'false';

                return chr(27)."[35m ".$value.chr(27)."[0m";
            }

            return chr(27)."[33m ".$value.chr(27)."[0m";
        };

        return array_map($format, $uriparts);
    }

    /**
     * Generate an URL
     *
     * @param int $count
     *
     * @return Generator
     */
    protected function generateUri($count, $uri)
    {
        for ($i = 0; $i < $count; ++$i) {
            yield $uri;
        }
    }
}
