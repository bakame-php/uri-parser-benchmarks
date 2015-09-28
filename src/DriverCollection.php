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

use ArrayIterator;
use Countable;
use FilesystemIterator;
use InvalidArgumentException;
use IteratorAggregate;

/**
 * A collection of drivers
 *
 * @package UriParsers.Benchmarks
 * @since  0.2.0
 */
class DriverCollection implements Countable, IteratorAggregate
{
    /**
     * Drivers
     *
     * @var AbstractDriver[]
     */
    private $drivers = [];

    /**
     * Create From a Directory
     *
     * @param  string $namespace The namespace attach to the directory
     * @param  string $directory The directory path
     *
     * @return static
     */
    static public function createFromFileSystem($namespace, $directory)
    {
        $collection = new static;
        foreach (new FilesystemIterator($directory) as $fileInfo) {
            $className = $namespace.'\\'.$fileInfo->getBasename('.php');
            $collection->add(new $className());
        }

        return $collection;
    }

    /**
     * IteratorAggregate interface
     *
     * @return \Iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->drivers);
    }

    /**
     * Countable Interface
     *
     * @return int
     */
    public function count()
    {
        return count($this->drivers);
    }

    /**
     * Add a Driver
     *
     * @param AbstractDriver $driver a driver
     *
     * @throws \InvalidArgumentException If the Driver is not recognized
     */
    public function add(AbstractDriver $driver)
    {
        if ($this->has($driver)) {
            throw new InvalidArgumentException('The specified package is already registered');
        }

        $this->drivers[$driver->getName()] = $driver;
        ksort($this->drivers);
    }

    /**
     * Tell whether the driver is already registered in the collection
     *
     * @param  AbstractDriver
     *
     * @return boolean
     */
    public function has(AbstractDriver $driver)
    {
        return false !== array_search($driver, $this->drivers, true);
    }

    /**
     * @param string the driver name
     *
     * @throws InvalidArgumentException if no driver is found
     *
     * @return AbstractDriver
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->drivers)) {
            return $this->drivers[$name];
        }
        throw new InvalidArgumentException('Unkown Driver '. $name);
    }

    /**
     * Return the filter parameters for filter_* functions
     *
     * @return array
     */
    public function collectionFilter()
    {
        return [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                'regexp' => '/^('.implode('|', array_keys($this->drivers)).')$/',
                'default' => 'native',
            ],
        ];
    }
}
