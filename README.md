URI parser benchmark
=======

Motivation
-------

While developing [League URI](https://github.com/thephpleague/uri/) version 4, I needed to replace PHP `parse_url` function with a userland version which is more RFC3986 compliant.

This benchmark is only there to test the resulting code overhead (speed + memory usage).

This is a work in progress. Feel free to update and improve the tests. It will help everyone get a real interoperable `UriInterface`.

Tested implementations
-------

This package run the tests against the following implementations (order alphabetically):

- [Kit-UrlParser](https://github.com/Riimu/Kit-UrlParser)
- [League URI](https://github.com/thephpleague/uri/) (version 4.x)
- [Zend URI](https://github.com/zendframework/zend-uri)
- [parse_url](http://php.net/parse_url)

System Requirements
-------

You need:

- **PHP >= 5.5.0** or **HHVM >= 3.6**, but the latest stable version of PHP/HHVM is recommended
- the `mbstring` extension
- the `intl` extension

Install
-------

Clone this repo on a composer installed box and run the following command from the project folder.

``` bash
$ composer install
```

Scripts
-------

There's two script in the package `bin` directory:

### Parsing capabilities

The `parser.php` script returns the results from parsing a given URI with the listed parser.

``` bash
$ php parser.php --parser=league --uri="scheme://host:/path?#fragment"
```

The above command will output the result from parsing the given URI with the `League\Uri\UriParser` class.

You can of course change the parser by providing the parser name.

- native : `parse_url`
- league : `League\Uri\UriParser`
- zend   : `Zend\Uri\Uri`
- riimu  : `Riimu\Kit\UrlParser\UriParser`

For more options you can issue the following command to display the script help message:

``` bash
$ php parser.php --help
```

### Overhead capabilities

The `benchmark.php` script runs the benchmark against one implementation with a given URI.

``` bash
$ php benchmark.php --parser=zend --uri="scheme://host:/path?#fragment"
```

The above benchmark will use the `Zend\Uri\Uri` parsing capabilities and the submitted URI will be parsed 100 times with 3 iterations.

For more options you can issue the following command to display the script help message:


``` bash
$ php parser.php --help
```

Contributing
-------

Contributions are welcome and will be fully credited. Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

Credits
-------

- [ignace nyamagana butera](https://github.com/nyamsprod)
- [All Contributors](https://github.com/nyamsprod/psr7-uri-interface-test-suite/contributors)

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.
